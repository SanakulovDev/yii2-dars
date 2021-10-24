<?php

namespace frontend\models;
use frontend\models\Company;
use frontend\models\Vacancy;
use Yii;

/**
 * This is the model class for table "apply_vacancy".
 *
 * @property int $id
 * @property int $vacancy_id
 * @property int $company_id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $rezume
 * @property string|null $purpose
 *
 * @property Company $company
 * @property Vacancy $vacancy
 */
class ApplyVacancy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apply_vacancy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'email', 'rezume','purpose'], 'required'],
            [['vacancy_id', 'company_id'], 'integer'],
            [['purpose'], 'string'],
            [['rezume'],'file','extensions' => ['pdf', 'docx', 'rar', 'doc','jpeg','jpg','png'], 'maxSize' => 1024 * 1024 * 4],
            [['firstname', 'lastname', 'email', 'rezume', ], 'string','min'=>'1', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['vacancy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vacancy::className(), 'targetAttribute' => ['vacancy_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'vacancy_id' => Yii::t('app', 'Vacancy ID'),
            'company_id' => Yii::t('app', 'Company ID'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'email' => Yii::t('app', 'Email'),
            'rezume' => Yii::t('app', 'Rezume'),
            'purpose' => Yii::t('app', 'Purpose'),
        ];
    }

    public function upload($image)
    {
        if ($image) {
            $dir = Yii::getAlias('@frontend')."/web/uploads/apply/";
            $image_name = "apply_vacancy_".time();
            $image_name .= '.'.$image->extension;
            if ($image->saveAs($dir.$image_name)) {
                $this->rezume = $image_name;
                return true;
            }
        }

        return false;
    }
    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * Gets query for [[Vacancy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVacancy()
    {
        return $this->hasOne(Vacancy::className(), ['id' => 'vacancy_id']);
    }
}
