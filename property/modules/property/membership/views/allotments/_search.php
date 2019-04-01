<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\PropertymembershipsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="propertymemberships-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ms_id') ?>

    <?= $form->field($model, 'plot_id') ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'ms_no') ?>

    <?= $form->field($model, 'ms_status') ?>

    <?php // echo $form->field($model, 'created_on') ?>

    <?php // echo $form->field($model, 'modified_on') ?>

    <?php // echo $form->field($model, 'is_joint') ?>

    <?php // echo $form->field($model, 'parent_ms_id') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
