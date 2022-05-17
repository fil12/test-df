<?php

use yii\db\Migration;

/**
 * Class m220512_134927_added_foreing_key_employees_departments
 */
class m220512_134927_added_foreing_key_employees_departments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-employee_department_id',
            'employees',
            'department_id',
            'departments',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-employee_detached_to_department',
            'employees',
            'detached_to_department',
            'departments',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-employee_department_id',
            'employees'
        );

        $this->dropForeignKey(
            'fk-employee_detached_to_department',
            'employees'
        );
    }
}
