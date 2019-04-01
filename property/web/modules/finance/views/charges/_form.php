<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Charges */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="charges-form">

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "finance", "title" => "Finance"],
            ["link" => "finance/charges", "title" => "Charges"],
            ["link" => "", "title" => "Update"],],])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

            <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/charges/sidebarinput">

                        <?php $form = ActiveForm::begin(['options'=>['class'=>'frminput']]); ?>
<div class="col-xs-3">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
<div class="col-xs-3">
    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?></div>
<div class="col-xs-3">
    <?= $form->field($model, 'monthly')->textInput(['maxlength' => true]) ?></div>
<div class="col-xs-3">
    <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?></div>
<div class="col-xs-3">
    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?></div>
<div class="col-xs-3">
    <?= $form->field($model, 'project_id')->textInput(['maxlength' => true]) ?></div>

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
