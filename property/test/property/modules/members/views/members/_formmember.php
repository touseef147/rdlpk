<?php

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\application\City;
use app\models\application\Country;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Members */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="members-form">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <!--            <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a class="ajaxlink" href="<?php //echo Yii::$app->urlManager->baseUrl;    ?>/index.php?r=members/portal/dashboard/index">Home</a>
                        </li>-->
            <li class="active">Member Registration</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => "Member Registration", "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput', 'enctype' => 'multipart/form-data']])
                ?>
                <div class="row">
                    <div class="col-xs-4">
                    </div>
                    <div class="col-xs-4">
                        <div class="row">
                            <div class="col-xs-12">
                                Name
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(FALSE) ?>

                            </div>
                            <div class="col-xs-12">
                                Email
                                <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(FALSE) ?>

                            </div>

                            <div class="col-xs-12">
                                Contact #: <span class="red">(923001234567)</span>
                                <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->label(FALSE) ?>
                            </div>

                            <div class="col-xs-12">
                                Activate Using<br />
                                <select id="activationmethod" name="activationmethod">
                                    <option>SMS</option>
                                    <option>Email</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr"></div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group pull-right">
                                    <?= Html::submitButton($model->isNewRecord ? 'Register' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-round' : 'btn btn-primary btn-round']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
