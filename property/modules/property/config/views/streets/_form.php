<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\Streets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="streets-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "property", "title" => "Property"],
            ["link" => "property/config", "title" => "Configurations"],
            ["link" => "property/config/streets/index", "title" => "Streets"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

            <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/streets/sidebarinput">

                        <?php $form = ActiveForm::begin(['options'=>['class'=>'frminput']]); ?>
									<div class="col-xs-3">
                                    <?php
                                        echo $form->field($model, 'project_id')
                                        ->dropDownList(
                                            ArrayHelper::map(app\models\application\Projects::find()->all(), 'id', 'project_name'),           // Flat array ('id'=>'label')
                                            ['prompt'=>'Select a Project']    // options
                                        );
                                    ?></div>
											<div class="col-xs-3">
                                    <?php
                                        echo $form->field($model, 'sector_id')
                                        ->dropDownList(
                                            ArrayHelper::map(\app\models\application\Sectors::find()->all(), 'id', 'sector_name'),           // Flat array ('id'=>'label')
                                            ['prompt'=>'Select a Sector']    // options
                                        );
                                    ?></div>
		<div class="col-xs-3">
    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?></div>
		<div class="col-xs-3">
    <?= $form->field($model, 'create_date')->textInput(['class'=>'date-picker']) ?></div>
		<div class="col-xs-3">
    <?= $form->field($model, 'modify_date')->textInput(['class'=>'date-picker']) ?></div>

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
