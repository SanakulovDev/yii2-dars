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
        $worker = new Worker();
        if ($identity) {
            if ($company)
                return $this->render('index', ['model' => $company]);
            return $this->render('worker', ['worker' => $worker]);
        }

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

        if ($identity) {
            if ($worker !==null){
               return $this->render('worker-edit',['worker'=>$worker]);
            }
            return $this->redirect('worker-create');
        }
    }

    protected function findWorker($id)
    {
        if ($worker = User::findOne(['id' => $id])) {
            return $worker;
        }
        return null;
    }
}