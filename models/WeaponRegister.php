<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "weapon_register".
 *
 * @property int $id
 * @property int $employee_id
 * @property string $weapon_type
 * @property string|null $caliber
 * @property string $weapon_number
 * @property int $count_given_magazine
 * @property string $date_of_given
 * @property int $count_returned_magazine
 * @property string $date_of_returned
 * @property string|null $notice
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Employee $employee
 */
class WeaponRegister extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weapon_register';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'weapon_type', 'weapon_number'], 'required'],
            [['employee_id', 'count_given_magazine', 'count_returned_magazine'], 'integer'],
            [['date_of_given', 'date_of_returned', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['notice'], 'string'],
            [['weapon_type'], 'string', 'max' => 10],
            [['caliber'], 'string', 'max' => 5],
            [['weapon_number'], 'string', 'max' => 20],
            [['weapon_number'], 'unique'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'weapon_type' => 'Weapon Type',
            'caliber' => 'Caliber',
            'weapon_number' => 'Weapon Number',
            'count_given_magazine' => 'Count Given Magazine',
            'date_of_given' => 'Date Of Given',
            'count_returned_magazine' => 'Count Returned Magazine',
            'date_of_returned' => 'Date Of Returned',
            'notice' => 'Notice',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\EmployeesQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\WeaponRegisterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\WeaponRegisterQuery(get_called_class());
    }
}
