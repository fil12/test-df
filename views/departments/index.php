<?php

use app\models\Department;
use app\models\enum\DepartmentStatusEnum;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Підрозділи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Додоти підрозділ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=

    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'commander',
                'format' => 'raw',
                'value' => function ($model) {
                    if (isset($model->commander)) {
                        return Html::a($model->commander->full_name ?? null, '/employee/view?id=' . $model->commander->id);
                    } else {
                        return null;
                    }
                }
            ],
            'city',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return DepartmentStatusEnum::getCurrentStatusTitle($model->status);
                }
            ],
            //'notice:ntext',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update}',
                'urlCreator' => function ($action, Department $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
