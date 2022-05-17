<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee}}`.
 */
class m220426_200552_create_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employees}}', [
            'id' => $this->primaryKey(),
            'doc_number' => $this->integer(4)->notNull(),
            'itn' => $this->integer(11)->null(),
            'first_name' => $this->string(32)->notNull(),
            'second_name' => $this->string(32)->notNull(),
            'last_name' => $this->string(32)->notNull(),
            'pasport_number' => $this->string(32)->notNull(),
            'pasport_issued' => $this->string(255)->null(),
            'pasport_issued_date' => $this->timestamp()->null(),
            'numder_military_doc' => $this->string(255)->null(),
            'place_in_pasport' => $this->string(255)->null(),
            'real_place' => $this->string(255)->null(),
            'phone_number' => $this->string(12)->notNull(),
            'notice' => $this->text()->null(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
            'deleted_at' => $this->timestamp()->null()->defaultExpression('NULL')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employee}}');
    }
}
