<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\security\models\SecpagecategoriesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="secpagecategories-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'category_title') ?>

    <?= $form->field($model, 'sort_order') ?>

    <?= $form->field($model, 'module_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
