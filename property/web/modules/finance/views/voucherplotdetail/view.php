<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\application\Fmsvoucherplotdetail */

$this->title = $model->voucher_plot_detail_id;
?>
<div class="fmsvoucherplotdetail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->voucher_plot_detail_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->voucher_plot_detail_id], [
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
            'voucher_plot_detail_id',
            'voucher_id',
            'application_id',
            'member_id',
            'plot_id',
            'membership_id',
            'serial_no',
            'amount',
        ],
    ]) ?>

</div>
