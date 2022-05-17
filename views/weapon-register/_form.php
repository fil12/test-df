<?php

use app\models\WeaponTypes;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WeaponRegister */
/* @var $employee app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weapon-register-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employee_id')->hiddenInput(['value' => $employee->id])->label('') ?>

    <?=  $form->field($model, 'weapon_type_id')->widget(Select2::class, [
        'data' => ArrayHelper::map(WeaponTypes::getTypeList()->all(), 'id', 'type_name'),
        'language' => 'ua',
        'options' => ['placeholder' => 'Вибрати тип зброї'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'weapon_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'count_given_magazine')->textInput() ?>

    <?= $form->field($model, 'date_of_given')
        ->widget(
            DatePicker::class,
            [
                'name' => 'date_of_given',
                'value' => date('Y-m-d', strtotime('+2 days')),
                'options' => ['placeholder' => 'Вибрати дату видачі зброї'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ])->label('Дата Видачі') ?>
    <?= $form->field($model, 'count_returned_magazine')->textInput() ?>

    <?= $form->field($model, 'date_of_returned')
        ->widget(
            DatePicker::class,
            [
                'name' => 'date_of_returned',
                'value' => date('Y-m-d', strtotime('+2 days')),
                'options' => ['placeholder' => 'Вибрати дату повернення зброї'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ])->label('Дата Видачі') ?>

    <?= $form->field($model, 'notice')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
