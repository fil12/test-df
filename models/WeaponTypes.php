<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "weapon_types".
 *
 * @property int $id
 * @property string $type_name
 * @property string|null $caliber
 */
class WeaponTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weapon_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_name'], 'required'],
            [['type_name'], 'string', 'max' => 20],
            [['caliber'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_name' => 'Тип зброї',
            'caliber' => 'Калібр',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\WeaponTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\WeaponTypesQuery(get_called_class());
    }

    /**
     * @return array
     */
    public static function getTypeList(): array
    {
        return WeaponTypes::find()->all();
    }
}
