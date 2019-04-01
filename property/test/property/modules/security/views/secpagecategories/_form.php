<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\Secpagecategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="secpagecategories-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "security", "title" => "Security"],
            ["link" => "security/secpagecategories/index", "title" => "Page Categories"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secpagecategories/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>

                <div class="row">
                    <div class="col-xs-9">
                        <?= $form->field($model, 'category_title')->textInput() ?>

                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'sort_order')->textInput() ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <?php
                        echo $form->field($model, 'module_id')
                                ->dropDownList(
                                        ArrayHelper::map(\app\models\application\Secmodules::find()->all(), 'module_id', 'module_title'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select a Module']    // options
                        );
                        ?>

                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $form->field($model, 'page_type')
                                ->dropDownList(
                                        array('1' => 'Single (Exact One Page)', '2' => 'Optional', '3' => 'Allow Multiple Page (One or many)'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select Page Type']    // options
                        );
                        ?>

                    </div>
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
