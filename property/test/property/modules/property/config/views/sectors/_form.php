<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\Sectors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sectors-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "property", "title" => "Property"],
            ["link" => "property/config", "title" => "Configuration"],
            ["link" => "property/config/sectors/index", "title" => "Sectors"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

            <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/sectors/sidebarinput">

                        <?php $form = ActiveForm::begin(['options'=>['class'=>'frminput']]); ?>
									 <div class="col-xs-3">
                                    <?php
                                     /*   echo $form->field($model, 'project_id')
                                        ->dropDownList(
                                            ArrayHelper::map(app\models\application\Projects::find()->all(), 'id', 'project_name'),           // Flat array ('id'=>'label')
                                            ['prompt'=>'Select a Project']    // options
                                        );*/
                                    ?>
																		<?php
                                          echo   $form->field($model, 'project_id')->dropDownList(
                                               ArrayHelper::map(app\models\application\Projects::find()->all(), 'id', 'project_name'),           // Flat array ('id'=>'label'),
                                              ['onchange' => '$.post("'.Yii::$app->urlManager->createUrl(["users/A_action"]).'", function( data ) {
												  $("#test_div").html( data );
												 })']);
                                            ?>
                                    
                                    </div>
 
 <div class="col-xs-3">
    <?= $form->field($model, 'create_date')->textInput(['class'=>'date-picker']) ?></div>
 <div class="col-xs-3">
    <?= $form->field($model, 'modify_date')->textInput(['class'=>'date-picker']) ?></div>
<div class="col-xs-3">
    <?= $form->field($model, 'sector_name')->textarea(['rows' => 6]) ?></div>
 <div class="col-xs-3">
    <?= $form->field($model, 'details')->textarea(['rows' => 6]) ?></div>
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
