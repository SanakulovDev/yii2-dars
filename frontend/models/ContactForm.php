<?php

namespace frontend\models;

use common\models\Appeals;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $firstname;
    public $lastname;
    public $email;
    public $subject;
    public $message;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['firstname', 'lastname', 'email', 'subject', 'message'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'firstname' => 'Firstname',
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Signs contact up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */




    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->firstname])
            ->setSubject($this->subject)
            ->setTextBody($this->message)
            ->send();
    }
}
