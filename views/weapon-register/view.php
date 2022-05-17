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
        <?= Html::a('Оновити дані про зброю', ['update', 'id' => $model->id, 'employeeId' => $model->employee->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'Людина',
                'value' => $model->employee->getFullName()
            ],
            [
                'attribute' => 'Тип зброї',
                'value' => $model->weaponType->type_name
            ],
            [
                'attribute' => 'caliber',
                'value' => $model->weaponType->caliber
            ],
            'weapon_number',
            'count_given_magazine',
            'date_of_given',
            'count_returned_magazine',
            'date_of_returned',
            'notice:ntext',
        ],
    ]) ?>

</div>
