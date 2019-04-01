<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\visits\models\DailyvisitorsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dailyvisitors-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'class' => 'frmsearch',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'profession') ?>

    <?= $form->field($model, 'city') ?>

    <?= $form->field($model, 'contactno')->textInput() ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'refered_by') ?>

    <?php // echo $form->field($model, 'reference') ?>

    <?php // echo $form->field($model, 'reg_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
