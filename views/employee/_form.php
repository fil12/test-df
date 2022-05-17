<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'doc_number')->textInput()->label('Номер посвідчення') ?>

    <?= $form->field($model, 'itn')->textInput()->label('ІПН') ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true])->label("Ім'я") ?>

    <?= $form->field($model, 'second_name')->textInput(['maxlength' => true])->label('По батькові') ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true])->label('Фамілія') ?>

    <?= $form->field($model, 'pasport_number')->textInput(['maxlength' => true])->label('Серія та номер паспорту') ?>

    <?= $form->field($model, 'pasport_issued')->textInput(['maxlength' => true])->label('Ким видан') ?>

    <?= $form->field($model, 'pasport_issued_date')
        ->widget(
                DatePicker::class,
                [
                    'name' => 'pasport_issued_date',
                    'value' => date('Y-m-d', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Select issue date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ])->label('Дата Видачі') ?>

    <?= $form->field($model, 'numder_military_doc')->textInput(['maxlength' => true])->label('Номер Війскового') ?>

    <?= $form->field($model, 'place_in_pasport')->textInput(['maxlength' => true])->label('Місце реєстрації') ?>

    <?= $form->field($model, 'real_place')->textInput(['maxlength' => true])->label('Місце проживання') ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true])->label('Номер телефону')->hint('у фарматі 0501001010') ?>

    <?= $form->field($model, 'notice')->textarea(['rows' => 6])->label('Примітки') ?>

    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php $this->registerJs(
        '$(function () {
            $(".dynamicform_inner").on("afterInsert", function(e, item) {
                 $( ".picker" ).each(function() {
                    $( this ).datepicker({
                    dateFormat : "Y-m-d",
                    language : "en",
                    changeMonth: true,
                    changeYear: true
                  });
                });
            });
        });'
    ); ?>
</div>
