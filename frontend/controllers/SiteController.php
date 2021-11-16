<?php

namespace frontend\controllers;

use common\models\Appeals;
use common\models\City;
use common\models\Partners;
use common\models\Profession;
use common\models\User;
use frontend\models\Company;
use frontend\models\JobStats;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\Vacancy;
use frontend\models\VacancyOrders;
use frontend\models\VacancySearch;
use frontend\models\VerifyEmailForm;
use frontend\models\Worker;
use Mpdf\Tag\Article;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Reader_Excel5;
use PHPExcel_Worksheet_Drawing;
use PhpOffice\PhpSpreadsheet\Chart\Exception;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\Pagination;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,

                'only' => ['logout', 'signup', 'logout'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $vacancy = Vacancy::find()->orderBy('user_id');
        $count = $vacancy->count();
        $pages = new Pagination([
            'totalCount' => $count,
            'pageSize' => 10
        ]);
        $vacancy = $vacancy->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $job_stats = JobStats::findOne(['id' => 1]);
        $query = Partners::find()
            ->where(['status' => 1])
            ->orderBy('order')
            ->all();


        return $this->render('index', [
            'query' => $query,
            'job_stats' => $job_stats,
            'vacancy' => $vacancy,
            'pages' => $pages,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                return $this->redirect('/cabinet/index');
            }
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }


    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     */
    public function actionContact()
    {
        $model = new Appeals();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Malumotlaringiz muvaffaqiyatli yuborildi.');
            } else {
                Yii::$app->session->setFlash('error', 'Malumotlaringiz yuborilmadi.');
            }
            return $this->refresh();
        }
        return $this->render('contact', ['model' => $model]);
    }

    /**
     * Displays about page.
     *
     */
    public function actionAbout()
    {

        return $this->render('about');
    }


    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new Company();
        $model->scenario = Company::SCENARIO_SIGNUP;
        $user = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $user->username = $model->username;
            $user->email = $model->email;
            $user->password = $model->password;

            $user->role = !empty($model->director_name) ? 'company' : 'worker';
            $a = $user->role;
            if ($user = $user->signup()) {
                if ($a === 'worker') {
                    Yii::$app->session->setFlash('success', "Siz muvaffaqaiyatli ro'yxatdan o'tdingiz!!!");
                    return $this->redirect('/site/login/');
                }
                $image = UploadedFile::getInstance($model, 'logo');

                $model->userId = $user->id;
                if ($model->upload($image) && $model->save()) {
                    Yii::$app->session->setFlash('success', 'Ma`lumotlaringiz muvaffaqiyatli companiya nomidan qo`shildi.');
                    return $this->redirect('/site/login/');
                } else {
                    Yii::$app->session->setFlash('danger', 'Ma`lumotlar kiritishda xatolik mavjud!!!.');
                }
            }
        }

        return $this->render('signup', [
            'model' => $model
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public
    function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public
    function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }


//    public function actionPerevod(){
//        $model = City::find()->all();
//        foreach ($model as $item){
//            $model2 = City::findOne($item->id);
//            $model2->nameUz = City::cyrllat($item->nameUz);
//            $model2->save();
//        }
//    }

    public function actionVacancyViews($id = null, $get = false)
    {

        $vacancy = $this->findModel($id);
        $vacancyx = $this->findVacancyx($vacancy->profession_id, $id);
        $count = $vacancyx->count();
        $pages = new Pagination([
            'totalCount' => $count,
            'pageSize' => 10
        ]);
        $vacancyx = $vacancyx->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $vacancy->views++;


        $identity = Yii::$app->user->identity;
        $worker = Worker::findOne(['userId' => $identity->id]);
        $v_order = VacancyOrders::findOne(['vacancy_id' => $vacancy->id]);

        if ($get == 'true') {

            if ($identity) {
                $v_order = VacancyOrders::findOne(['vacancy_id' => $vacancy->id, 'worker_id' => $worker->id]);
                if (!empty($worker->photo)) {
                    if ($v_order) {
                        $v_order->worker_id = $worker->id;
                        $v_order->vacancy_id = $vacancy->id;
                        $vacancy->company_id = $vacancy->company->id;
                    }
                    if (!$v_order && $v_order->save()) {
                        Yii::$app->session->setFlash('success', 'Apply messages');
                    }
                } else {
                    return $this->redirect('/cabinet/worker');
                }
            } else {

                return $this->redirect('/site/login');
            }
        }
        if ($vacancy->save()) {

            $searchModel = new VacancySearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
            return $this->render('vacancy-views', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'vacancy' => $vacancy,
                'vacancyx' => $vacancyx,
                'v_order' => $v_order,
                'pages' => $pages,
                'get' => $get
            ]);
        }
        return $this->redirect('vacancy-view-all');
    }

//    action loadmore

//    public function actionImportExcel()
//    {
//
//        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
//        $inputFile = \Yii::getAlias('@app/web/uploads/excel/profession.xlsx');
//        try {
//            $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
//            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
//            $objPHPExcel = $objReader->load($inputFile);
//        } catch (Exception $e) {
//            die('Error');
//        }
//
//        $sheet = $objPHPExcel->getSheet(0);
//        $highestRow = $sheet->getHighestRow();
//        $highestColumn = $sheet->getHighestColumn();
//        for ($row = 1; $row <= $highestRow; $row++) {
//            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
//
//            if ($row == 1) {
//                continue;
//            }
//
//            $siswa = new Profession();
//            $siswa->name_uz = $rowData[0][0];
//            $siswa->name_ru = $rowData[0][1];
//            $siswa->name_en = $rowData[0][2];
//            $siswa->name_cyrl = $rowData[0][3];
//
//            $siswa->save();
//            print_r($siswa->getErrors());
//
//        }
//        die('okay');
//    }
//
// action Import Vacancy section
    public function actionImportVacancy()
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $inputFile = \Yii::getAlias('@app/web/uploads/excel/vacancy.xlsx');
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);
        } catch (Exception $e) {
            die('Error');
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();


        for ($row = 1; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            if ($row == 1) {
                continue;
            }

            $siswa = new Vacancy();
            $company = Company::findOne(['name' => $rowData[0][0]]);
            $user = User::findOne(['username'=>$rowData[0][0]]);

            if (empty($company) && empty($user)) {
                $company = new Company();
                $company->scenario = Company::SCENARIO_VACANCY;
                $user = new SignupForm();
                $user->username = $rowData[0][0];
                $user->email = $rowData[0][0] . '@mail.ru';
                $user->password = strtolower($rowData[0][0]);
                $user->role = 'company';
                if ($user = $user->signup()) {
                    $company->userId = $user->id;
                    $company->name = $user->username;
                    $company->director_name = "John Doe";
                    $company->regionId = 10;
                    $company->cityId = 8;
                    $company->address = "Singapur";
                    $company->phone = "+998-11-111-1111";
                    $company->logo = '';
                    $company->date = date('Y-m-d H:i:s');
                    if ($company->save()) {
                        $siswa->company_id = $company->id;
                        $siswa->user_id = $company->userId;
                        $siswa->region_id = $company->regionId;
                        $siswa->city_id = $company->cityId;
                        $siswa->image = $company->image;
                    }
                }
            } else {
                $siswa->company_id = $company->id;
                $siswa->user_id = $company->userId;
                $siswa->region_id = $company->regionId;
                $siswa->city_id = $company->cityId;
                $siswa->image = $company->image;
            }
            $lang = 'name_'.Yii::$app->language;
            $siswa->job_type_id = 1;
            $profession = Profession::findOne([$lang=>$rowData[0][2]]);
            if (empty($profession)){
                $profession = new Profession();
                $profession->name_uz = $rowData[0][2];
                $profession->name_ru = $rowData[0][2];
                $profession->name_en = $rowData[0][2];
                $profession->name_cyrl = $rowData[0][2];
                if ($profession->save()){
                    $siswa->profession_id = $profession->id;
                }
            }
            else{
                $siswa->profession_id = $profession->id;
            }
            $siswa->count = $rowData[0][10];
            $siswa->salary = $rowData[0][11];
            $siswa->gender = $rowData[0][12];
            $siswa->experience = $rowData[0][13];
            $siswa->telegram = $rowData[0][14];
            $siswa->address = $rowData[0][15];

            $siswa->save();
            print_r($siswa->errors);

        }
        die('okay');
    }

    protected function findModel($id)
    {
        if (($vacancy = Vacancy::findOne(['id' => $id])) !== null) {
            return $vacancy;
        }
        return false;
    }


    protected function findVacancyx($profession_id, $id)
    {
        if (($vacancyx = Vacancy::find()->where(['profession_id' => $profession_id])->andWhere(['!=', 'id', $id])) !== null) {
            return $vacancyx;
        }
        return false;
    }


    protected function findVacancyOrders($id)
    {
        if (($vacancyOrders = VacancyOrders::findOne($id)) !== null) {
            return $vacancyOrders;
        }
        return false;
    }
}
