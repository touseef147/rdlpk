<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\propertyconfig\models\MemberplotSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="memberplot-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'plot_id') ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'create_date') ?>

    <?= $form->field($model, 'modify_date') ?>

    <?php // echo $form->field($model, 'noi') ?>

    <?php // echo $form->field($model, 'insplan') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'fstatus') ?>

    <?php // echo $form->field($model, 'user_name') ?>

    <?php // echo $form->field($model, 'plotno') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'fcomment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
