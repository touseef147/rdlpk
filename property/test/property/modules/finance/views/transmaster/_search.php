<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\FmstransmasterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fmstransmaster-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'trans_id') ?>

    <?= $form->field($model, 'serial_no') ?>

    <?= $form->field($model, 'trans_type') ?>

    <?= $form->field($model, 'trans_date') ?>

    <?= $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'entered_by') ?>

    <?php // echo $form->field($model, 'ref_no') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
