<?php

namespace frontend\models;

use common\models\City;
use common\models\Region;
use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property int $userId
 * @property string|null $name
 * @property string|null $director_name
 * @property int|null $regionId
 * @property int|null $cityId
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $logo
 * @property int|null $status
 * @property string $date
 * @property string|null $created_At
 * @property string|null $updated_At
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $email;
    public $username;
    public $password;
    public $image;

    const SCENARIO_UPDATE='login';
    const SCENARIO_SIGNUP='signup';
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'username','password','regionId','cityId','status','director_name','phone'],'required'],
            [['userId', 'regionId', 'cityId', 'status'], 'integer'],
            [['date', 'created_At', 'updated_At'], 'safe'],
            [['name', 'username'], 'string', 'max' => 35],
            [['director_name','username'], 'string', 'max' => 50],
            [['address', 'logo'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 30],
            [['email'], 'email'],
            [['password'],'string'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, svg, ttif']
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
            'name' => Yii::t('app', 'Company name'),
            'director_name' => Yii::t('app', 'Director Name'),
            'regionId' => Yii::t('app', 'Region'),
            'cityId' => Yii::t('app', 'City'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'image' => Yii::t('app', 'image'),
            'status' => Yii::t('app', 'Status'),
            'date' => Yii::t('app', 'Date'),
            'created_At' => Yii::t('app', 'Created  At'),
            'updated_At' => Yii::t('app', 'Updated  At'),
        ];
    }

    public function upload($image)     
    {
        if ($image !== null) {
            $dir = Yii::getAlias('@frontend')."/web/uploads/company/";
            $image_name = $this->name."_".time();
            $image_name .= '.'.$image->extension;
            if ($image->saveAs($dir.$image_name)) {
                $this->logo = $image_name;
                return true;
            }
        }

        return false;
    }
    public function getRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'regionId']);
    }
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'cityId']);
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_UPDATE => ['name','director_name','phone','regionId','cityId','address','image'],
            self::SCENARIO_SIGNUP => ['name','director_name','phone','regionId','cityId','address','image','username','password','email']
        ];
    }

    public function qrcode()
    {

    }

}
