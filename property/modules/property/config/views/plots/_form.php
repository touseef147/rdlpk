<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\Plots */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plots-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "property", "title" => "Property"],
            ["link" => "property/config", "title" => "Configuration"],
            ["link" => "property/config/plots/index", "title" => "Plots"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/plots/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>

                <?= Html::activeHiddenInput($model, 'type', ["value" => "Plot"]); ?>
                <?php // echo $form->hiddenField($model, 'type'); ?>									

                 <div class="col-xs-3">
                        <?php
                        echo $form->field($model, 'project_id')
                                ->dropDownList(
                                        ArrayHelper::map(\app\models\application\Projects::find()->joinWith("permissions")->orderBy("projects.project_name")->where(['project_permissions.user_id' => Yii::$app->user->identity->id])->all(), 'id', 'project_name'), // Flat array ('id'=>'label')
                                        [
                                    'prompt' => 'Select a Project',
                                    'onchange' => ' 
                                                    $.get( "' . Url::toRoute('/property/config/sectors/dropdown') . '", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                            $( "#' . Html::getInputId($model, 'sector') . '" ).html( data );
                                                                $( "#' . Html::getInputId($model, 'street_id') . '" ).html( "" );
                                                        }
                                                    );
                                                    
                                                    $.get( "' . Url::toRoute('/property/config/files/lastfile') . '", { projectid: $(this).val() } )
                                                        .done(function( data ) {
                                                            if(data[0] == "1"){
                                                                $( "#' . Html::getInputId($model, 'size2') . '" ).val( data[1] );
                                                                $( "#' . Html::getInputId($model, 'com_res') . '" ).val( data[2] );
                                                                $( "#' . Html::getInputId($model, 'price') . '" ).val( data[3] );
                                                                $( "#' . Html::getInputId($model, 'plot_detail_address') . '" ).val( data[4] );
                                                                $( "#' . Html::getInputId($model, 'plot_size') . '" ).val( data[5] );
                                                            }
                                                        }
                                                    );
                                                    
                                                    ',
                                        ]    // options
                        );
                        ?>

                    </div>
                    <div class="col-xs-3">
                        <?=
                        $form->field($model, 'sector')->dropDownList(ArrayHelper::map(\app\models\application\Sectors::find()
                                                ->where(['project_id' => $model->project_id])
                                                ->orderBy('sector_name ASC')
                                                ->all(), 'id', 'sector_name'), [
                            'prompt' => 'Select a Sector',
                            'onchange' => ' 
                    $.get( "' . Url::toRoute('/property/config/streets/dropdown') . '", { id: $(this).val() } )
                        .done(function( data ) {
                            $( "#' . Html::getInputId($model, 'street_id') . '" ).html( data );
                        }
                    );',
                                ]    // options
                        )->label('Sector')
                        ?>
                        <?php
                        /*  echo $form->field($model, 'sector')
                          ->dropDownList(
                          ArrayHelper::map(app\models\application\Sectors::find()->all(), 'id', 'sector_name'),           // Flat array ('id'=>'label')
                          ['prompt'=>'Select a Sector']    // options
                          ); */
                        ?></div>
                    <div class="col-xs-3">
                        <?php
                        echo $form->field($model, 'street_id')
                                ->dropDownList(ArrayHelper::map(\app\models\application\Streets::find()
                                                ->where(['sector_id' => $model->sector])
                                                ->orderBy('street ASC')
                                                ->all(), 'id', 'street'), ['prompt' => 'Select a Street']    // options
                        );
                        ?>


                    </div>
                <div class="col-xs-3">
                    <?= $form->field($model, 'plot_no')->textInput(['maxlength' => true]) ?></div>
                <div class="col-xs-3">
                    <?= $form->field($model, 'plot_size')->textInput(['maxlength' => true]) ?></div>
                <div class="col-xs-3">
                    <?php
                    echo $form->field($model, 'size2')
                            ->dropDownList(
                                    ArrayHelper::map(app\models\application\Sizecat::find()->all(), 'id', 'size'), // Flat array ('id'=>'label')
                                    ['prompt' => 'Select a Size']    // options
                    );
                    ?></div>

                <div class="col-xs-3"><?php
                    echo $form->field($model, 'com_res')
                            ->dropDownList(
                                    array('Residential' => 'Residential', 'Commercial' => 'Commercial'), // Flat array ('id'=>'label')
                                    ['prompt' => 'Select Type']    // options
                    );
                    ?></div>
                <div class="col-xs-3">
                    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?></div>
                <div class="col-xs-3"><?php
                    echo $form->field($model, 'cstatus')
                            ->dropDownList(
                                    array('Developed' => 'Developed', 'Undeveloped' => 'Undeveloped'), // Flat array ('id'=>'label')
                                    ['prompt' => 'Select Developed/Undeveloped']    // options
                    );
                    ?></div>



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
