<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Propertyapplicationpchoices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="propertyapplicationpchoices-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "finance", "title" => "Property"],
            ["link" => "finance/config", "title" => "Configuration"],
            ["link" => "", "title" => "Files"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

            <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/propertyapplicationpchoices/sidebarinput">

                        <?php $form = ActiveForm::begin(['options'=>['class'=>'frminput']]); ?>

                                            <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'application_id')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'category_id')->textInput() ?>

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
