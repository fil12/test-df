<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\base\InvalidArgumentException;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\web\NotFoundHttpException;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class RbacController extends Controller
{

    public function actionIndex()
    {
        $message = '
            
        ';
        echo $message . "\n";

        return ExitCode::OK;
    }

    /**
     * create a role action;
     * for creating need enter role name and role description like property for command
     * example: php yii rbac/create-role hp-spec "HR-specialist"
     */
    public function actionCreateRole($roleName, $roleDescription)
    {
        try {
            $role = Yii::$app->authManager->createRole($roleName);
            $role->description = $roleDescription;
            if (Yii::$app->authManager->add($role)) {
                print sprintf("Role with name - %s and description: %s was created.", $roleName, $roleDescription);
            }
        } catch (\Throwable $e) {
            print $e->getMessage();
        }

        return true;
    }
    /**
     * create a permission action;
     * for creating need enter permission name and permission description like property for command
     * example: php yii rbac/create-permission deleteEmployee "Deleteing employee"
     */
    public function actionCreatePermission($permissionName, $permissionDescription)
    {
        try {
            $permit = Yii::$app->authManager->createPermission($permissionName);
            $permit->description = $permissionDescription;
            if (Yii::$app->authManager->add($permit)) {
                print sprintf("Permission with name - %s and description: %s was created.", $permissionName, $permissionDescription);
            }
        } catch (\Throwable $e) {
            print $e->getMessage();
        }

        return true;
    }

    /**
     * @param $roleName
     * @param $userId
     * @return bool
     * @throws \Exception
     */
    public function actionAssignRole($roleName, $userId): bool
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($roleName);

        return empty($auth->assign($role, $userId));
    }

    public function actionAddChildRole(string $roleName, string $roleChildName)
    {
        $roleMain = Yii::$app->authManager->getRole($roleName);
        $roleChild = Yii::$app->authManager->getRole($roleChildName);
        if (empty($roleMain)) {
            throw new NotFoundHttpException(sprintf('Unable to find role with name %s', $roleName));
        } elseif (empty($roleChild)) {
            throw new NotFoundHttpException(sprintf('Unable to find role with name %s', $roleChildName));
        }

        Yii::$app->authManager->addChild($roleMain, $roleChild);
    }
}
