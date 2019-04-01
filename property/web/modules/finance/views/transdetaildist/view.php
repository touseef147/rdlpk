<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\application\Fmstransdetaildist */

$this->title = $model->distribution_id;
?>
<div class="fmstransdetaildist-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->distribution_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->distribution_id], [
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
            'distribution_id',
            'trans_detail_id',
            'distributed_to_type',
            'distributed_to_id',
            'dr_amount',
            'remarks',
        ],
    ]) ?>

</div>
