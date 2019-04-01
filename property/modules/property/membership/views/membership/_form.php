<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Plots */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plots-form">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                    <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard">Home</a>
                    </li>
                    <li>
                                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property\membership" class="ajaxlink">Property\membership</a>
                    </li>
                    <li >
                                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/membership/index" class="ajaxlink">Summary</a>
                    </li>
                    <li class="active"><?= Html::encode($this->title) ?></li>
            </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">

            <div class="page-header">
                    <h1>
                        <?= Html::encode($this->title) ?>
                            <small>
                                    <i class="ace-icon fa fa-angle-double-right"></i>
                                                                </small>
                    </h1>
            </div><!-- /.page-header -->

            <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/membership/sidebarinput">

                        <?php $form = ActiveForm::begin(['options'=>['class'=>'frminput']]); ?>

                                            <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'project_id')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'street_id')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'plot_detail_address')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'plot_size')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'size2')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'installment')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'create_date')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'modify_date')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'com_res')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'category_id')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'sector')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'shap_id')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'cstatus')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'fstatus')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'rstatus')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'bstatus')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'bid')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'atype')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'rownumber')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'application_id')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'ms_member_id')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'ms_creation_date')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'ms_modification_date')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'ms_status')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'ms_no')->textInput(['maxlength' => true]) ?>

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
