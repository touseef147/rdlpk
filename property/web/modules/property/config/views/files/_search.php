<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\propertyconfig\models\FilesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'street_id') ?>

    <?= $form->field($model, 'plot_detail_address') ?>

    <?php // echo $form->field($model, 'plot_size') ?>

    <?php // echo $form->field($model, 'size2') ?>

    <?php // echo $form->field($model, 'installment') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'modify_date') ?>

    <?php // echo $form->field($model, 'com_res') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'sector') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'shap_id') ?>

    <?php // echo $form->field($model, 'cstatus') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'fstatus') ?>

    <?php // echo $form->field($model, 'rstatus') ?>

    <?php // echo $form->field($model, 'bstatus') ?>

    <?php // echo $form->field($model, 'bid') ?>

    <?php // echo $form->field($model, 'atype') ?>

    <?php // echo $form->field($model, 'rownumber') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
