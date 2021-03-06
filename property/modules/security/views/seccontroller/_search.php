<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\security\models\SeccontrollerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seccontroller-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'controller_id') ?>

    <?= $form->field($model, 'module_id') ?>

    <?= $form->field($model, 'controller_code') ?>

    <?= $form->field($model, 'controller_name') ?>

    <?= $form->field($model, 'sort_order') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
