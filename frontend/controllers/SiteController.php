<?php

namespace frontend\controllers;

use common\models\Appeals;
use common\models\City;
use common\models\Partners;
use frontend\models\ApplyVacancy;
use frontend\models\Company;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\Vacancy;
use frontend\models\VacancySearch;
use frontend\models\VerifyEmailForm;
use Mpdf\Tag\Article;
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
        $query = Partners::find()
            ->where(['status' => 1])
            ->orderBy('order')
            ->all();
        return $this->render('index', ['query' => $query]);
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
                if ($a === 'worker'){
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
//        else {
//            $user->username = $model->username;
//            $user->email = $model->email;
//            $user->password = $model->password;
//
//            $user->role = !empty($model->director_name) ? 'company' : 'worker';
//            $a = $user->role;
//            if ($user = $user->signup()) {
//                if ($a === 'worker'){
//                    Yii::$app->session->setFlash('success', "Siz muvaffaqaiyatli ro'yxatdan o'tdingiz!!!");
//                    return $this->redirect('/site/login/');
//                }
//
//            }
//        }
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

    public function actionVacancyViews($id)
    {
        $vacancy = $this->findModel($id);
        $vacancyx =$this->findVacancyx($vacancy->profession_id, $id);
        $count = $vacancyx->count();
        $pages = new Pagination([
            'totalCount' =>$count,
            'pageSize'=>3
        ]);
        $vacancyx = $vacancyx->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $vacancy->views++;
        if ($vacancy->save()) {
            $searchModel = new VacancySearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
            return $this->render('vacancy-views', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'vacancy' => $vacancy,
                'vacancyx' => $vacancyx,
                'pages'=>$pages
            ]);
        }
        return $this->redirect('vacancy-view-all');
    }


    public function actionVacancyViewAll()
    {
        $vacancy = Vacancy::find()->orderBy('user_id');
        $count = $vacancy->count();
        $pages = new Pagination([
            'totalCount' =>$count,
            'pageSize'=>3
        ]);
        $vacancy = $vacancy->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('vacancy-view-all', [
            'vacancy' => $vacancy,
            'pages'=>$pages
        ]);
    }

    public function actionApplyVacancy($id)
    {
        $apply_vacancy = new ApplyVacancy();
        $image = UploadedFile::getInstance($apply_vacancy, 'rezume');
        $apply_vacancy->company_id = $this->findModel($id)->company_id;
        $apply_vacancy->vacancy_id = $this->findModel($id)->id;
        if ($apply_vacancy->upload($image) && $apply_vacancy->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', "Xabaringiz jo'natildi tez orada sizga aloqaga chiqamiz"));
            return $this->redirect(['vacancy-views', 'id' => $id]);
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('app', "Xabaringiz jo'natilmadi. Qaytadan urinib ko'ring"));
        }
        return $this->render('apply-vacancy', [
            'apply_vacancy' => $apply_vacancy
        ]);

    }

    protected function findApplyVacancy($id)
    {
        if (($apply_vacancy = ApplyVacancy::findOne(['id' => $id])) !== null) {
            return $apply_vacancy;
        }
        return false;
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
        if (($vacancyx = Vacancy::find()->where(['profession_id' => $profession_id])->andWhere(['!=','id',$id])) !== null) {
            return $vacancyx;
        }
        return false;
    }
}
