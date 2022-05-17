<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property int $doc_number
 * @property int|null $itn
 * @property string $first_name
 * @property string $second_name
 * @property string $last_name
 * @property string $pasport_number
 * @property string|null $pasport_issued
 * @property string|null $pasport_issued_date
 * @property string|null $numder_military_doc
 * @property string|null $place_in_pasport
 * @property string|null $real_place
 * @property string $phone_number
 * @property string|null $notice
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doc_number', 'first_name', 'second_name', 'last_name', 'pasport_number', 'phone_number'], 'required'],
            [['doc_number', 'itn'], 'integer'],
            [['pasport_issued_date', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['notice'], 'string'],
            [['first_name', 'second_name', 'last_name', 'pasport_number'], 'string', 'max' => 32],
            [['pasport_issued', 'numder_military_doc', 'place_in_pasport', 'real_place'], 'string', 'max' => 255],
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
            'first_name' => 'Ім\'я',
            'second_name' => 'По батькові',
            'last_name' => 'Фамілія',
            'pasport_number' => 'Серія та номер паспорта',
            'pasport_issued' => 'Ким видан',
            'pasport_issued_date' => 'Дата видачі',
            'numder_military_doc' => 'Номер війскового квитка',
            'place_in_pasport' => 'Місце реєстрації',
            'real_place' => 'Місце проживання',
            'phone_number' => 'Номер телефону',
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

    public function softDelete()
    {
        $this->deleted_at = (new \DateTime())->format('Y-m-d');

        return true;
    }

    public function search($params)
    {
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'creation_date', $this->creation_date]);

        return $dataProvider;
    }
}
