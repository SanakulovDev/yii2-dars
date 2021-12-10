<?php

namespace api\modules\v1\models;

use api\models\Worker;
use common\models\User;
use frontend\models\SignupForm;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sign;
use Yii;

class V1Worker extends \frontend\models\Worker
{
    public $username;
    public $password;
    public $email;

    public function rules()
    {
        return [
            [['username', 'password',  'email'], 'required'],
            [['username', 'password',  'email'], 'string'],
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
            return $user;
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