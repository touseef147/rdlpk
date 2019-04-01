<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\Membersdealergroups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="membersdealergroups-form">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard">Home</a>
            </li>
            <li>
                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/owners" class="ajaxlink">Owners Control Panel</a>
            </li>
            <li >
                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/owners/family/index" class="ajaxlink">Summary</a>
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
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/owners/family/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>
                        <?= $form->field($model, 'group_for')->hiddenInput()->label(FALSE) ?>

                <div class="row">
                    <div class="col-xs-12">
                        <?= $form->field($model, 'group_title')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?php
//                        echo $form->field($model, 'default_dealer')
//                                ->dropDownList(
//                                        ArrayHelper::map(\app\models\application\Members::find()->where(['is_dealer'=>1])->all(), 'id', 'name'), // Flat array ('id'=>'label')
//                                        ['prompt' => 'Select a Dealer',
//                                        ]    // options
//                        );
                        ?>

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
