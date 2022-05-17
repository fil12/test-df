<?php

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

    <?= $form->field($model, 'contract_date')->textInput() ?>

    <?= $form->field($model, 'termination_date')->textInput() ?>

    <?= $form->field($model, 'termination_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weapon_number_contract')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fastiv_formation')->textInput() ?>

    <?= $form->field($model, 'notice')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
