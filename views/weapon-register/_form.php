<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WeaponRegister */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weapon-register-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employee_id')->textInput() ?>

    <?= $form->field($model, 'weapon_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'caliber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weapon_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'count_given_magazine')->textInput() ?>

    <?= $form->field($model, 'date_of_given')->textInput() ?>

    <?= $form->field($model, 'count_returned_magazine')->textInput() ?>

    <?= $form->field($model, 'date_of_returned')->textInput() ?>

    <?= $form->field($model, 'notice')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
