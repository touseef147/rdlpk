<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\application\Country;

/* @var $this yii\web\View */
/* @var $model app\models\application\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "general", "title" => "Configuration"],
            ["link" => "general/city/index", "title" => "Cities"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=general/city/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>
                <div class="col-xs-3">
                    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?></div>


                <div class="col-xs-3">
                    <?php
                    echo $form->field($model, 'country_id')
                            ->dropDownList(
                                    ArrayHelper::map(Country::find()->all(), 'id', 'country'), // Flat array ('id'=>'label')
                                    ['prompt' => 'Select a Country']    // options
                    );
                    ?></div>

                <div class="col-xs-3">
                    <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?></div>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
