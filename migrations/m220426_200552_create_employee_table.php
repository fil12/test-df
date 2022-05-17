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
            'itn' => $this->bigInteger()->null(),
            'full_name' => $this->string(50)->notNull(),
            'pasport_number' => $this->string(32)->null(),
            'pasport_issued' => $this->string(255)->null(),
            'pasport_issued_date' => $this->timestamp()->null(),
            'number_military_doc' => $this->string(255)->null(),
            'place_in_pasport' => $this->string(255)->null(),
            'real_place' => $this->string(255)->null(),
            'phone_number' => $this->string(12)->null(),
            'department_id' => $this->integer(11),
            'detached_to_department' => $this->integer(11),
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
        $this->dropTable('{{%employees}}');
    }
}
