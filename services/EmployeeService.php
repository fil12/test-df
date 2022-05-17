<?php

namespace app\services;

use app\models\Contract;
use app\models\Employee;
use app\models\enum\ContractStatusEnum;
use yii\web\Request;

class EmployeeService
{

    /**
     * @param int $id
     * @return Employee|null
     */
    public function findById(int $id): ?Employee
    {
        return Employee::findOne(['id' => $id]);
    }

    public function createEmployee(Request $request)
    {
        $model = new Employee();

        $model->load($request->post());
        $model->save();
        $model->refresh();

        $contract = new Contract();
        $contract->employee_id = $model->id;
        $contract->status = ContractStatusEnum::MISSING['value'];
        $contract->save();
        $contract->refresh();
        dd($model, $contract);

        return $model;
    }
}