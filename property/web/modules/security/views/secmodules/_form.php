<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\Secmodules */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="secmodules-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "security", "title" => "Security"],
            ["link" => "security/secmodules/index", "title" => "Modules"],
            ["link" => "", "title" => Html::encode($this->title)],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secmodules/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>

                <?= $form->field($model, 'module_code')->textInput() ?>
                <?= $form->field($model, 'module_title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'module_so')->textInput() ?>

                <?php
                echo $form->field($model, 'parent_module_id')
                        ->dropDownList(
                                ArrayHelper::map(\app\models\application\Secmodules::find()->all(), 'module_id', 'module_title'), // Flat array ('id'=>'label')
                                ['prompt' => 'Select a Module']    // options
                );
                ?>
                
                <?php
                echo $form->field($model, 'for_reports')
                        ->dropDownList(
                                array('0' => 'No', '1' => 'Yes'), // Flat array ('id'=>'label')
                                ['prompt' => 'Select Type']    // options
                );
                ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
