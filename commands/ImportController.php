<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Contract;
use app\models\Employee;
use app\models\enum\ContractStatusEnum;
use moonland\phpexcel\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\web\NotFoundHttpException;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ImportController extends Controller
{

    private $pathToFile;

    public function actionIndex()
    {
        $message = '
            
        ';
        echo $message . "\n";

        return ExitCode::OK;
    }

    public function actionEmployees()
    {
        $filePath = 'web/peoples.xlsx';

        $reader = new Xlsx();
        $spreadsheet = $reader->load($filePath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheetData as $k=>$item) {
            if ($k<=0 || $k>1712) {
                continue;
            }

            $employee = new Employee();
            $employee->doc_number = $item[0];
            $employee->full_name = $item[4];
            $employee->place_in_pasport = $item[9];
            $employee->real_place = $item[9];
            $employee->pasport_number = $item[11];
            $employee->number_military_doc = $item[12];
            $employee->phone_number = $item[13];
            $employee->itn = $item[10] ?? 0;
            $employee->notice = $item[17];

            if ($employee->validate()) {
                try {
                    $employee->save();
                    $employee->refresh();

                    $contract = new Contract();
                    $contract->employee_id = $employee->id;
                    $contract->contract_date = !empty($item[1]) ? (new \DateTime($item[1]))->getTimestamp() : null;
                    $contract->termination_date = !empty($item[2]) ? (new \DateTime($item[2]))->getTimestamp() : null;
                    $contract->fastiv_formation = !empty($item[3]) ? (new \DateTime($item[3]))->getTimestamp() : null;
                    $contract->weapon_number_contract = (string) $item[15] ?? '';
                    $contract->status = !empty($item[1]) ? ContractStatusEnum::TRANSFERRED['value'] : ContractStatusEnum::MISSING['value'];
                    if ($contract->validate()) {
                        $contract->save();
                    } else {
                        dump($item, $contract->errors);
                    }
                } catch (\Throwable $e) {
                    dd($e->getMessage());
                }
            } else {
                dump($item, $employee->errors);
            }
        }

        print 'all done!';
        return true;
    }

    public function actionWeaponRegister()
    {
        $filePath = 'web/peoples.xlsx';

        $reader = new Xlsx();
        $spreadsheet = $reader->load($filePath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
    }



    /**
     * create a permission action;
     * for creating need enter permission name and permission description like property for command
     * example: php yii rbac/create-permission deleteEmployee "Deleteing employee"
     */
    public function actionCreatePermission($permissionName, $permissionDescription)
    {
        try {
            $permit = Yii::$app->authManager->createPermission($permissionName);
            $permit->description = $permissionDescription;
            if (Yii::$app->authManager->add($permit)) {
                print sprintf("Permission with name - %s and description: %s was created.", $permissionName, $permissionDescription);
            }
        } catch (\Throwable $e) {
            print $e->getMessage();
        }

        return true;
    }

    /**
     * @param $roleName
     * @param $userId
     * @return bool
     * @throws \Exception
     */
    public function actionAssignRole($roleName, $userId): bool
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($roleName);

        return empty($auth->assign($role, $userId));
    }

    public function actionAddChildRole(string $roleName, string $roleChildName)
    {
        $roleMain = Yii::$app->authManager->getRole($roleName);
        $roleChild = Yii::$app->authManager->getRole($roleChildName);
        if (empty($roleMain)) {
            throw new NotFoundHttpException(sprintf('Unable to find role with name %s', $roleName));
        } elseif (empty($roleChild)) {
            throw new NotFoundHttpException(sprintf('Unable to find role with name %s', $roleChildName));
        }

        Yii::$app->authManager->addChild($roleMain, $roleChild);
    }
}
