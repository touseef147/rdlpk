<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\application\Propertyapplication */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="propertyapplication-form">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/portal/dashboard/index">Home</a>
            </li>
            <li class="active">Booking</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => "Booking", "subtitle" => ""]) ?>


        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="">

                <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->baseUrl . '/index.php?r=property/application/propertyapplication/newbooking', 'options' => ['class' => 'frminput', 'enctype' => 'multipart/form-data']]); ?>
                <?= "" //$form->field($model, 'application_id')->hiddenInput()->label(false) ?>


                <div class="row">
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Form Detail</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Form No.</td>
                                            <td >
                                                <?= $form->field($model, 'application_no')->textInput(['maxlength' => true])->label(false) ?>
                                            </td>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Date</td>
                                            <td >
                                                <?= $form->field($model, 'application_date')->textInput(['class' => 'date-picker'])->label(false) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Against</td>
                                            <td  colspan="3">
                                                <?php
                                                echo $form->field($model, 'property_against')
                                                        ->dropDownList(
                                                                array('1' => 'Against Land', '2' => 'On Cash', '3' => 'Installments'), ['prompt' => 'Select Type',
                                                            'onchange' => ' 
                                                                $(".instplancontent").removeClass("hidecontent");
                                                                $("#ownerrow").removeClass("hidecontent");
                                                                $("#dealerrow").removeClass("hidecontent");
                                                            $.get( "' . Url::toRoute('/finance/installmentplanmaster/dropdown') . '", '
                                                            . '             { '
                                                            . '                 projectid: $("#' . Html::getInputId($model, 'project_id') . '").val(), '
                                                            . '                 plotsize: $("#' . Html::getInputId($model, 'property_size') . '").val(), '
                                                            . '                 landtype: $("#' . Html::getInputId($model, 'property_type') . '").val(), '
                                                            . '                 propertyagainst: $("#' . Html::getInputId($model, 'property_against') . '").val() , '
                                                            . '                 isdev: 0 
                                                                    } 
                                                                 )
                                                                .done(function( data ) {
                                                                    $( "#' . Html::getInputId($model, 'installment_plan') . '" ).html( data );
                                                                }
                                                            );
                                                            
if(this.value == 1){
    $(".instplancontent").hide();
    $("#ownerrow").show();
    $("#dealerrow").hide();
} else {
    $(".instplancontent").show();
    $("#dealerrow").show();
    $("#ownerrow").hide();
}
                                                        '
                                                                ]    // options
                                                        )->label(false);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Project</td>
                                            <td  colspan="3">
                                                <?php
                                                echo $form->field($model, 'project_id')
                                                        ->dropDownList(
                                                                ArrayHelper::map(\app\models\application\Projects::find()->orderBy("projects.project_name")->all(), 'id', 'project_name'), // Flat array ('id'=>'label')
                                                                [
                                                            'prompt' => 'Select Project',
                                                            'onchange' => ' 
                                                            $.get( "' . Url::toRoute('/finance/installmentplanmaster/dropdown') . '", '
                                                            . '             { '
                                                            . '                 projectid: $("#' . Html::getInputId($model, 'project_id') . '").val(), '
                                                            . '                 plotsize: $("#' . Html::getInputId($model, 'property_size') . '").val(), '
                                                            . '                 landtype: $("#' . Html::getInputId($model, 'property_type') . '").val(), '
                                                            . '                 propertyagainst: $("#' . Html::getInputId($model, 'property_against') . '").val() , '
                                                            . '                 isdev: 0 
                                                                    } 
                                                                 )
                                                                .done(function( data ) {
                                                                    $( "#' . Html::getInputId($model, 'installment_plan') . '" ).html( data );
                                                                }
                                                            );
                                                            
                                                            $.get( "' . Url::toRoute('/property/config/files/count') . '", '
                                                            . '             { '
                                                            . '                 type: "file", '
                                                            . '                 project: $("#' . Html::getInputId($model, 'project_id') . '").val(), '
                                                            . '                 status: "", '
                                                            . '                 size: $("#' . Html::getInputId($model, 'property_size') . '").val(), '
                                                            . '                 rescomm: $("#' . Html::getInputId($model, 'property_type') . '").val() , '
                                                            . '                 
                                                                    } 
                                                                 )
                                                                .done(function( data ) {
                                                                    $( "#filedetails" ).html( data );
                                                                }
                                                            );
                                                            
                                                            
                                                            $.get( "' . Url::toRoute('/property/config/sectors/dropdown') . '", '
                                                            . '             { '
                                                            . '                 $projectid: $("#' . Html::getInputId($model, 'project_id') . '").val(), '
                                                            . '                 
                                                                    } 
                                                                 )
                                                                .done(function( data ) {
                                                                    $( "#filedetails" ).html( data );
                                                                }
                                                            );


$("#plot_street").empty()
    .append("<option>Not Selected</option>");

$("#plot_nos").empty()
    .append("<option>Not Selected</option>");
    


                                                        '
                                                                ]    // options
                                                        )->label(false);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Sales Center</td>
                                            <td  colspan="3">
                                                <?php
                                                echo $form->field($model, 'sales_center_id')
                                                        ->dropDownList(
                                                                ArrayHelper::map(\app\models\application\Salescenter::find()->orderBy("sales_center.name")->all(), 'id', 'name'), // Flat array ('id'=>'label')
                                                                ['prompt' => 'Select Center']  // options
                                                        )->label(false);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr id="dealerrow">
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Dealer</td>
                                            <td  colspan="3">
                                                <?php
                                                echo $form->field($model, 'dealer_id')
                                                        ->dropDownList(
                                                                ArrayHelper::map(app\models\application\Members::find()->orderBy('dealers_business_title, name ASC')->where(['is_dealer' => '1'])->all(), 'id', function($model, $defaultValue) {
                                                                    return $model->dealers_business_title . " (" . $model->name . ")";
                                                                }
                                                                ), // Flat array ('id'=>'label')
                                                                ['prompt' => 'Select Dealer']  // options
                                                        )->label(false);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr id="ownerrow" class="hidecontent">
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Land Owner</td>
                                            <td  colspan="3">
                                                <?php
                                                echo $form->field($model, 'owner_id')
                                                        ->dropDownList(
                                                                ArrayHelper::map(app\models\application\Members::find()->orderBy('dealers_business_title, name ASC')->where(['is_owner' => '1'])->all(), 'id', function($model, $defaultValue) {
                                                                    return $model->dealers_business_title . " (" . $model->name . ")";
                                                                }
                                                                ), // Flat array ('id'=>'label')
                                                                ['prompt' => 'Select Owner']  // options
                                                        )->label(false);
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Property Detail</h6>
                                <div class="widget-toolbar red">
                                    <div id="filedetails" class="pull-left bolder">---</div>&nbsp;&nbsp;Files Remaining.
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Property Type</td>
                                            <td >
                                                <?php
                                                echo $form->field($model, 'property_type')
                                                        ->dropDownList(
                                                                array('2' => 'Commercial', '1' => 'Residential', '4' => 'Villas'), ['prompt' => 'Select Type',
                                                            'onchange' => ' 
                                                            $.get( "' . Url::toRoute('/finance/installmentplanmaster/dropdown') . '", '
                                                            . '             { '
                                                            . '                 projectid: $("#' . Html::getInputId($model, 'project_id') . '").val(), '
                                                            . '                 plotsize: $("#' . Html::getInputId($model, 'property_size') . '").val(), '
                                                            . '                 landtype: $("#' . Html::getInputId($model, 'property_type') . '").val(), '
                                                            . '                 propertyagainst: $("#' . Html::getInputId($model, 'property_against') . '").val() , '
                                                            . '                 isdev: 0 
                                                                    } 
                                                                 )
                                                                .done(function( data ) {
                                                                    $( "#' . Html::getInputId($model, 'installment_plan') . '" ).html( data );
                                                                }
                                                            );
                                                            
                                                            $.get( "' . Url::toRoute('/property/config/files/count') . '", '
                                                            . '             { '
                                                            . '                 type: "file", '
                                                            . '                 project: $("#' . Html::getInputId($model, 'project_id') . '").val(), '
                                                            . '                 status: "", '
                                                            . '                 size: $("#' . Html::getInputId($model, 'property_size') . '").val(), '
                                                            . '                 rescomm: $("#' . Html::getInputId($model, 'property_type') . '").val() , '
                                                            . '                 
                                                                    } 
                                                                 )
                                                                .done(function( data ) {
                                                                    $( "#filedetails" ).html( data );
                                                                }
                                                            );

$("#plot_nos").empty()
    .append("<option>Not Selected</option>");
                                                        '
                                                                ]    // options
                                                        )->label(false);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Size</td>
                                            <td >
                                                <?php
                                                echo $form->field($model, 'property_size')
                                                        ->dropDownList(
                                                                ArrayHelper::map(app\models\application\Sizecat::find()->all(), 'id', 'size'), // Flat array ('id'=>'label')
                                                                ['prompt' => 'Select Size',
                                                            'onchange' => ' 
                                                            $.get( "' . Url::toRoute('/finance/installmentplanmaster/dropdown') . '", '
                                                            . '             { '
                                                            . '                 projectid: $("#' . Html::getInputId($model, 'project_id') . '").val(), '
                                                            . '                 plotsize: $("#' . Html::getInputId($model, 'property_size') . '").val(), '
                                                            . '                 landtype: $("#' . Html::getInputId($model, 'property_type') . '").val(), '
                                                            . '                 propertyagainst: $("#' . Html::getInputId($model, 'property_against') . '").val() , '
                                                            . '                 isdev: 0 
                                                                    } 
                                                                 )
                                                                .done(function( data ) {
                                                                    $( "#' . Html::getInputId($model, 'installment_plan') . '" ).html( data );
                                                                }
                                                            );
                                                            
                                                            $.get( "' . Url::toRoute('/property/config/files/count') . '", '
                                                            . '             { '
                                                            . '                 type: "file", '
                                                            . '                 project: $("#' . Html::getInputId($model, 'project_id') . '").val(), '
                                                            . '                 status: "", '
                                                            . '                 size: $("#' . Html::getInputId($model, 'property_size') . '").val(), '
                                                            . '                 rescomm: $("#' . Html::getInputId($model, 'property_type') . '").val() , '
                                                            . '                 
                                                                    } 
                                                                 )
                                                                .done(function( data ) {
                                                                    $( "#filedetails" ).html( data );
                                                                }
                                                            );

$("#plot_nos").empty()
    .append("<option>Not Selected</option>");
                                                        '
                                                                ]  // options
                                                        )->label(false);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr class="instplancontent">
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Installment Plan</td>
                                            <td >
                                                <?php
                                                echo $form->field($model, 'installment_plan')
                                                        ->dropDownList(
                                                                ArrayHelper::map(app\models\application\Installmentplanmaster::find()->where(['project_id' => $model->project_id])->all(), 'plan_id', 'description'), // Flat array ('id'=>'label')
                                                                ['prompt' => 'Select Plan']  // options
                                                        )->label(false);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr class="instplancontent">
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Plan Start Date</td>
                                            <td >
                                                <?= $form->field($model, 'plan_start_date')->textInput(['class' => 'date-picker'])->label(false) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px; vertical-align: top;">Locations</td>
                                            <td >
                                                <?php
                                                $serialno = -1;
                                                $cols = 0;
//$prows = $modelpcateg->getModels();

                                                foreach ($modelpcateg as $arow) {
                                                    $serialno++;
                                                    ?>
                                                    <div class="col-xs-6">
                                                        <input type="checkbox" value="0" onclick="javascript: if (this.checked)
                                                                    this.value = '<?php echo $arow->id; ?>';
                                                                else
                                                                    this.value = '0';" name="category[<?php echo $serialno; ?>]" />
                                                        <input type="hidden" value="<?php echo $arow->id; ?>" name="categoryids[<?php echo $serialno; ?>]" />
                                                        <?php echo $arow->name . "   "; ?>

                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group pull-right">
                            <button type="submit" class="btn btn-primary btn-white btn-round">
                                <i class="ace-icon fa fa-floppy-o bigger-125"></i>
<?= ($model->isNewRecord ? 'Update' : 'Update') ?>
                                <i class="ace-icon fa fa-arrow-right icon-on-right bigger-125"></i>
                            </button>

                        </div>
                    </div>
                </div>
<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
