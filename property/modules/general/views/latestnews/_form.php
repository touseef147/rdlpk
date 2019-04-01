<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Latestnews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="latestnews-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "finance", "title" => "Finance"],
            ["link" => "", "title" => "Voucher Details"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

            <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=general/latestnews/sidebarinput">

                        <?php $form = ActiveForm::begin(['options'=>['class'=>'frminput']]); ?>

                            <div class="col-xs-3">
                            <?= $form->field($model, 'teaser')->textarea(['rows' => 6]) ?>

                            </div>
                            <div class="col-xs-3">
                            <?= $form->field($model, 'details')->textarea(['rows' => 6]) ?>

                            </div>
                           <div class="col-xs-3">
                            <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

                            </div>
                            <div class="col-xs-3">
                            <?= $form->field($model, 'create_date')->textInput(['class'=>'date-picker']) ?>

                            </div>
                                <div class="col-xs-3">
                            <?= $form->field($model, 'update_date')->textInput(['class'=>'date-picker']) ?>

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
