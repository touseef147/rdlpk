<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\PropertyjointmembersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="propertyjointmembers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'joint_ms_id') ?>

    <?= $form->field($model, 'application_id') ?>

    <?= $form->field($model, 'membership_id') ?>

    <?= $form->field($model, 'plot_id') ?>

    <?= $form->field($model, 'member_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
