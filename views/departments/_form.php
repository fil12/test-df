<?php

use app\models\Department;
use app\models\Employee;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Department */
/* @var $form yii\widgets\ActiveForm */
/* @var $employees  */
?>

<div class="department-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?=  $form->field($model, 'commander_id')->widget(Select2::class, [
        'data' => $employees,
        'language' => 'ua',
        'options' => ['placeholder' => 'Вибрати підрозділ'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Командир підрозділу'); ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'notice')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
