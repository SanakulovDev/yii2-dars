<?php

namespace frontend\models;

use common\models\City;
use common\models\Gender;
use common\models\JobType;
use common\models\Profession;
use common\models\Region;
use common\models\User;
use Yii;

/**
 * This is the model class for table "vacancy".
 *
 * @property int $id
 * @property int $company_id
 * @property int $user_id
 * @property int $profession_id
 * @property string $description_uz
 * @property string $description_ru
 * @property string $description_en
 * @property string $descrition_cyrl
 * @property int|null $job_type_id
 * @property int $region_id
 * @property int $city_id
 * @property string $image
 * @property int $count_vacancy
 * @property int|null $salary
 * @property int|null $gender
 * @property string|null $experience
 * @property string|null $telegram
 * @property string|null $address
 * @property int|null $views
 * @property int|null $status
 * @property string|null $deadline
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property JobType $jobType
 * @property Profession $profession
 * @property User $user
 */
class Vacancy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacancy';
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'user_id', 'profession_id', 'description_uz', 'description_ru', 'description_en', 'description_cyrl', 'region_id', 'city_id', 'image', 'count_vacancy'], 'required'],
            [['company_id', 'user_id', 'profession_id', 'job_type_id', 'region_id', 'city_id', 'count_vacancy', 'salary', 'gender', 'views', 'status'], 'integer'],
            [['deadline', 'created_at', 'updated_at'], 'safe'],
            [['description_uz', 'description_ru', 'description_en', 'description_cyrl'], 'string', 'max' => 255],
            ['image', 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'svg'], 'maxSize' => 1024 * 1024 * 4],
            [['experience'], 'string', 'max' => 250],
            [['telegram'], 'string', 'max' => 70],
            [['address'], 'string', 'max' => 150],
            [['job_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobType::className(), 'targetAttribute' => ['job_type_id' => 'id']],
            [['profession_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profession::className(), 'targetAttribute' => ['profession_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_id' => Yii::t('app', 'Company name'),
            'user_id' => Yii::t('app', 'User ID'),
            'profession_id' => Yii::t('app', 'Profession name'),
            'description_uz' => Yii::t('app', 'Description Uz'),
            'description_ru' => Yii::t('app', 'Description Ru'),
            'description_en' => Yii::t('app', 'Description En'),
            'descrition_cyrl' => Yii::t('app', 'Descrition Cyrl'),
            'job_type_id' => Yii::t('app', 'Job Type '),
            'region_id' => Yii::t('app', 'Region name'),
            'city_id' => Yii::t('app', 'City namae'),
            'image' => Yii::t('app', 'Image upload'),
            'count_vacancy' => Yii::t('app', 'Count Vacancy'),
            'salary' => Yii::t('app', 'Salary'),
            'gender' => Yii::t('app', 'Gender'),
            'experience' => Yii::t('app', 'Experience'),
            'telegram' => Yii::t('app', 'Telegram'),
            'address' => Yii::t('app', 'Address'),
            'views' => Yii::t('app', 'Views'),
            'status' => Yii::t('app', 'Status'),
            'deadline' => Yii::t('app', 'Deadline'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
//    public function beforeSave($insert)
//    {
//        $this->deadline = date('Y-m-d', strtotime($this->deadline));
//        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
//    }
//
//    public function afterFind()
//    {
//        $this->deadline = strtotime($this->deadline);
//        $this->deadline = date('d.m.Y', $this->deadline);
//        return parent::afterFind(); // TODO: Change the autogenerated stub
//    }
    /**
     * Gets query for [[JobType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobType()
    {
        return $this->hasOne(JobType::className(), ['id' => 'job_type_id']);
    }
    public function getGenders()
    {
        return $this->hasOne(Gender::className(), ['id' => 'gender']);
    }

    /**
     * Gets query for [[Profession]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfession()
    {
        return $this->hasOne(Profession::className(), ['id' => 'profession_id']);
    }
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'region_id']);
    }
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    public function upload($image)
    {
        if ($image) {
            $dir = Yii::getAlias('@frontend')."/web/uploads/vacancy/";
            $image_name = "vacancy_".time();
            $image_name .= '.'.$image->extension;
            if ($image->saveAs($dir.$image_name)) {
                $this->image = $image_name;
                return true;
            }
        }

        return false;
    }
}
