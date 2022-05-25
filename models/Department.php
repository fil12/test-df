<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property int $id
 * @property string $name
 * @property int|null $commander_id
 * @property string|null $city
 * @property int|null $status
 * @property string|null $notice
 *
 * @property Employee[] $members
 * @property Employee   $commander
 * @property Employee[] $detachedMembers
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['commander_id', 'status'], 'integer'],
            [['notice'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['city'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назва підрозділу',
            'commander_id' => 'Идентифікатор командира',
            'commander' => 'Командир підрозділу',
            'city' => 'Місто базування',
            'status' => 'Статус',
            'notice' => 'Примітки',
        ];
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\EmployeesQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Employee::className(), ['department_id' => 'id']);
    }

    /**
     * Gets query for [[Employees0]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\EmployeesQuery
     */
    public function getDetachedMembers()
    {
        return $this->hasMany(Employee::className(), ['detached_to_department' => 'id']);
    }

    public function getCommander()
    {
        return $this->hasOne(Employee::class, ['id' => 'commander_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\DepartmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\DepartmentQuery(get_called_class());
    }
}
