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
            [['employee_id', 'status' ], 'required'],
            [['employee_id', 'contract_date', 'termination_date', 'fastiv_formation', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['notice'], 'string'],
            [['status'], 'integer'],
            [['termination_description'], 'string', 'max' => 255],
            [['weapon_number_contract'], 'string', 'max' => 50],
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
            'employee_id' => 'Ідентифікатор людини',
            'status' => 'Статус',
            'contract_date' => 'Дата підпиcання контракту',
            'termination_date' => 'Дата розірвання контракту',
            'termination_description' => 'Причина розірвання контракту',
            'weapon_number_contract' => 'Номер зброї у контракті',
            'fastiv_formation' => 'Формування на фастів',
            'notice' => 'Примітки',
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
