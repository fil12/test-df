<?php

use app\models\WeaponRegister;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\WeaponRegisterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Реєстр зброї';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weapon-register-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'employeeItn',
                'value' => function ($model) {
                    return $model->employee->itn;
                },
                'label' => 'ІПН'

            ],
            [
                'attribute' => 'employeeName',
                'value' => function ($model) {
                    return $model->employee->getFullName();
                },
                'label' => 'ПІБ'

            ],
            [
                'attribute' => 'type_name',
                'value' => 'weaponType.type_name',
                'label' => 'Тип зброї'
            ],

            [
                'attribute' => 'weaponType.caliber',
                'value' => function ($model) {
                    return $model->weaponType->caliber;
                }
            ],
            'weapon_number',
            //'count_given_magazine',
            //'date_of_given',
            //'count_returned_magazine',
            //'date_of_returned',
            //'notice:ntext',
            //'created_at',
            //'updated_at',
            //'deleted_at',
            [
                'class' => ActionColumn::class,
                'template' => '{view} {update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Yii::$app->user->can('rao') ? Html::a(
                            '<i class="fa fa-pencil"></i>',
                            ['weapon-register/update', 'id' => $model->id, 'employeeId'=>$model->employee->id],
                            [
                                'title' => 'contract',
                                'data-pjax' => '0'
                            ]
                        )
                            :
                            '';
                    },
                ],
                'urlCreator' => function ($action, WeaponRegister $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
