<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\Installpayment */

$this->title = $model->id;
?>
<div class="installpayment-view">

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
            'ref',
            'plot_id',
            'payment_type',
            'paidamount',
            'dueamount',
            'discount',
            'surcharge',
            'lab',
            'paidsurcharge',
            'mem_id',
            'paidas',
            'detail',
            'date',
            'remarks',
            'others',
            'due_date',
            'paid_date',
            'fstatus',
            'fid',
        ],
    ]) ?>

</div>
