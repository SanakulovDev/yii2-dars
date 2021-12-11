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

    public function rules()
    {
        return [
            [['username', 'password', 'email','firstname','lastname','hobby','photo'], 'required'],
            [['username', 'password', 'email','firstname','lastname','hobby','photo'], 'string'],
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
            $image = UploadedFile::getInstance($worker, 'photo');
            vd($user->role);
            $worker->userId = $user->id;
            $worker->firstname = $this->firstname;
            $worker->lastname = $this->lastname;
            $worker->hobby = $this->hobby;
            if ($this->upload($image) && $worker->save())
                return true;
        }
        return false;
    }

    public function upload($image)
    {
        if ($image) {
            $dir = Yii::getAlias('@frontend') . "/web/uploads/user/";
            $image_name = time();
            $image_name .= '.' . $image->extension;
            if ($image->saveAs($dir . $image_name)) {
                $this->photo = $image_name;
                return true;
            }
        }

        return false;
    }
}