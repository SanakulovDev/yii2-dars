<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "vacancy_orders".
 *
 * @property int $id
 * @property int $company_id
 * @property int $vacancy_id
 * @property int $worker_id
 * @property int $status
 * @property int|null $company_view
 * @property int|null $worker_view
 * @property string $created_at
 * @property string $date_approval
 *
 * @property Company $company
 * @property Vacancy $vacancy
 * @property Worker $worker
 */
class VacancyOrders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const  SCENARIO_VACANCYVIEWS = 'vacancy-views';
    const SCENARIO_APPLY_MESSAGES = 'apply-messages';
    const STATUSLIST = [
        0 => 'Yuborilgan',
        1 => 'Bekor qilingan',
        2 => 'Suhbatga chaqirildi',
        3 => 'Ishga taklif qilindi',
    ];
    public static function tableName()
    {
        return 'vacancy_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'vacancy_id', 'worker_id', 'status'], 'required'],
            [['company_id', 'vacancy_id', 'worker_id', 'status', 'company_view', 'worker_view'], 'integer'],
            [['created_at', 'date_approval'], 'safe'],
            [['worker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Worker::className(), 'targetAttribute' => ['worker_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['vacancy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vacancy::className(), 'targetAttribute' => ['vacancy_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_id' => Yii::t('app', 'Company ID'),
            'vacancy_id' => Yii::t('app', 'Vacancy name'),
            'worker_id' => Yii::t('app', 'Worker ID'),
            'status' => Yii::t('app', 'Status'),
            'company_view' => Yii::t('app', 'Company View'),
            'worker_view' => Yii::t('app', 'Worker View'),
            'created_at' => Yii::t('app', 'Created At'),
            'date_approval' => Yii::t('app', 'Date Approval'),
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * Gets query for [[Vacancy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVacancy()
    {
        return $this->hasOne(Vacancy::className(), ['id' => 'vacancy_id']);
    }

    /**
     * Gets query for [[Worker]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorker()
    {
        return $this->hasOne(Worker::className(), ['id' => 'worker_id']);
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_VACANCYVIEWS => ['company_id', 'worker_id', 'vacancy_id'],
            self::SCENARIO_APPLY_MESSAGES =>['company_view']
        ];
    }



}
