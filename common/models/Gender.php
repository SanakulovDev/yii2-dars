<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "gender".
 *
 * @property int $id
 * @property string|null $name
 */
class Gender extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gender';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz'], 'string', 'max' => 255],
            [['name_en'], 'string', 'max' => 255],
            [['name_ru'], 'string', 'max' => 255],
            [['name_cyrl'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_uz' => Yii::t('app', 'Name Uz'),
            'name_en' => Yii::t('app', 'Name En'),
            'name_ru' => Yii::t('app', 'Name Ru'),
            'name_cyrl' => Yii::t('app', 'Name Cyrl'),
        ];
    }
    public static function selectList() {
        $lang = Yii::$app->language;
        $name = 'name_'.$lang;
        return ArrayHelper::map(self::find()->all(), 'id', $name);
    }

}
