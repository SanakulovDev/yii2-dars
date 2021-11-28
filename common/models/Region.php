<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

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

    public static function cyrllat($text) {
        $text = trim($text);
        $cyrillic = ["а","б","д","э","е","ф","г","ҳ","и","ж","к","л","м","н","о","п","қ","р","с","т","у","в","х","й","з","ч", "ў", "ш", "ё","я", "ъ","А","Б","Д","Э","Е","Ф","Г","Ҳ","И","Ж","К","Л","М","Н","О","П","Қ","Р","С","Т","У","В","Х","Й","З","Ъ", "Ы", "Ш"];
        $latin = ["a","b","d","e","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","x","y","z", "ch", "o'", "sh", "yo", "ё", "'","A","B","D","E","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","X","Y","Z","'", "Y", "SH"];
        $text = str_replace($cyrillic, $latin ,$text);

        return $text;
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
