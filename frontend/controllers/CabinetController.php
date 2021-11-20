<?php

namespace frontend\controllers;

use common\models\User;
use Complex\Exception;
use frontend\models\Company;
use frontend\models\LaborActivity;
use frontend\models\SignupForm;
use frontend\models\VacancyOrders;
use frontend\models\Worker;
use frontend\models\WorkerLanguage;
use Yii;

use frontend\models\Model;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;
use yii\widgets\ActiveForm;

class CabinetController extends Controller
{
    public $layout = '/cabinet';

    public function actionIndex()
    {

        $identity = \Yii::$app->user->identity;
        $company = $this->findModel($identity->id);
        $worker = $this->findWorker($identity->id);
        if ($company)
            return $this->render('index',
                ['company' => $company]);
        return $this->redirect('worker');
    }


    public function actionWorker()
    {
        $identity = \Yii::$app->user->identity;
        $worker = $this->findWorker($identity->id);
        if (empty($worker))
            return $this->redirect('worker-create');
        $laborActivity = $this->findLaborAcitivity($worker->id);
        $workerLanguage = $this->findWorkerlanguage($worker->id);

        return $this->render('worker', [
            'worker' => $worker,
            'laborActivity' => $worker,
            'workerLanguage' => $workerLanguage
        ]);
    }

    protected function findModel($userId)
    {
        if (($company = Company::findOne(['userId' => $userId])) !== null) {
            return $company;
        }
        return false;

    }

    protected function findLaborAcitivity($worker_id)
    {
        if (($laborActivity = LaborActivity::findOne(['worker_id' => $worker_id])) !== null) {
            return $laborActivity;
        }
        return false;

    }

    protected function findWorkerlanguage($worker_id)
    {
        if (($workerLanguage = WorkerLanguage::findOne(['worker_id' => $worker_id])) !== null) {
            return $workerLanguage;
        }
        return false;

    }

    public function actionEdit()
    {
        $identity = \Yii::$app->user->identity;
        $model = $this->findModel($identity->id);
        if (!empty($model)) {
            $model->scenario = Company::SCENARIO_UPDATE;
            if ($this->request->isPost && $model->load($this->request->post())) {
                $image = UploadedFile::getInstance($model, 'image');
                if ($model->upload($image) && $model->save()) {
                    \Yii::$app->session->setFlash('success', \Yii::t('app', 'Your data has been successfully modified'));
                    return $this->redirect(['index', 'id' => $model->id]);
                } else {
                    \Yii::$app->session->setFlash('error', \Yii::t('app', 'An error occurred while modifying your data'));
                }
            }
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
        return $this->redirect('index');

    }

// action worker edit

    public function actionWorkerEdit()
    {
        $identity = Yii::$app->user->identity;
        $worker = $this->findWorker($identity->id);
        $modelsLaborActivity = $worker->laborActivity;
        $modelsWorkerLanguage = $worker->workerLanguages;
        $worker->scenario = Worker::SCENARIO_WORKEREDIT;


        if ($worker->load($this->request->post())) {

            $oldWorkerIds = ArrayHelper::map($modelsWorkerLanguage, 'id', 'id');
            $modelsWorkerLanguage = Model::createMultiple(WorkerLanguage::classname(), $modelsWorkerLanguage);
            Model::loadMultiple($modelsWorkerLanguage, Yii::$app->request->post());
            $deletedWorkerIDs = array_diff($oldWorkerIds, array_filter(ArrayHelper::map($modelsWorkerLanguage, 'id', 'id')));

            $oldLaborIds = ArrayHelper::map($modelsLaborActivity, 'id', 'id');
            $modelsLaborActivity = Model::createMultiple(LaborActivity::classname(), $modelsLaborActivity);
            Model::loadMultiple($modelsLaborActivity, Yii::$app->request->post());
            $deletedLaborIDs = array_diff($oldLaborIds, array_filter(ArrayHelper::map($modelsLaborActivity, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsWorkerLanguage),
                    ActiveForm::validateMultiple($modelsLaborActivity),
                    ActiveForm::validate($worker)
                );
            }

            // validate all models
            $valid = $worker->validate();
            $valid = Model::validateMultiple($modelsWorkerLanguage) && Model::validateMultiple($modelsLaborActivity) && $valid;

            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();
                $image = UploadedFile::getInstance($worker, 'photo');
                $worker->userId = $identity->id;
                try {
                    if ($flag = ($worker->upload($image) && $worker->save(false))) {
                        if (!empty($deletedWorkerIDs)) {
                            WorkerLanguage::deleteAll(['id' => $deletedWorkerIDs]);
                        }
                        foreach ($modelsWorkerLanguage as $modelWorkerLanguage) {
                            $modelWorkerLanguage->worker_id = $worker->id;
                            if (!($flag = $modelWorkerLanguage->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        if (!empty($deletedLaborIDs)) {
                            LaborActivity::deleteAll(['id' => $deletedLaborIDs]);
                        }
                        foreach ($modelsLaborActivity as $modelLaborActivity) {
                            $modelLaborActivity->worker_id = $worker->id;
                            if (!($flag = $modelLaborActivity->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['worker', 'id' => $worker->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }


            return $this->redirect(['worker-create']);


        }

        return $this->render('worker-edit', [
            'worker' => $worker,
            'modelsLaborActivity' => (empty($modelsLaborActivity)) ? [new LaborActivity] : $modelsLaborActivity,
            'modelsWorkerLanguage' => (empty($modelsWorkerLanguage)) ? [new WorkerLanguage] : $modelsWorkerLanguage
        ]);


    }

//worker create action location
    public function actionWorkerCreate()
    {
        $identity = \Yii::$app->user->identity;
        $worker = new Worker();
        $modelsLaborActivity = [new LaborActivity];
        $modelsWorkerLanguage = [new WorkerLanguage];
        $worker->scenario = Worker::SCENARIO_EDIT;
        if ($worker->load(\Yii::$app->request->post())) {

            $modelsLaborActivity = Model::createMultiple(LaborActivity::classname());
            Model::loadMultiple($modelsLaborActivity, Yii::$app->request->post());

            $modelsWorkerLanguage = Model::createMultiple(WorkerLanguage::classname());
            Model::loadMultiple($modelsWorkerLanguage, Yii::$app->request->post());

            // validate all models
            $valid = $worker->validate();
            $valid = Model::validateMultiple($modelsLaborActivity) && $valid;
            $valid = Model::validateMultiple($modelsWorkerLanguage) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                $image = UploadedFile::getInstance($worker, 'photo');
                $worker->userId = $identity->id;

                try {
                    if ($flag = ($worker->upload($image) && $worker->save(false))) {
                        foreach ($modelsLaborActivity as $modelLaborActivity) {
                            $modelLaborActivity->worker_id = $worker->id;
                            if (!($flag = $modelLaborActivity->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        foreach ($modelsWorkerLanguage as $modelWorkerLanguage) {
                            $modelWorkerLanguage->worker_id = $worker->id;
                            if (!($flag = $modelWorkerLanguage->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect('worker');
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            return $this->redirect('worker-edit');
        }

        return $this->render('worker-create', [
            'worker' => $worker,
            'modelsLaborActivity' => (empty($modelsLaborActivity)) ? [new LaborActivity] : $modelsLaborActivity,
            'modelsWorkerLanguage' => (empty($modelsWorkerLanguage)) ? [new WorkerLanguage] : $modelsWorkerLanguage
        ]);


    }

    protected function findWorker($id)
    {
        if ($worker = Worker::findOne(['userId' => $id])) {
            return $worker;
        }
        return null;
    }


    public function actionCvDownload($id = null)
    {
        $identity = \Yii::$app->user->identity;
        $worker = Worker::findOne($id);
        if (!$worker or $worker and $worker->userId == $identity->id) {
            $worker = $this->findWorker($identity->id);
        }


        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('cv', ['worker' => $worker]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_DOWNLOAD,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
                'SetTitle' => 'Sanakulov Dev',
                'SetHeader' => ['Sanakulov Dev: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],


            ]
        ]);


        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    public function actionCv()
    {
        $identity = \Yii::$app->user->identity;
        $worker = $this->findWorker($identity->id);
        $laborActivity = $this->findLaborAcitivity($worker->id);
        $workerLanguage = $this->findWorkerlanguage($worker->id);
        if (empty($worker)) {
            return $this->render('cv', [
                'worker' => new Worker(),
                'laborActivity' => $laborActivity,
                'workerLanguage' => $workerLanguage
            ]);
        }
        return $this->render('cv', [
            'worker' => $worker,
            'laborActivity' => $laborActivity,
            'workerLanguage' => $workerLanguage
        ]);
    }


//    Apply messages

    public function actionApplyMessages()
    {
        $identity = \Yii::$app->user->identity;
        $company = $this->findModel($identity->id);
        $vacancyOrders = VacancyOrders::find()->where(['company_id' => $company->id])->all();
//        $company->scenario = Company::SCENARIO_APPLY;


        return $this->render('apply-messages', [
            'company' => $company,
            'vacancyOrders' => $vacancyOrders ? $vacancyOrders : null,

        ]);
    }





//    public function actionWorkerOrder


    public function actionWorkerOrder()
    {
        $identity = \Yii::$app->user->identity;
        $worker = $this->findWorker($identity->id);
        $worker->scenario = Worker::SCENARIO_APPLY_M;
        $vacancyOrders = VacancyOrders::find()->where(['worker_id' => $worker->id])->all();

        foreach ($vacancyOrders as $item) {
            $item->scenario = VacancyOrders::SCENARIO_APPLY_MESSAGES;
            $item->worker_view++;
            $item->save();
        }
        return $this->render('worker-order', [
            'worker' => $worker,
            'vacancyOrders' => $vacancyOrders,

        ]);
    }


//action rate_order
    public function actionRateVacancy($id = null, $action = null)
    {
        $vacancy_order = VacancyOrders::findOne($id);
        if ($vacancy_order) {
            $vacancy_order->status = $action;
            $vacancy_order->scenario = VacancyOrders::SCENARIO_STATUS;
            $vacancy_order->save();

            $worker = Worker::findOne($vacancy_order->worker_id);
            $user = User::findOne($worker->userId);
            if ($this->sendEmail($user, $vacancy_order))
                return $this->redirect('apply-messages');
        }
        return $this->redirect('index');
    }

    public function sendEmail($user, $vacancy_order)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => $user->username])
            ->setTo($user->email)
            ->setHtmlBody('<p>Salom hammaga</p>')
            ->setSubject("Assalomu alaykum  $user->username. Biz sizga shuni ma'lum qilamizki $vacancy_order->company_id  $vacancy_order->created_at vaqtda siz qoldirgan ariza ".VacancyOrders::STATUSLIST[$vacancy_order->status])
            ->send();
    }
}