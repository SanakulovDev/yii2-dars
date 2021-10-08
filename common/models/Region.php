<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string|null $nameRu
 * @property string|null $nameEn
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nameUz','nameRu', 'nameEn'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nameUz' => Yii::t('app', 'Name Uz'),
            'nameRu' => Yii::t('app', 'Name Ru'),
            'nameEn' => Yii::t('app', 'Name En'),
        ];
    }
    public static function selectList() {
        $lang = ucfirst(Yii::$app->language);
        $name = 'name'.$lang;
        return ArrayHelper::map(self::find()->all(), 'id', $name);
    }



}
