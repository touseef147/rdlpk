<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\FmsvoucherplotdetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fmsvoucherplotdetail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'voucher_plot_detail_id') ?>

    <?= $form->field($model, 'voucher_id') ?>

    <?= $form->field($model, 'application_id') ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'plot_id') ?>

    <?php // echo $form->field($model, 'membership_id') ?>

    <?php // echo $form->field($model, 'serial_no') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
