<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\FmsaccountsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fmsaccounts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'acc_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'acc_code') ?>

    <?= $form->field($model, 'acc_title') ?>

    <?= $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
