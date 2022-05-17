<?php

namespace app\services;

use app\models\Employee;
use app\models\WeaponRegister;
use yii\web\Request;

class WeaponService
{
    /** @var EmployeeService */
    private $employeeService;

    /**
     * @param EmployeeService $employeeService
     */
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function createRecord(Request $request, ?int $employeeId): WeaponRegister
    {
        if ($request->isPost){
            $model = $this->addWeaponToEmployee($request, $employeeId);
        } else {
            $model = new WeaponRegister();
            $model->loadDefaultValues();
        }

        return $model;

    }

    protected function addWeaponToEmployee(Request $request, int $employeeId): WeaponRegister
    {
        $weapon = new WeaponRegister();
        $weapon->load($request->post());
        $weapon->employee_id = $employeeId;
        $weapon->save();
        $weapon->refresh();

        return $weapon;
    }

    public function getEmployeeForWeapon(int $employeeId): Employee
    {
        return $this->employeeService->findById($employeeId);
    }
}