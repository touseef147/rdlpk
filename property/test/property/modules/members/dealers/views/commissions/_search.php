<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\FmstransdetaildistSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fmstransdetaildist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'distribution_id') ?>

    <?= $form->field($model, 'trans_detail_id') ?>

    <?= $form->field($model, 'distributed_to_type') ?>

    <?= $form->field($model, 'distributed_to_id') ?>

    <?= $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
