<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "history_child".
 *
 * @property int $id
 * @property int $history_id
 * @property string|null $message
 * @property string $old_value
 *
 * @property History $history
 */
class HistoryChild extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history_child';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['history_id', 'old_value'], 'required'],
            [['history_id'], 'integer'],
            [['message', 'old_value'], 'string', 'max' => 255],
            [['history_id'], 'exist', 'skipOnError' => true, 'targetClass' => History::className(), 'targetAttribute' => ['history_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'history_id' => Yii::t('app', 'History ID'),
            'message' => Yii::t('app', 'Message'),
            'old_value' => Yii::t('app', 'Old Value'),
        ];
    }

    /**
     * Gets query for [[History]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistory()
    {
        return $this->hasOne(History::className(), ['id' => 'history_id']);
    }
}
