<?php

namespace app\models;

use app\behaviors\TrimBehavior;
use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property int $doc_number
 * @property int|null $itn
 * @property string $full_name
 * @property string $pasport_number
 * @property string|null $pasport_issued
 * @property string|null $pasport_issued_date
 * @property string|null $number_military_doc
 * @property string|null $place_in_pasport
 * @property string|null $real_place
 * @property string $phone_number
 * @property string|null $notice
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Contract $contract
 * @property Department $department
 * @property Department $detachedTo
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TrimBehavior::class,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doc_number',  'full_name'], 'required'],
            [['doc_number', 'itn'], 'integer'],
            [['notice'], 'string'],
            [['full_name', 'pasport_number'], 'string', 'max' => 50],
            [['pasport_issued', 'number_military_doc', 'place_in_pasport', 'real_place'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doc_number' => 'Номер посвідчення',
            'itn' => 'ІПН',
            'full_name' => 'ПІБ',
            'pasport_number' => 'Серія та номер паспорта',
            'pasport_issued' => 'Ким видан',
            'pasport_issued_date' => 'Дата видачі',
            'number_military_doc' => 'Номер війскового квитка',
            'place_in_pasport' => 'Місце реєстрації',
            'real_place' => 'Місце проживання',
            'phone_number' => 'Номер телефону',
            'department' => 'Підрозділ',
            'detached_to_department' => 'Відкомандирован до підрозділу',
            'notice' => 'Примітки',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\EmployeesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\EmployeesQuery(get_called_class());
    }

    /**
     * @return bool
     */
    public function softDelete(): bool
    {
        $this->deleted_at = (new \DateTime())->format('Y-m-d');

        return $this->save();
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContract(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Contract::class, ['employee_id' =>'id' ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeapons(): \yii\db\ActiveQuery
    {
        return $this->hasMany(WeaponRegister::class, ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Department::class, ['id'=> 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetachedTo(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Department::class, ['id' => 'detached_to_department']);
    }
}
