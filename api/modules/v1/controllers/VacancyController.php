<?php

namespace api\modules\v1\controllers;

use api\controllers\GeneralController;
use api\modules\v1\models\Vacancy;
use yii\rest\Controller;
use yii\web\UploadedFile;

class VacancyController extends Controller
{
//    public $modelClass = 'frontend\models\Vacancy';

    public function actionCreate()
    {
        $model = new Vacancy();
        if ($model->load(\Yii::$app->request->post(), '')) {

            if ($vacancy = $model->vacancySave()) {
                return $vacancy;
            }
        }
        return [
            'message' => 'Ma\'lumotlar to\'liq kiritilmadi'
        ];
    }

    public function actionSearch()
    {
        $order = \Yii::$app->request->get();
        $result = Vacancy::search($order['orderId']);
        if ($order){
            return $result;
        }

        return [
            'success' => false,
            'message' => 'Errors'
        ];
    }
}