<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\ChargesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="charges-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'note') ?>

    <?= $form->field($model, 'monthly') ?>

    <?= $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'project_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
