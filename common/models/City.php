<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property int|null $regionId
 * @property string|null $nameUz
 * @property string|null $nameRu
 * @property string|null $nameEn
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['regionId'], 'integer'],
            [['nameUz', 'nameRu', 'nameEn'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'regionId' => Yii::t('app', 'Region ID'),
            'nameUz' => Yii::t('app', 'Name Uz'),
            'nameRu' => Yii::t('app', 'Name Ru'),
            'nameEn' => Yii::t('app', 'Name En'),
        ];
    }

    public function getRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'regionId']);
    }

    public static function selectList($regionId = null) {
        $name = 'name' . ucfirst(Yii::$app->language);
        $codition = [];
        if ($regionId){
            $codition = ['regionId' => $regionId];
        }
        return ArrayHelper::map(self::find()->where($codition)->all(), 'id', Yii::t('app', $name));
    }
}
