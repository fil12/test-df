<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WeaponRegister */
/* @var $employee app\models\Employee */

$this->title = 'Оновити дані: ' . $model->employee->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Реєстр зброї', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Оновити дані про зброю';
?>
<div class="weapon-register-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'employee' => $employee
    ]) ?>

</div>
