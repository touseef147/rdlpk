<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Secroletypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="secroletypes-form">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                    <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard">Home</a>
                    </li>
                    <li>
                                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security" class="ajaxlink">Security</a>
                    </li>
                    <li >
                                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secroletypes/index" class="ajaxlink">Summary</a>
                    </li>
                    <li class="active"><?= Html::encode($this->title) ?></li>
            </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

            <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secroletypes/sidebarinput">

                        <?php $form = ActiveForm::begin(['options'=>['class'=>'frminput']]); ?>

                        <?= $form->field($model, 'role_type_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role_type_so')->textInput() ?>

                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
            </div>
    </div>

</div>
