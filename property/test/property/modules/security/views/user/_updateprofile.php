<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "", "title" => "Update Profile"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput', 'enctype' => 'multipart/form-data']]); ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
                <div class="row">
                    <div class="col-xs-6">
                        <?= $form->field($model, 'person_name')->textInput() ?>
                    </div>
                      <div class="col-xs-6">
                        <img  src="<?php echo Yii::$app->urlManager->baseUrl; ?>/uploads/users/<?php echo Yii::$app->user->identity->picture;  ?>" height="120" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <?= $form->field($model, 'cnic')->textInput() ?>
                    </div>
                    <div class="col-xs-4">
                        <?= $form->field($model, 'mobile')->textInput() ?>
                    </div>
                    <div class="col-xs-4">
                        <?= $form->field($model, 'email')->textInput() ?>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-xs-3">

                        <?= $form->field($model, 'uimage')->fileinput() ?></div>

                    <div class="col-xs-6">
                        <?= $form->field($model, 'address')->textInput() ?>
                    </div>
                </div>
                <br /> 




              
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
