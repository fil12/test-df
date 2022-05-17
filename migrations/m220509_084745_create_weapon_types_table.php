<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%weapon_types}}`.
 */
class m220509_084745_create_weapon_types_table extends Migration
{
    /**
     * @var string[]
     */
    private  $typeNames = [
        "РПГ7" => '',
        "АГС17" => '30',
        "Кул НСВ" => '12,7',
        "Кул ПКМБ" => "7,62х54",
        "Кул ПКМ " => "7,62х54",
        "Кул РПК " => "7,62х39",
        "Кул РПК74"=> "5,45",
        "АКМ" => "7,62х39",
        "АК74" => "5,45",
        "АКСУ"=> "5,45",
        "Гв. СВД" => "7,62х54",
        "Гв. БАРРЕТ" => "12,7",
        "Гвинт Манлихер SSG" => "308",
        "Прилад ПБС-1" => '',
        "піст ТТ" => '7,62',
        "піст АПС" => "9" ,
        "піст ПМ" => "9",
        "машинка для заряджання кул.",
        "граната ПГ-7" => "40",
        "міна ТМ-62" => '',
        "міна МОН90" => '',
        "Н7,62х54 ЛПС" => '7,62х54',
        "Н7,62х54 БЗ" => '7,62х54',
        "Н7,62 ПС" => '7,62',
        "Н5,45 ПС" => '5,45',
        "Н5,45 ТР" => '5,45',
        "Н7,62х25" => '7,62х25',
        "Граната Ф1" => '',
        "Граната РГО" => '',
        "Граната РКГ" => '',
        "30мм ВОГ-17М" => '30',
        "Набої 12,7 МДЗ" => '12,7',
        "тротил шашка 200-400гр" => ''
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%weapon_types}}', [
            'id' => $this->primaryKey(),
            'type_name' => $this->string(20)->notNull(),
            'caliber' => $this->string(10)->null()
        ]);

        foreach ($this->typeNames as $name=>$caliber) {
            $model = new \app\models\WeaponTypes();

            $model->type_name = $name;
            $model->caliber = $caliber;
            $model->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%weapon_types}}');
    }
}
