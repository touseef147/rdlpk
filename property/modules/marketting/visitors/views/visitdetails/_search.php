<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\visits\models\VisitdetailssSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visitdetails-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'visitors_id') ?>

    <?= $form->field($model, 'visit_no') ?>

    <?= $form->field($model, 'visit_type') ?>

    <?= $form->field($model, 'visit_date') ?>

    <?php // echo $form->field($model, 'deal_by') ?>

    <?php // echo $form->field($model, 'next_visit') ?>

    <?php // echo $form->field($model, 'followup_status') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'center_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
