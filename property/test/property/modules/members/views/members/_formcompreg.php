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
                <a class="ajaxlink" href="<?php //echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/portal/dashboard/index">Home</a>
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
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                            </div>
                            <div class="col-xs-4">
                                <?php
                                echo $form->field($model, 'rwa')
                                        ->dropDownList(
                                        \app\models\application\Members::Relationslist(), // Flat array ('id'=>'label')
                                                ['prompt' => 'Select a Relation',
                                                ]    // options
                                );
                                ?>

                            </div>
                            <div class="col-xs-4">
                                <?= $form->field($model, 'sodowo')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                <div class="row">
                    <div class="col-xs-3">

                        <?= $form->field($model, 'dob')->textInput(['class' => 'date-picker']) ?>

                    </div>


                    <div class="col-xs-3">
                        <?= $form->field($model, 'cnic')->textInput(['maxlength' => true]) ?>

                    </div>

                    <div class="col-xs-3">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                    </div>

                    <div class="col-xs-3">
                        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                    </div>
                    <div class="col-xs-3">
                        <?php
                        echo $form->field($model, 'country_id')
                                ->dropDownList(
                                        ArrayHelper::map(Country::find()->all(), 'id', 'country'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select a Country',
                                    'onchange' => ' 
                                                    $.get( "' . Url::toRoute('/members/members/ddcontrollercities') . '", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                            $( "#' . Html::getInputId($model, 'city_id') . '" ).html( data );
                                                        }
                                                    );',
                                        ]    // options
                        );
                        ?>
                    </div>
                    <div class="col-xs-3">
                        <?php
                        echo $form->field($model, 'city_id')
                                ->dropDownList(
                                        ArrayHelper::map(City::find()->where(['country_id' => $model->country_id])->all(), 'id', 'city'), // Flat array ('id'=>'label')
                                        // Flat array ('id'=>'label')
                                        ['prompt' => 'Select a City']    // options
                        );
                        ?>
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
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
