<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\propertyconfig\models\ProjectsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'project_name') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'teaser') ?>

    <?php // echo $form->field($model, 'details') ?>

    <?php // echo $form->field($model, 'project_image') ?>

    <?php // echo $form->field($model, 'project_map') ?>

    <?php // echo $form->field($model, 'land_map') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'modify_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
