<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "property", "title" => "Property"],
            ["link" => "property/config", "title" => "Configuration"],
            ["link" => "property/config/categories/index", "title" => "Categories"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">

            <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/categories/sidebarinput">
            <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput', 'enctype' => 'multipart/form-data']])
            ?>
            <?php
            //echo $form->errorSummary($model);
            ?>
            <div class="col-xs-3">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-xs-3">

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-xs-3">
                <?= $form->field($model, 'file')->fileInput() ?>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div></div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

</div>
