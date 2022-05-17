<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%weapon_registr}}`.
 */
class m220504_125302_create_weapon_register_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%weapon_register}}', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->integer(11)->notNull(),
            'weapon_type' => $this->string(10)->notNull(),
            'caliber' => $this->string(5),
            'weapon_number' => $this->string(20)->notNull()->unique(),
            'count_given_magazine' => $this->integer(2)->notNull()->defaultValue(0),
            'date_of_given' => $this->timestamp()->notNull()->notNull(),
            'count_returned_magazine' => $this->integer(2)->notNull()->defaultValue(0),
            'date_of_returned' => $this->timestamp(),
            'notice' => $this->text()->null(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
            'deleted_at' => $this->timestamp()->null()->defaultExpression('NULL')
        ]);


        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-weapon_register-employee_id',
            'weapon_register',
            'employee_id',
            'employees',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-weapon_register-employee_id',
            'weapon_register'
        );

        $this->dropTable('{{%weapon_register}}');
    }
}
