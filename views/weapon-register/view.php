<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\WeaponRegister */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Weapon Registers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="weapon-register-view">

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
            'employee_id',
            'weapon_type',
            'caliber',
            'weapon_number',
            'count_given_magazine',
            'date_of_given',
            'count_returned_magazine',
            'date_of_returned',
            'notice:ntext',
            'created_at',
            'updated_at',
            'deleted_at',
        ],
    ]) ?>

</div>
