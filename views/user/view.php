<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\form\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            [                      // the owner name of the model
                'label' => 'Status',
                'value' => $model->status === 10 ? 'Active' : '-',
            ],
            [                      // the owner name of the model
                'label' => 'created_at',
                'value' => date('Y-m-d', $model->created_at) ,
            ],
            [                      // the owner name of the model
                'label' => 'updated_at',
                'value' => date('Y-m-d', $model->updated_at) ,
            ],
            [                      // the owner name of the model
                'label' => 'deleted_at',
                'value' => $model->deleted_at ? date('Y-m-d', $model->updated_at) : '-' ,
            ],
        ],
    ]) ?>

</div>
