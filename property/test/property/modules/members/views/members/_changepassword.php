<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/portal/dashboard/index">Home</a>
            </li>
            <li class="active">Change Password</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => "Change Password", "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput', 'enctype' => 'multipart/form-data']]); ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
               
              <div class="row">
                    <div class="col-xs-6">
                        CNIC.
                        <?= $model->cnic; ?>
                        
                    </div>
                </div>
                 <div class="row">
                    <div class="col-xs-6">
                        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'id' => 'oldpassword'])->label('Old Password') ?>
                    </div>
                </div>

               
                <br /> 




                <div class="row">
                    <div class="col-xs-6">
                     
                        <?= $form->field($model, 'password')->textInput(['maxlength' => true, 'id' => 'password']) ?>
                       <input type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'"> Show password
                       
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
