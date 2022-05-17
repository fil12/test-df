<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contracts".
 *
 * @property int $id
 * @property int $employee_id
 * @property string $status
 * @property int $contract_date
 * @property int $termination_date
 * @property string|null $termination_description
 * @property string|null $weapon_number_contract
 * @property int $fastiv_formation
 * @property string|null $notice
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 *
 * @property Employee $employee
 */
class Contract extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contracts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'status', 'contract_date', 'termination_date', 'fastiv_formation', 'created_at', 'updated_at'], 'required'],
            [['employee_id', 'contract_date', 'termination_date', 'fastiv_formation', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['notice'], 'string'],
            [['status'], 'string', 'max' => 10],
            [['termination_description'], 'string', 'max' => 255],
            [['weapon_number_contract'], 'string', 'max' => 20],
            [['employee_id'], 'unique'],
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
            'status' => 'Status',
            'contract_date' => 'Contract Date',
            'termination_date' => 'Termination Date',
            'termination_description' => 'Termination Description',
            'weapon_number_contract' => 'Weapon Number Contract',
            'fastiv_formation' => 'Fastiv Formation',
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
     * @return \app\models\query\ContractsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ContractsQuery(get_called_class());
    }
}
