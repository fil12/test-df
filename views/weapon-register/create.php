<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WeaponRegister */

$this->title = 'Create Weapon Register';
$this->params['breadcrumbs'][] = ['label' => 'Weapon Registers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weapon-register-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
