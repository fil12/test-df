<?php

use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contract */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-form">

    <?php $form = ActiveForm::begin();?>

    <?= $form->field($model, 'employee.last_name')->textInput(
            [
                    'value' => !empty($model->employee) ? $model->employee->getFullName() : ''
            ]) ?>

    <?=
    $form->field($model, 'status')->dropDownList(
        ArrayHelper::map(\app\models\enum\ContractStatusEnum::getAvailable(), 'value','title'),

    ); ?>

    <?= $form->field($model, 'contract_date')
        ->widget(
            DatePicker::class,
            [
                'name' => 'contract_date',
                'value' => date('Y-m-d', strtotime('+2 days')),
                'options' => ['placeholder' => 'Вибрати дату видачі зброї'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ])->label('Дата підписання контракту з обох сторін') ?>
    <?= $form->field($model, 'termination_date')
        ->widget(
            DatePicker::class,
            [
                'name' => 'termination_date',
                'value' => date('Y-m-d', strtotime('+2 days')),
                'options' => ['placeholder' => 'Вибрати дату видачі зброї'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ])->label('Дата розірвання контракту') ?>

    <?= $form->field($model, 'termination_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weapon_number_contract')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fastiv_formation')
        ->widget(
            DatePicker::class,
            [
                'name' => 'fastiv_formation',
                'value' => date('Y-m-d', strtotime('+2 days')),
                'options' => ['placeholder' => 'Вибрати дату видачі зброї'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ])->label('Формування на Фастів') ?>

    <?= $form->field($model, 'notice')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
