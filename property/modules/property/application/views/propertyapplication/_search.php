<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\PropertyapplicationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="propertyapplication-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'application_id') ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'sales_center_id') ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'application_no') ?>

    <?php // echo $form->field($model, 'property_type') ?>

    <?php // echo $form->field($model, 'property_size') ?>

    <?php // echo $form->field($model, 'dealer_id') ?>

    <?php // echo $form->field($model, 'nominee_id') ?>

    <?php // echo $form->field($model, 'voucher_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
