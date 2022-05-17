<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WeaponRegister;

/**
 * WeaponRegisterSearch represents the model behind the search form of `app\models\WeaponRegister`.
 */
class WeaponRegisterSearch extends WeaponRegister
{
    public $type_name;
    public $employeeName;
    public $employeeItn;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'employee_id', 'count_given_magazine', 'count_returned_magazine'], 'integer'],
            [['type_name', 'employeeName', 'employeeItn', 'caliber', 'weapon_number', 'date_of_given', 'date_of_returned', 'notice', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = WeaponRegister::find();
        $query->joinWith(['weaponType', 'employee']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->sort->attributes['type_name'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['weapon_types.type_name' => SORT_ASC],
            'desc' => ['weapon_types.type_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['employeeName'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['employees.last_name' => SORT_ASC],
            'desc' => ['employees.last_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['employeeItn'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['weapon_types.type_name' => SORT_ASC],
            'desc' => ['weapon_types.type_name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'count_given_magazine' => $this->count_given_magazine,
            'date_of_given' => $this->date_of_given,
            'count_returned_magazine' => $this->count_returned_magazine,
            'date_of_returned' => $this->date_of_returned,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);
//dump($this->weaponType);
        $query->andFilterWhere(['=', 'weapon_types.type_name', $this->type_name])
            ->andFilterWhere(['like', 'employees.last_name', $this->employeeName])
            ->andFilterWhere(['like', 'employees.itn', $this->employeeItn])
            ->andFilterWhere(['like', 'caliber', $this->caliber])
            ->andFilterWhere(['like', 'weapon_number', $this->weapon_number])
            ->andFilterWhere(['like', 'notice', $this->notice]);

        return $dataProvider;
    }
}
