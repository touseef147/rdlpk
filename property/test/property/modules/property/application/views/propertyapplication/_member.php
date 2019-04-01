<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Propertyapplication */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="propertyapplication-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "finance", "title" => "Finance"],
            ["link" => "", "title" => "Property Application"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/propertyapplication/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>

                <div class="row">
                    <div class="col-xs-12">
                        <?= $form->field($model, 'cnic')->textInput() ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Submit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
