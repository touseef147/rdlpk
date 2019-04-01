<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\security\models\SecmoduleactionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="secmoduleactions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'action_id') ?>

    <?= $form->field($model, 'module_id') ?>

    <?= $form->field($model, 'action_title') ?>

    <?= $form->field($model, 'action_so') ?>

    <?= $form->field($model, 'action_detail') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
