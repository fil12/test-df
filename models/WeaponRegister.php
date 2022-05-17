<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "weapon_register".
 *
 * @property int $id
 * @property int $employee_id
 * @property string $weapon_type_id
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
 * @property WeaponTypes $weaponType
 */
class WeaponRegister extends \yii\db\ActiveRecord
{
//    public $weaponType;
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
            [['employee_id', 'weapon_type_id', 'weapon_number'], 'required'],
            [['employee_id', 'count_given_magazine', 'count_returned_magazine'], 'integer'],
            [['date_of_given', 'date_of_returned', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['notice'], 'string'],
            [['caliber'], 'string', 'max' => 5],
            [['weapon_number'], 'string', 'max' => 20],
            [['weapon_number'], 'unique'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['weapon_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WeaponTypes::className(), 'targetAttribute' => ['employee_id' => 'id']],
        ];
    }

    /**
     * @return array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Идентифікатор людини',
            'weapon_type_id' => 'Тип зброї',
            'caliber' => 'Калібр',
            'weapon_number' => 'Номер зброї',
            'count_given_magazine' => 'Кількість віданих магазинів',
            'date_of_given' => 'Дата видачі',
            'count_returned_magazine' => 'Кількість поверненних магазинів',
            'date_of_returned' => 'Дата повернення',
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
     * @return \yii\db\ActiveQuery
     */
    public function getWeaponType(): \yii\db\ActiveQuery
    {
        return $this->hasOne(WeaponTypes::class, ['id' => 'weapon_type_id']);
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
