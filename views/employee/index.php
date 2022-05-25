<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\search\EmployeeSearch */

$this->title = 'Люди';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->user->can('hr') ? Html::a('Добавити людину', ['create'], ['class' => 'btn btn-success']) : '' ?>
    </p>

    <?php Pjax::begin(); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            ],            [
                'attribute' => 'departmentName',
                'value' => function ($model) {
                    return $model->department->name ?? null;
                },
                'label' => 'Назва підрозділу'

            ],
            'notice:ntext',
//            'deleted_at',
            [
                'class' => ActionColumn::class,
                'template' => '{contract} {view} {update} {delete}',
                'header'=>'Дії',
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
                    'delete' => function ($url, $model) {
                        return Yii::$app->user->can('hr') ? Html::a(
                            '<i class="fa fa-bucket"></i>',
                            ['employee/delete', 'id' => $model->id],
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
