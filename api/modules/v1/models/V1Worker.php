<?php

namespace api\modules\v1\models;

use api\models\Worker;
use common\models\User;
use frontend\models\SignupForm;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sign;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class V1Worker extends Model
{
    public $username;
    public $password;
    public $email;
    public $firstname;
    public $lastname;
    public $hobby;
    public $photo;
    public $professionId;

    public function rules()
    {
        return [
            [['username', 'password', 'email','firstname','lastname','hobby','professionId'], 'required'],
            ['professionId','integer'],
            [['username', 'password', 'email','firstname','lastname','hobby','photo'], 'string'],
            ['photo','file','extensions'=>'jpg, jpeg, png, svg, ttif']
        ];
    }

    /**
     * @throws \Exception
     */
    public function workerAdd()
    {
        $user = new SignupForm();
        $worker = new Worker();
        $user->username = $this->username;
        $user->password = $this->password;
        $user->email = $this->email;
        $user->role = 'worker';
        if ($user = $user->signup()) {
           $worker->firstname = $this->firstname;
           $worker->lastname = $this->lastname;
           $worker->hobby = $this->hobby;
           $worker->profession_id = $this->professionId;
           $this->photo = UploadedFile::getInstanceByName('photo');
           if ($worker->upload($this->photo) && $worker->save(false)){
               return "Ma'lumotlar saqlandi";
           }
        }
        return false;
    }


}