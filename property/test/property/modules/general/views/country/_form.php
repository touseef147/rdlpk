<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "general", "title" => "Configuration"],
            ["link" => "general/country", "title" => "Countries"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

            <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=general/country/sidebarinput">

                        <?php $form = ActiveForm::begin(['options'=>['class'=>'frminput']]); ?>

                        <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
            </div>
    </div>

</div>
