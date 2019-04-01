<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\visits\models\Visitdetails */

$this->title = $model->id;
?>
<div class="visitdetails-view">

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
            'visitors_id',
            'visit_no',
            'visit_type',
            'visit_date',
            'deal_by',
            'next_visit',
            'followup_status',
            'remarks',
            'center_id',
        ],
    ]) ?>

</div>
