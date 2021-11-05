<?php

namespace frontend\models;

use Yii;
use common\models\Language;

/**
 * This is the model class for table "worker_language".
 *
 * @property int $id
 * @property int|null $worker_id
 * @property int|null $language_id
 * @property string|null $other_lang
 * @property int|null $rate
 *
 * @property Language $language
 * @property Worker $worker
 */
class WorkerLanguage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'worker_language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['worker_id', 'language_id', 'rate'], 'integer'],
            [['other_lang'], 'string', 'max' => 35],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['worker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Worker::className(), 'targetAttribute' => ['worker_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'worker_id' => Yii::t('app', 'Worker ID'),
            'language_id' => Yii::t('app', 'Language ID'),
            'other_lang' => Yii::t('app', 'Other Lang'),
            'rate' => Yii::t('app', 'Rate'),
        ];
    }

    /**
     * Gets query for [[Language]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguages()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
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
}
