<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\application\City;
use app\models\application\Profession;

/* @var $this yii\web\View */
/* @var $model app\models\application\Dailyvisitors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dailyvisitors-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "marketting", "title" => "Marketting"],
            ["link" => "marketting/visitors/dailyvisitors/index", "title" => "Daily Visits"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

            <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/dailyvisitors/sidebarinput">

                        <?php $form = ActiveForm::begin(['options'=>['class'=>'frminput']]); ?>

                        <div class="row">
                                <div class="col-xs-8">
                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-xs-4">
                                    <?= $form->field($model, 'reg_date')->textInput(['class'=>'date-picker']) ?>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-xs-3">
                                    <?php
                                        echo $form->field($model, 'profession_id')
                                        ->dropDownList(
                                            ArrayHelper::map(Profession::find()->all(), 'id', 'profession'),           // Flat array ('id'=>'label')
                                            ['prompt'=>'Select a Profession']    // options
                                        );
                                    ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php
                                        echo $form->field($model, 'city')
                                        ->dropDownList(
                                            ArrayHelper::map(City::find()->all(), 'id', 'city'),           // Flat array ('id'=>'label')
                                            ['prompt'=>'Select a City']    // options
                                        );
                                    ?>
                                </div>
                                <div class="col-xs-3">
                                    <?= $form->field($model, 'contactno')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-xs-3">
                                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-xs-6">
                                    <?= $form->field($model, 'refered_by')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-xs-6">
                                    <?= $form->field($model, 'reference')->textInput(['maxlength' => true]) ?>
                                </div>
                        </div>




                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
            </div>
    </div>

</div>
