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
        <?php
        if (Yii::$app->user->can('hr')) {
            echo Html::a('Обновити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo Html::a('Видалити', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Ви впевненні що хочите видалити людину?',
                    'method' => 'post',
                ],
            ]);
        }
        echo "<br><br>";
        if (Yii::$app->user->can('rao')) {
            echo Html::a('Додати зброю', ['weapon-register/create', 'employeeId' => $model->id], ['class' => 'btn btn-primary']);

        }
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'doc_number',
            'itn',
            'full_name',
            'pasport_number',
            'pasport_issued',
            'pasport_issued_date',
            'number_military_doc',
            'place_in_pasport',
            'real_place',
            'phone_number',
            [
                'attribute' => 'department.name',
                'value' => $model->department->name ?? null
            ],
            [
                'attribute' => 'detached_to.name',
                'value' => $model->department->name ?? null
            ],
            'notice:ntext',
//            'created_at',
//            'updated_at',
//            'deleted_at',
        ],
    ]) ?>
    <h2>Контракт</h2>

    <?= DetailView::widget([
        'model' => $model->contract,
        'attributes' => [
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return \app\models\enum\ContractStatusEnum::getCurrentStatusTitle($model->status);
                }
            ],
            'contract_date',
            'termination_date',
            'termination_description',
            'weapon_number_contract',
            'fastiv_formation',
            'notice:ntext',
        ],
    ]) ?>

    <h2>Зброя</h2>
    <?php foreach ($model->weapons as $k => $weapon) {

        echo "<h4>Порядковий номер:" . ++$k . "</h4>";

        echo DetailView::widget([
            'model' => $weapon,
            'attributes' => [

                [
                    'attribute' => 'weaponType.type_name',
                    'value' => $weapon->weaponType->type_name
                ],
                [
                    'attribute' => 'caliber',
                    'value' => $weapon->weaponType->caliber
                ],
                'weapon_number',
                'count_given_magazine',
                'date_of_given',
                'count_returned_magazine',
                'date_of_returned',
                'notice:ntext',
            ],
        ]);
        echo "<hr>";
    } ?>

</div>
