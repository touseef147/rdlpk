<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Projectpermissions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projectpermissions-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "property", "title" => "Property"],
            ["link" => "property/config", "title" => "Configuration"],
            ["link" => "property/config/projectpermissions/index", "title" => "Project Permissions"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

            <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=propertyconfig/projectpermissions/sidebarinput">

                        <?php $form = ActiveForm::begin(['options'=>['class'=>'frminput']]); ?>

                                            <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'user_id')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'project_id')->textInput() ?>

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
