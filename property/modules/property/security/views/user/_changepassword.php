<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "", "title" => "Change Password"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
                <div class="row">
                    <div class="col-xs-6">
                        <?= $form->field($model, 'password')->passwordInput()->label('New Password') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
