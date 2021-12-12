<?php

namespace api\modules\v1\controllers;

use api\controllers\GeneralController;
use common\models\User;
use frontend\models\Worker;
use api\modules\v1\models\V1Worker;
use frontend\models\SignupForm;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\UploadedFile;

class WorkerController extends Controller
{
    public $modelClass = "api\models\Worker";

    public function actionCreate()
    {
        $model = new V1Worker();
        $worker = new \frontend\models\Worker();
        if (\Yii::$app->request->post()) {
            if ($model->load(\Yii::$app->request->post(), '')) {
                $image = UploadedFile::getInstance($model, 'photo');
//                vd($image);
                if ($user = $model->workerAdd()) {
                    return $user;
                }
            }
        }
        return [
            'status' => false,
            'message' => $model->errors
        ];
    }
}