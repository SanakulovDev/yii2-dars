<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\Company;
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
        if ($identity) {
            return $this->render('/cabinet/index', ['company' => $company]);
        }
//        return $this->render('/cabinet/index', ['company'=>$company]);
    }

    protected function findModel($userId)
    {
        if (($company = Company::findOne(['userId' => $userId])) !== null) {
            return $company;
        }


        throw new NotFoundHttpException(\Yii::t('app', 'Bundayin sahifa mavjud emas.'));
    }

    public function actionEdit()
    {
        $identity = \Yii::$app->user->identity;
        $model = $this->findModel($identity->id);
        $model->scenario = Company::SCENARIO_UPDATE;
        if ($this->request->isPost && $model->load($this->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($model->edit($image) && $model->save()){
                \Yii::$app->session->setFlash('success', \Yii::t('app','Your data has been successfully modified'));
                return $this->redirect(['index', 'id' => $model->id]);
            }
            else {
                \Yii::$app->session->setFlash('error', \Yii::t('app','An error occurred while modifying your data'));
            }
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }
}