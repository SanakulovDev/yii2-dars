<?php

namespace api\modules\v1\models;

use common\models\User;
use frontend\models\Company;
use frontend\models\VacancyOrders;
use Yii;
use yii\web\UploadedFile;

class Vacancy extends \frontend\models\Vacancy
{
    public $regionId;
    public $cityId;
    public $professionId;
    public $jobType;
    public $countVacancy;
    public $photo;

    public function rules()
    {
        return [
            [['regionId', 'cityId', 'professionId', 'jobType', 'countVacancy'], 'required'],
            [['regionId', 'cityId', 'professionId', 'jobType', 'countVacancy'], 'integer'],
            ['photo', 'file', 'extensions' => 'jpg, jpeg, svg, png','maxSize' => 1024 * 1024 * 4]
        ];
    }

    public function vacancySave()
    {
        $identity = \Yii::$app->user->identity;

        $user = User::findOne($identity ? $identity->id : 1);
        $company = Company::findOne(['userId' => $user->id]);

        $model = new \frontend\models\Vacancy();
        $model->user_id = $user->id ? $user->id : 1;
        $model->company_id = $company->id ? $company->id : 1;
        $model->profession_id = $this->professionId;
        $model->region_id = $this->regionId;
        $model->city_id = $this->cityId;
        $model->job_type_id = $this->jobType;
        $model->count = $this->countVacancy;
        $this->photo = UploadedFile::getInstance($this, 'photo');
//        vd($this);
        if ($model->upload($this->photo) && $model->save(false)) {
//        vd($this->photo);
            return $model;
        }
        return $model->errors;
    }


    public static function search($orderId)
    {
        $model = VacancyOrders::findOne($orderId);
        if ($model) {
            $result = Vacancy::findOne($model->vacancy_id);
            if ($result)
                return $result;

        }
//        vd(1234);
        return $model->errors;
    }
}