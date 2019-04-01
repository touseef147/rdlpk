<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Propertydoccategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="propertydoccategories-form">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                    <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard">Home</a>
                    </li>
                    <li>
                                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=documents" class="ajaxlink">Documents</a>
                    </li>
                    <li >
                                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=documents/propertydoccategories/index" class="ajaxlink">Summary</a>
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
                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=documents/propertydoccategories/sidebarinput">

                        <?php $form = ActiveForm::begin(['options'=>['class'=>'frminput']]); ?>

                                            <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'category_title')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'sort_order')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'path')->textInput(['maxlength' => true]) ?>

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
