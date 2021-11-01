<?php

namespace frontend\controllers;

use common\models\Language;
use common\models\User;
use Complex\Exception;
use frontend\models\Company;
use frontend\models\LaborActivity;
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
        if ($worker) {
            return $this->render('worker',
                ['worker' => $worker]);
        }

        return $this->render('index',
        ['company' => $company]);
    }



    public function actionWorker()
    {
        $identity = \Yii::$app->user->identity;
        $worker = $this->findWorker($identity->id);

        return $this->render('worker', [
            'worker' => $worker
        ]);
    }

    protected function findModel($userId)
    {
        if (($company = Company::findOne(['userId' => $userId])) !== null) {
            return $company;
        }
        return false;

    }

    public function actionEdit()
    {
        $identity = \Yii::$app->user->identity;
        $model = $this->findModel($identity->id);
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


    public function actionWorkerEdit()
    {
        $identity = \Yii::$app->user->identity;
        $worker = $this->findWorker($identity->id);
        $worker->scenario = Worker::SCENARIO_WORKEREDIT;
        if (!empty($worker)) {
            if ($worker->load($this->request->post())) {
                $image = UploadedFile::getInstance($worker, 'photo');

                if ($worker->upload($image) && $worker->save()) {
                    \Yii::$app->session->setFlash('success', \Yii::t('app', 'Your data has been successfully modified'));
                    return $this->redirect(['index', 'id' => $worker->id]);
                } else {
                    \Yii::$app->session->setFlash('error', \Yii::t('app', 'An error occurred while modifying your data'));
                }


            }
            return $this->render('worker-edit', [
                'worker' => $worker
            ]);
        }

        return $this->redirect(['worker-create']);
    }

    public function actionWorkerCreate()
    {
        $identity = \Yii::$app->user->identity;
        $worker = $this->findWorker($identity->id);
        $modelsLaborActivity = [new LaborActivity];

        $worker->scenario = Worker::SCENARIO_EDIT;
        if (empty($worker->userId)) {
            if ($worker->load(\Yii::$app->request->post())) {

                $modelsLaborActivity = Model::createMultiple(LaborActivity::classname());
                Model::loadMultiple($modelsLaborActivity, Yii::$app->request->post());

                // validate all models
                $valid = $worker->validate();
                $valid = Model::validateMultiple($modelsLaborActivity) && $valid;

                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    $image = UploadedFile::getInstance($worker, 'photo');
                    $worker->userId = $identity->id;

                    try {
                        if ($flag =($worker->upload($image) && $worker->save(false))) {
                            foreach ($modelsLaborActivity as $modelLaborActivity) {
                                $modelLaborActivity->worker_id = $worker->id;
                                if (! ($flag = $modelLaborActivity->save(false))) {
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
            }
            return $this->render('worker-create', [
                'worker' => $worker,
                'modelsLaborActivity' => (empty($modelsLaborActivity)) ? [new LaborActivity] : $modelsLaborActivity
            ]);

        }


        return $this->redirect('worker-edit');

    }

    protected function findWorker($id)
    {
        if ($worker = Worker::findOne(['userId' => $id])) {
            return $worker;
        }
        return null;
    }


}