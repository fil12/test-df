<?php

use yii\db\Migration;

/**
 * Class m220428_131212_add_roles
 */
class m220428_131212_add_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $roleAdmin = Yii::$app->authManager->createRole('admin');
        $roleAdmin->description = 'Админ';
        Yii::$app->authManager->add($roleAdmin);

        $roleHr = Yii::$app->authManager->createRole('hr');
        $roleHr->description = 'HR-відділ';
        Yii::$app->authManager->add($roleHr);
        $roleOd = Yii::$app->authManager->createRole('od');
        $roleOd->description = 'оперативний відділ';
        Yii::$app->authManager->add($roleOd);
        $roleRao = Yii::$app->authManager->createRole('rao');
        $roleRao->description = 'РАО';
        Yii::$app->authManager->add($roleRao);
        $roleMtz = Yii::$app->authManager->createRole('mtz');
        $roleMtz->description = 'відділ матеріальнотехнічного забезпечення';
        Yii::$app->authManager->add($roleMtz);

        Yii::$app->authManager->addChild($roleAdmin, $roleHr);
        Yii::$app->authManager->addChild($roleAdmin, $roleOd);
        Yii::$app->authManager->addChild($roleAdmin, $roleRao);
        Yii::$app->authManager->addChild($roleAdmin, $roleMtz);

        Yii::$app->authManager->assign($roleAdmin, 1);
        Yii::$app->authManager->assign($roleRao, 3);
        Yii::$app->authManager->assign($roleHr, 4);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->authManager->removeAllRoles();

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220428_131212_add_roles cannot be reverted.\n";

        return false;
    }
    */
}
