<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\User;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class UserController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionCreate($userName, $userPass, $userEmail)
    {
        $model = new User();

        $model->email = $userEmail;
        $model->username = $userName;
        $model->setPassword($userPass);

        if ($model->save()) {
            print 'ok';
        } else {
            print implode(';'.PHP_EOL, $model->errors);
        }
    }

    public function actionUpdatePass(string $userName, string $newPass)
    {
        $model = User::findOne(['userName' => $userName]);
        $model->setPassword($newPass);

        if ($model->update()) {
            print 'ok';
        } else {
            print implode(';'.PHP_EOL, $model->errors);
        }
    }
}
