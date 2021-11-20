<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property int $id
 * @property int $userId
 * @property string $table_name
 * @property string|null $message
 * @property string $date
 *
 * @property HistoryChild[] $historyChildren
 * @property User $user
 */
class History extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'table_name'], 'required'],
            [['userId'], 'integer'],
            [['date'], 'safe'],
            [['table_name'], 'string', 'max' => 50],
            [['message'], 'string', 'max' => 255],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userId' => Yii::t('app', 'User ID'),
            'table_name' => Yii::t('app', 'Table Name'),
            'message' => Yii::t('app', 'Message'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * Gets query for [[HistoryChildren]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryChildren()
    {
        return $this->hasMany(HistoryChild::className(), ['history_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }


//    trigger function

    public function history()
    {

    }
}
