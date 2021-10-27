<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\Company;
use frontend\models\Worker;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;

class CabinetController extends Controller
{
    public $layout = '/cabinet';

    public function actionIndex()
    {
        $identity = \Yii::$app->user->identity;
        $company = $this->findModel($identity->id);
        $worker = new Worker();
        if ($company) {
            return $this->render('index',
                ['company' => $company]);
        }
        return $this->render('worker',
            ['worker' => $worker]);
    }

    public function actionWorker()
    {
        $identity = \Yii::$app->user->identity;
        $worker = $this->findWorker($identity->id);
        return $this->render('worker',[
            'worker'=>$worker
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

        if ($worker!=null) {
            if ($worker->load($this->request->post())) {
                $image = UploadedFile::getInstance($worker, 'photo');

                if ($worker->upload($image) && $worker->save()) {
                    \Yii::$app->session->setFlash('success', \Yii::t('app', 'Your data has been successfully modified'));
                    return $this->redirect(['index', 'id' => $worker->id]);
                } else {
                    \Yii::$app->session->setFlash('error', \Yii::t('app', 'An error occurred while modifying your data'));
                }
            } else {
                return $this->redirect('worker-create', ['id' => $identity]);
            }
        }

        return $this->redirect('worker-create');
    }

    public function actionWorkerCreate()
    {
        $worker = new Worker();

        $worker->scenario = Worker::SCENARIO_EDIT;

        if ($worker->load(\Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($worker, 'photo');
            $worker->userId = \Yii::$app->user->identity->id;
            if ($worker->upload($image) && $worker->save())
                return $this->redirect('worker');
        }
        return $this->render('worker-create', ['worker' => $worker]);
    }

    protected function findWorker($id)
    {
        if ($worker = Worker::findOne(['userId' => $id])) {
            return $worker;
        }
        return null;
    }
}