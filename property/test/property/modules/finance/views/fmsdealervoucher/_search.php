<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\FmsvoucherSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fmsvoucher-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'voucher_id') ?>

    <?= $form->field($model, 'voucher_type') ?>

    <?= $form->field($model, 'bank_id') ?>

    <?= $form->field($model, 'entry_date') ?>

    <?= $form->field($model, 'transaction_date') ?>

    <?php // echo $form->field($model, 'voucher_sr_no') ?>

    <?php // echo $form->field($model, 'sales_center_id') ?>

    <?php // echo $form->field($model, 'folio_no') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
