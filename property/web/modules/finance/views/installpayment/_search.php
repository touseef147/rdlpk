<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\InstallpaymentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="installpayment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ref') ?>

    <?= $form->field($model, 'plot_id') ?>

    <?= $form->field($model, 'payment_type') ?>

    <?= $form->field($model, 'paidamount') ?>

    <?php // echo $form->field($model, 'dueamount') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'surcharge') ?>

    <?php // echo $form->field($model, 'lab') ?>

    <?php // echo $form->field($model, 'paidsurcharge') ?>

    <?php // echo $form->field($model, 'mem_id') ?>

    <?php // echo $form->field($model, 'paidas') ?>

    <?php // echo $form->field($model, 'detail') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'others') ?>

    <?php // echo $form->field($model, 'due_date') ?>

    <?php // echo $form->field($model, 'paid_date') ?>

    <?php // echo $form->field($model, 'fstatus') ?>

    <?php // echo $form->field($model, 'fid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
