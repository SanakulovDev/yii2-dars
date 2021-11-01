<?php

namespace frontend\models;

use common\models\City;
use common\models\Gender;
use common\models\Profession;
use common\models\Region;
use Yii;

/**
 * This is the model class for table "worker".
 *
 * @property int $id
 * @property int|null $userId
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $patronymic
 * @property string|null $birthdate
 * @property int|null $gender
 * @property int|null $nationality_id
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $photo
 * @property string $created_at
 * @property string $updated_at
 * @property string $hobby
 * @property string $profession_id
 */
class Worker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const SCENARIO_EDIT = 'edit';
    const SCENARIO_WORKEREDIT = 'worker-edit';
    public static function tableName()
    {
        return 'worker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId','regionId','cityId', 'gender', 'nationality_id','profession_id'], 'integer'],
            [['birthdate', 'created_at', 'updated_at'], 'safe'],
            [['firstname', 'lastname', 'patronymic', 'address', 'phone','hobby'], 'string', 'max' => 255],
            [['photo'],'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, svg, ttif']
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
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'regionId' => Yii::t('app', 'Region ID'),
            'cityId' => Yii::t('app', 'City ID'),
            'patronymic' => Yii::t('app', 'Patronymic'),
            'birthdate' => Yii::t('app', 'Birthdate'),
            'gender' => Yii::t('app', 'Gender'),
            'nationality_id' => Yii::t('app', 'Nationality ID'),
            'profession_id' => Yii::t('app', 'Profession'),
            'hobbby' => Yii::t('app', 'Hobby'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'photo' => Yii::t('app', 'Photo'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    public function getRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'regionId']);
    }
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'cityId']);
    }
    public function getGenders()
    {
        return $this->hasOne(Gender::class, ['id' => 'gender']);
    }
    public function getProfessions()
    {
        return $this->hasOne(Profession::class, ['id' => 'profession_id']);
    }


    public function scenarios()
    {
        return [
            self::SCENARIO_EDIT=>['firstname','lastname','regionId','cityId','address','patronymic','nationality_id','birthdate',
                'gender','phone','photo','hobby','profession_id'
                ],
            self::SCENARIO_WORKEREDIT=>['firstname','lastname','regionId','cityId','address','patronymic','nationality_id','birthdate',
                'gender','phone','photo','hobby','profession_id'
                ],
            self::SCENARIO_WORKERLANG=>['hobby','profession_id']

        ];
    }

    public function upload($image)
    {
        if ($image) {
            $dir = Yii::getAlias('@frontend')."/web/uploads/user/";
            $image_name = time();
            $image_name .= '.'.$image->extension;
            if ($image->saveAs($dir.$image_name)) {
                $this->photo = $image_name;
                return true;
            }
        }

        return false;
    }

}
