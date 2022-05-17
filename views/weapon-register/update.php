<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WeaponRegister */

$this->title = 'Update Weapon Register: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Weapon Registers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="weapon-register-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
