<?php

use yii\db\Migration;

/**
 * Class m220512_140041_seeding_to_departments
 */
class m220512_140041_seeding_to_departments extends Migration
{
    private $data = [
        [
            'name'=>'1 рота'
        ],
        [
            'name'=>'Барвінок'
        ],
        [
            'name'=>'Башта',
        ],
        [
            'name'=>'БСШ № 1',
        ],
        [
            'name'=>'БСШ № 2',
        ],
        [
            'name'=>'Грінхілс',
        ],
        [
            'name'=>'Дзвінкове',
        ],
        [
            'name'=>'Жорнівка',
        ],
        [
            'name'=>'Забір\'я',
        ],
        [
            'name'=>'Заслон',
        ],
        [
            'name'=>'Інженерно-саперний взвод',
        ],
        [
            'name'=>'Княжичі',
        ],
        [
            'name'=>'Малютянка, С/Р',
        ],
        [
            'name'=>'Металеві меблі',
        ],
        [
            'name'=>'Новосілки',
        ],
        [
            'name'=>'Очисні',
        ],
        [
            'name'=>'П\'ятачок',
        ],
        [
            'name'=>'Патон',
        ],
        [
            'name'=>'Розвідка',
        ],
        [
            'name'=>'СПВБ',
        ],
        [
            'name'=>'Технікум',
        ],
        [
            'name'=>'Тролейбус',
        ],
        [
            'name'=>'Тягова',
        ],
        [
            'name'=>'Фора Ж/Д',
        ],
        [
            'name'=>'ЦНАП',
        ],
        [
            'name'=>'Шиномонтаж'
        ]
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220512_140041_seeding_to_departments cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220512_140041_seeding_to_departments cannot be reverted.\n";

        return false;
    }
    */
}
