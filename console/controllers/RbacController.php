<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        
        // add "createPost" permission
        $company_permission = $auth->createPermission('company_permission');
        $company_permission->description = 'Company permission';
        $auth->add($company_permission);

        // add "updatePost" permission
        $worker_permission = $auth->createPermission('worker_permission');
        $worker_permission->description = 'worker permission';
        $auth->add($worker_permission);

        $universal_permission = $auth->createPermission('universal_permission');
        $universal_permission->description = 'worker permission';
        $auth->add($universal_permission);

        // add "author" role and give this role the "createPost" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);

        // add "admin" role and give this role the "worker_permission" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($author, 2);
        $auth->assign($admin, 1);
    }
}