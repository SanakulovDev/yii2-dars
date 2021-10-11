<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\Company;
use frontend\models\Worker;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class CabinetController extends Controller
{
    public $layout = '/cabinet';

    public function actionIndex()
    {
        $identity = \Yii::$app->user->identity;
        $company = $this->findModel($identity->id);
        $worker = $this->findWorker($identity->id);
        if ($company) {
            return $this->render('index',
                ['company' => $company]);
        }
        return $this->render('worker',
            ['worker' => $worker]);
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

    public function actionWorker()
    {
        $worker = new Worker();
        return $this->render('worker', ['model' => $worker]);
    }

    public function actionWorkerEdit()
    {
        $identity = \Yii::$app->user->identity;
        $worker = $this->findWorker($identity->id);
        $worker->scenario = Worker::SCENARIO_WORKEREDIT;
        if ($this->request->isPost && $worker->load($this->request->post())) {
            $image = UploadedFile::getInstance($worker, 'photo');
            if ($worker->upload($image) && $worker->save()) {
                \Yii::$app->session->setFlash('success', \Yii::t('app', 'Your data has been successfully modified'));
                return $this->redirect(['index', 'id' => $worker->id]);
            } else {
                \Yii::$app->session->setFlash('error', \Yii::t('app', 'An error occurred while modifying your data'));
            }
        }

        return $this->render('worker-edit', [
            'worker' => $worker,
        ]);
    }
    public function actionWorkerCreate()
    {
        $worker = new Worker();

        $worker->scenario = Worker::SCENARIO_EDIT;

        if ($worker->load(\Yii::$app->request->post())){
            $image = UploadedFile::getInstance($worker, 'photo');
            $worker->userId = \Yii::$app->user->identity->id;
            if ($worker->upload($image) && $worker->save())
                return $this->redirect('index');
        }
        return $this->render('worker-create',['worker'=>$worker]);
    }

    protected function findWorker($id)
    {
        if ($worker = Worker::findOne(['userId' => $id])) {
            return $worker;
        }
        return null;
    }
}