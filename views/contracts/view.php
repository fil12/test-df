<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contract */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Контракти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contract-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Оновити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'employee.last_name' => [
                'attribute' => 'employee.last_name',
                'value' => function ($model) {
                    return $model->employee->getFullName();
                }],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return \app\models\enum\ContractStatusEnum::getCurrentStatusTitle($model->status);
                }
            ],
            [
                    'attribute' => 'contract_date',
                'value' => $model->contract_date === null ? null : date('Y-m-d', $model->contract_date)
            ],

            [
                'attribute' =>  'termination_date',
                'value' => $model->termination_date === null ? null : date('Y-m-d', $model->termination_date)
            ],
            'termination_description',
            'weapon_number_contract',
            [
                'attribute' =>  'fastiv_formation',
                'value' => $model->fastiv_formation === null ? null : date('Y-m-d', $model->fastiv_formation)
            ],
            'notice:ntext',
//            'created_at',
//            'updated_at',
//            'deleted_at',
        ],
    ]) ?>

</div>
