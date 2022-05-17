<?php

use yii\db\Migration;

/**
 * Class m220502_114424_create_table_contratcs
 */
class m220502_114424_create_table_contracts extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%contracts}}', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->integer(11)->notNull()->unique(),
            'status' => $this->string(10)->notNull(),
            'contract_date' => $this->integer(),
            'termination_date' => $this->integer(),
            'termination_description' => $this->string(),
            'weapon_number_contract' => $this->string(20),
            'fastiv_formation' => $this->integer(),
            'notice' => $this->text(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
            'deleted_at' => $this->timestamp()->null()->defaultExpression('NULL')
        ], $tableOptions);

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-contract-employee_id',
            'contracts',
            'employee_id',
            'employees',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-contract-employee_id',
            'contracts'
        );

        $this->dropTable('{{%contracts}}');
    }
}
