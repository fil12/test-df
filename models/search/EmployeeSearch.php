<?php

namespace app\models\search;

use app\models\Employee;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class EmployeeSearch extends Employee
{
    public $departmentName;
    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['itn', 'doc_number'], 'integer'],
            [['full_name', 'passport_number', 'phone_number', 'departmentName'], 'safe'],
        ];
    }

    /**
     * @return array|array[]
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Employee::find()
            ->innerJoinWith('contract', true)
            ->joinWith('department', true);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
                'pageSize' => 100
            ]
        ]);



        $dataProvider->sort->attributes['departmentName'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['departments.name' => SORT_ASC],
            'desc' => ['departments.name' => SORT_DESC],
        ];

        $this->load($params);
        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['itn' => $this->itn]);
        $query->andFilterWhere(['doc_number' => $this->doc_number]);
        $query->andFilterWhere(['departments.name' => $this->departmentName]);
        $query->andFilterWhere(['like', 'full_name', $this->full_name]);
        $query->andFilterWhere(['like', 'passport_number', $this->passport_number]);
        $query->andFilterWhere(['like', 'phone_number', $this->phone_number]);

        return $dataProvider;
    }
}