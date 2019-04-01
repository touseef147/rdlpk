<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\Fmsvoucherdetail */

$this->title = $model->voucher_detail_id;
?>
<div class="fmsvoucherdetail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->voucher_detail_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->voucher_detail_id], [
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
            'voucher_detail_id',
            'voucher_id',
            'application_id',
            'member_id',
            'plot_id',
            'membership_id',
            'account_id',
            'dr_amount',
            'cr_amount',
            'remarks',
        ],
    ]) ?>

</div>
