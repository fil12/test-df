<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Department */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Підрозділ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="department-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Оновити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'commander.full_name',
            [
                'attribute' => 'commander.phone_number',
                'value' => '+38 0' . $model->commander->phone_number
            ],
            'city',
            [
                'attribute' => 'status',
                'value' => \app\models\enum\DepartmentStatusEnum::getCurrentStatusTitle($model->status)
            ],
            'notice:ntext',
        ],
    ]) ?>

    <h3>Люди в підрозділі</h3>
    <?=
    GridView::widget([
        'dataProvider' => $members,
        'tableOptions' => [
            'class' => 'table-responsive  table-striped table-bordered text-justify text-center'
        ],
        'options' => [],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'doc_number',
            'itn',
            'full_name',
            'passport_number',
            'real_place',
            [
                'attribute' => 'phone_number',
                'value' => function ($model) {
                    return '0' . $model->phone_number;
                }
            ],
            [
                'attribute' => 'departmentName',
                'value' => function ($model) {
                    return $model->department->name ?? null;
                },
                'label' => 'назва підрозділу'

            ],
            'notice:ntext',
//            'deleted_at',
            [
                'class' => ActionColumn::class,
                'template' => '{contract} {view}',
                'header' => 'Дії',
                'buttons' => [
                    'contract' => function ($url, $model) {

                        return Html::a('<i class="fa fa-file"></i>',
                            ['contracts/view', 'id' => $model->contract->id],
                            [
                                'title' => 'contract',
                                'data-pjax' => '0'
                            ]
                        );
                    },
                    'update' => function ($url, $model) {
                        return Yii::$app->user->can('hr') ? Html::a(
                            '<i class="fa fa-pencil"></i>',
                            ['employee/update', 'id' => $model->id],
                            [
                                'title' => 'contract',
                                'data-pjax' => '0'
                            ]
                        )
                            :
                            '';
                    },
                    'view' => function ($url, $model) {
                        return Yii::$app->user->can('hr') ? Html::a(
                            '<i class="fa fa-eye"></i>',
                            ['employee/' . $model->id],
                            [
                                'title' => 'view',
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

</div>
