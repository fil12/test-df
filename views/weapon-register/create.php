<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WeaponRegister */
/* @var $employee app\models\Employee */

$this->title = 'Додати зброю: '. $employee->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Реєстр зброї', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weapon-register-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'employee' => $employee
    ]) ?>

</div>
