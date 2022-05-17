<?php

use app\models\Department;
use app\models\enum\DepartmentStatusEnum;
use yii\db\Migration;

/**
 * Class m220512_140041_seeding_to_departments
 */
class m220512_140041_seeding_to_departments extends Migration
{
    private $data = [
        [
            'name' => '1 рота',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => '2 рота',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'Барвінок',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'Башта',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'БСШ № 1',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'БСШ № 2',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'Грінхілс',
            'dislocation' => 'Тарасівка'
        ],
        [
            'name' => 'Дзвінкове',
            'dislocation' => 'Дзвінкове'
        ],
        [
            'name' => 'Жорнівка',
            'dislocation' => 'Жорнівка'
        ],
        [
            'name' => 'Забір\'я',
            'dislocation' => 'Забір\'я'
        ],
        [
            'name' => 'Заслон',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'Інженерно-саперний взвод',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'Княжичі',
            'dislocation' => 'Княжичі'
        ],
        [
            'name' => 'Коменд.взвод',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'Малютянка, С/Р',
            'dislocation' => 'Малютянка'
        ],
        [
            'name' => 'Металеві меблі',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'Новосілки',
            'dislocation' => 'Новосілки'
        ],
        [
            'name' => 'Очисні',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'П\'ятачок',
            'dislocation' => 'Тарасівка'
        ],
        [
            'name' => 'Патон',
            'dislocation' => 'Малютянка'
        ],
        [
            'name' => 'Розвідка',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'СПВБ',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'Технікум',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'Тролейбус',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'Тягова',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'Фора Ж/Д',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'ЦНАП',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'Шиномонтаж',
            'dislocation' => 'Боярка'
        ],
        [
            'name' => 'Штаб',
            'dislocation' => 'Боярка'
        ]
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        foreach ($this->data as $item) {
            $department = new Department();
            $department->name = $item['name'];
            $department->city = $item['dislocation'];
            $department->status = DepartmentStatusEnum::ACTIVE['value'];

            $department->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220512_140041_seeding_to_departments cannot be reverted.\n";

        return true;
    }
}
