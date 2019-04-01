<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\visits\models\InterestbookingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="interestbooking-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'visitors_id') ?>

    <?= $form->field($model, 'com_res') ?>

    <?= $form->field($model, 'size2') ?>

    <?= $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'booking_date') ?>

    <?php // echo $form->field($model, 'no_of_plots') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'deal_by') ?>

    <?php // echo $form->field($model, 'center_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
