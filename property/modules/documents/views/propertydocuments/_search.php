<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\PropertydocumentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="propertydocuments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'document_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'file_name') ?>

    <?= $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'project_id') ?>

    <?php // echo $form->field($model, 'sales_center_id') ?>

    <?php // echo $form->field($model, 'membership_id') ?>

    <?php // echo $form->field($model, 'entered_by') ?>

    <?php // echo $form->field($model, 'entry_date') ?>

    <?php // echo $form->field($model, 'application_id') ?>

    <?php // echo $form->field($model, 'plot_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
