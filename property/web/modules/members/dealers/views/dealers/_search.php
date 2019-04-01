<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\members\models\MembersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="members-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'mem_id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'sodowo') ?>

    <?php // echo $form->field($model, 'cnic') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'country_id') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'nomineename') ?>

    <?php // echo $form->field($model, 'nomineecnic') ?>

    <?php // echo $form->field($model, 'rwa') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'fp') ?>

    <?php // echo $form->field($model, 'login_status') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'modify_date') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'RFM') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
