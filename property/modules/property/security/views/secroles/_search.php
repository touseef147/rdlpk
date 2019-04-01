<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\security\models\SecrolesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="secroles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'role_id') ?>

    <?= $form->field($model, 'role_type_id') ?>

    <?= $form->field($model, 'role_category_id') ?>

    <?= $form->field($model, 'role_name') ?>

    <?= $form->field($model, 'role_so') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
