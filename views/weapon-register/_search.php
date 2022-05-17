<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\WeaponRegisterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weapon-register-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'employee_id') ?>

    <?= $form->field($model, 'weapon_type') ?>

    <?= $form->field($model, 'caliber') ?>

    <?= $form->field($model, 'weapon_number') ?>

    <?php // echo $form->field($model, 'count_given_magazine') ?>

    <?php // echo $form->field($model, 'date_of_given') ?>

    <?php // echo $form->field($model, 'count_returned_magazine') ?>

    <?php // echo $form->field($model, 'date_of_returned') ?>

    <?php // echo $form->field($model, 'notice') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
