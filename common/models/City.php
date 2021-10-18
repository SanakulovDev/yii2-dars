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

    public static function cyrllat($text) {
        $text = trim($text);
        $cyrillic = ["Ш","Я","ч", "ў", "ш", "ё","я","а","б","д","э","е","ф","г","ҳ","и","ж","к","л","м","н","о","п","қ","р","с","т","у","в","х","й","з", "ъ","А","Б","Д","Э","Е","Ф","Г","Ҳ","И","Ж","К","Л","М","Н","О","П","Қ","Р","С","Т","У","В","Х","Й","З","Ъ", "Ы", "Ш","Ш", "Я"];
        $latin = ["Sh","Ya","ch", "o'", "sh", "yo","ya", "a","b","d","e","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","x","y","z", "'","A","B","D","E","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","X","Y","Z","'", "Y","Sh", "SH",'YA'];
        $text = str_replace( $cyrillic, $latin, $text);

        return $text;
    }
    public static function region($regionId)
    {
        $regionId = $regionId - 1;


        return $regionId;
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
        $condition = [];
        if ($regionId){
            $condition = ['regionId' => $regionId];
        }
        return ArrayHelper::map(self::find()->where($condition)->all(), 'id', Yii::t('app', $name));
    }

}
