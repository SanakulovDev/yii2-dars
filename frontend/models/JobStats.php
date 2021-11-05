<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "job_stats".
 *
 * @property int $id
 * @property int $company_number
 * @property int $job_post_number
 * @property int $user_number
 * @property int $cv_count
 */
class JobStats extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_stats';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_number', 'job_post_number', 'user_number','cv_count'], 'required'],
            [['company_number', 'job_post_number', 'user_number','cv_count'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_number' => Yii::t('app', 'Company Number'),
            'job_post_number' => Yii::t('app', 'Job Post Number'),
            'user_number' => Yii::t('app', 'User Number'),
            'cv_count' => Yii::t('app', 'Workers'),
        ];
    }
}
