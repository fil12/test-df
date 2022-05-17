<?php

use app\models\Employee;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'doc_number',
            'itn',
//            'first_name',
//            'second_name',
            'last_name',
            'pasport_number',
            'real_place',
            'phone_number',
            'notice:ntext',
            'deleted_at',
            [
                'class' => ActionColumn::class,
                'template' => '{contract} {view} {update} {delete}',

                'buttons' => ['contract' => function ($url, $model) {

                    return Html::a('<i class="fa fa-file"></i>',
                        ['contracts/update', 'id' => $model->contract->id],
                        [
                                'title' => 'contract',
                                'data-pjax' => '0'
                        ]
                    );
                }]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
