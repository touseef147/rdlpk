<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\FmsvoucherdetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fmsvoucherdetail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'voucher_detail_id') ?>

    <?= $form->field($model, 'voucher_id') ?>

    <?= $form->field($model, 'application_id') ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'plot_id') ?>

    <?php // echo $form->field($model, 'membership_id') ?>

    <?php // echo $form->field($model, 'account_id') ?>

    <?php // echo $form->field($model, 'dr_amount') ?>

    <?php // echo $form->field($model, 'cr_amount') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
