<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Люди', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевненні що хочите видалити людину?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'doc_number',
            'itn',
            'first_name',
            'second_name',
            'last_name',
            'pasport_number',
            'pasport_issued',
            'pasport_issued_date',
            'numder_military_doc',
            'place_in_pasport',
            'real_place',
            'phone_number',
            'notice:ntext',
//            'created_at',
//            'updated_at',
//            'deleted_at',
        ],
    ]) ?>

</div>
