<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Visitdetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visitdetails-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "marketting", "title" => "Marketting"],
            ["link" => "marketting/visitors", "title" => "Visitors"],
            ["link" => "marketting/visitors/visitdetails/index", "title" => "Visit Details"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

            <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitdetails/sidebarinput">

                        <?php $form = ActiveForm::begin(['options'=>['class'=>'frminput']]); ?>

                        <?= $form->field($model, 'visitors_id')->textInput() ?>

    <?= $form->field($model, 'visit_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visit_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visit_date')->textInput() ?>

    <?= $form->field($model, 'deal_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'next_visit')->textInput() ?>

    <?= $form->field($model, 'followup_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'center_id')->textInput() ?>

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
