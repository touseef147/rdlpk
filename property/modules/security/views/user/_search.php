<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\security\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'firstname') ?>

    <?= $form->field($model, 'middelname') ?>

    <?= $form->field($model, 'lastname') ?>

    <?= $form->field($model, 'pic') ?>

    <?php // echo $form->field($model, 'sodowo') ?>

    <?php // echo $form->field($model, 'cnic') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'zip') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'per1') ?>

    <?php // echo $form->field($model, 'per2') ?>

    <?php // echo $form->field($model, 'per3') ?>

    <?php // echo $form->field($model, 'per4') ?>

    <?php // echo $form->field($model, 'per5') ?>

    <?php // echo $form->field($model, 'per6') ?>

    <?php // echo $form->field($model, 'per7') ?>

    <?php // echo $form->field($model, 'per8') ?>

    <?php // echo $form->field($model, 'per9') ?>

    <?php // echo $form->field($model, 'per10') ?>

    <?php // echo $form->field($model, 'per11') ?>

    <?php // echo $form->field($model, 'per12') ?>

    <?php // echo $form->field($model, 'per13') ?>

    <?php // echo $form->field($model, 'per14') ?>

    <?php // echo $form->field($model, 'per15') ?>

    <?php // echo $form->field($model, 'per16') ?>

    <?php // echo $form->field($model, 'per17') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'fp') ?>

    <?php // echo $form->field($model, 'login_status') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'modify_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
