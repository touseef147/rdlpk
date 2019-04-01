<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Projects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "property", "title" => "Property"],
            ["link" => "property/config", "title" => "Configuration"],
            ["link" => "property/config/projects/index", "title" => "Projects"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/projects/sidebarinput">

            
                  <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput', 'enctype' => 'multipart/form-data']]);?>
                <div class="col-xs-3">
                    <?= $form->field($model, 'project_name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-xs-3">
                    <?= $form->field($model, 'membership_fee')->textInput() ?>
                </div>
                <div class="col-xs-3">
                    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?></div>
                <div class="col-xs-3">

                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?></div>
                <div class="col-xs-3">

                    <?= $form->field($model, 'teaser')->textarea(['rows' => 6]) ?></div>
                <div class="col-xs-3">

                    <?= $form->field($model, 'details')->textarea(['rows' => 6]) ?></div>
                <div class="col-xs-3">
                        

                        <?= $form->field($model, 'pimage')->fileInput() ?>
                    </div>
                  
                <div class="col-xs-3">

                    <?= $form->field($model, 'pmap')->fileinput() ?></div>
                <div class="col-xs-3">

                    <?= $form->field($model, 'lmap')->fileInput() ?></div>
               
                    <div class="col-xs-3">
                                <?php
                                echo $form->field($model, 'status')
                                        ->dropDownList(
                                        \app\models\application\Projects::Statuslist(), // Flat array ('id'=>'label')
                                                ['prompt' => 'Select Status',
                                                ]    // options
                                );
                                ?>

                            </div>
                <div class="col-xs-3">

                    <?= $form->field($model, 'report_title_line1')->textInput() ?>
                </div>
                <div class="col-xs-3">

                    <?= $form->field($model, 'report_title_line2')->textInput() ?>
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
