<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%weapon_types}}`.
 */
class m220509_084745_create_weapon_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%weapon_types}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%weapon_types}}');
    }
}
