<?php

use app\models\Contract;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контракти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'employee.full_name'
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return \app\models\enum\ContractStatusEnum::getCurrentStatusTitle($model->status);
                }
            ],

            [
                    'attribute' => 'contract_date',
                'value' => function ($model) {
                    return null !== $model->contract_date ? date('Y-m-d', $model->contract_date) : '-';
                }
            ],
            'termination_date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Contract $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{view} {update}',
                'header' => 'Дії',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Yii::$app->user->can('hr') ? Html::a(
                            '<i class="fa fa-pencil"></i>',
                            ['contracts/update', 'id' => $model->id],
                            [
                                'title' => 'contract',
                                'data-pjax' => '0'
                            ]
                        )
                            :
                            '';
                    },
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
