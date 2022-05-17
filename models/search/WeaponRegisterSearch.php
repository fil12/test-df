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
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'employee_id', 'count_given_magazine', 'count_returned_magazine'], 'integer'],
            [['weapon_type', 'caliber', 'weapon_number', 'date_of_given', 'date_of_returned', 'notice', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

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

        $query->andFilterWhere(['like', 'weapon_type', $this->weapon_type])
            ->andFilterWhere(['like', 'caliber', $this->caliber])
            ->andFilterWhere(['like', 'weapon_number', $this->weapon_number])
            ->andFilterWhere(['like', 'notice', $this->notice]);

        return $dataProvider;
    }
}
