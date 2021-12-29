<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "portfolio".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $subject
 * @property string|null $content
 */
class Portfolio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'portfolio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'subject'], 'required'],
            [['username', 'email', 'subject', 'content'], 'string', 'max' => 255],
            ['email','email']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'subject' => Yii::t('app', 'Subject'),
            'content' => Yii::t('app', 'Content'),
        ];
    }
    public function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
//                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([$user->email => Yii::$app->name . ' Xakimov Sardor'])
            ->setTo(Yii::$app->params['supportEmail'])
            ->setSubject($user->subject)
            ->setTextBody($user->content)
            ->send();
    }
}
