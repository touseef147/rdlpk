<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\Propertytransferfees */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="propertytransferfees-form">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard">Home</a>
            </li>
            <li>
                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property\config" class="ajaxlink">Property\config</a>
            </li>
            <li >
                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/transferfees/index" class="ajaxlink">Summary</a>
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
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/transferfees/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>

                <div class="row">
                    <div class="col-xs-6">
                        <?php
                        echo $form->field($model, 'project_id')
                                ->dropDownList(
                                        ArrayHelper::map(\app\models\application\Projects::find()->joinWith("permissions")->orderBy("projects.project_name")->where(['project_permissions.user_id' => Yii::$app->user->identity->id])->all(), 'id', 'project_name'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select Project',
                                        ]    // options
                        );
                        ?></div>
                    <div class="col-xs-3">
                        <?php
                        echo $form->field($model, 'plot_size')
                                ->dropDownList(
                                        ArrayHelper::map(app\models\application\Sizecat::find()->all(), 'id', 'size'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select a Size']    // options
                        );
                        ?>
                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'amount')->textInput() ?>

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
