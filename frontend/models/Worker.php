<?php

namespace frontend\models;

use common\models\City;
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
 */
class Worker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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
            [['userId','regionId','cityId', 'gender', 'nationality_id'], 'integer'],
            [['birthdate', 'created_at', 'updated_at'], 'safe'],
            [['firstname', 'lastname', 'patronymic', 'address', 'phone'], 'string', 'max' => 255],
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
    public function scenarios()
    {
        return ;
    }
}
