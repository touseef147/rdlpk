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
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "property", "title" => "Property"],
            ["link" => "property/application/propertyapplication", "title" => "Forms"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>


        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/application/propertyapplication/sidebarinput">

                <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->baseUrl . '/index.php?r=property/application/propertyapplication/create', 'options' => ['class' => 'frminput', 'enctype' => 'multipart/form-data']]); ?>
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
                                                                ArrayHelper::map(\app\models\application\Projects::find()->joinWith("permissions")->orderBy("projects.project_name")->where(['project_permissions.user_id' => Yii::$app->user->identity->id])->all(), 'id', 'project_name'), // Flat array ('id'=>'label')
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
                                                                ArrayHelper::map(\app\models\application\Salescenter::find()->joinWith("permissions")->orderBy("sales_center.name")->where(['centers_permissions.user_id' => Yii::$app->user->identity->id])->all(), 'id', 'name'), // Flat array ('id'=>'label')
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
                    <div class="col-xs-8">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Member Detail</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <?php
                                    if ($modelmember->id == 0) {
                                        ?>
                                        <div 
                                            id="memberdetail"
                                            class="subpage_wizard" 
                                            data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/findrecord"
                                            data-targetdiv="memberdetail" 
                                            data-listcontainer="memberdetail" 
                                            data-allowaction="no" 
                                            data-compurl1=""
                                            data-listurl=""
                                            > 
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="lazycontent"  data-url="<?php echo Yii::$app->urlManager->baseUrl . "/index.php?r=members/members/getrecord&id=" . $modelmember->parent_id . "&nominee=" . $modelmember->id ?>">
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <?= ""//$form->field($model, 'member_id')->hiddenInput()->label(FALSE) ?>
                <!--<table style="width: 100%;">
                    <tr>
                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Name</td>
                        <td ><?= "" //$modelmember->name        ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Father Name</td>
                        <td ><?= "" //$modelmember->sodowo        ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">CNIC</td>
                        <td ><?= "" //$modelmember->cnic        ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Pnone</td>
                        <td ><?= "" //$modelmember->phone        ?></td>
                    </tr>
                    <tr>
                        <td  colspan="2" style=" height: 35px; border-bottom: thin solid #002a80"><strong>Nominee</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; width: 100px; padding-right: 5px;">Nominee</td>
                        <td>
                                    <?php
//echo $form->field($model, 'nominee_id')
//      ->dropDownList(
//            ArrayHelper::map(app\models\application\Members::find()->where(['parent_id' => $model->member_id])->all(), 'id', 'name'), // Flat array ('id'=>'label')
//          ['prompt' => 'Select Nominee']  // options
// )->label(false);
                                    ?>
                        </td>
                    </tr>
                    <tr>
                        <td  colspan="2" style=" height: 35px; border-bottom: thin solid #002a80"><strong>New Nominee</strong></td>
                    </tr>
                    <tr>
                        <td  colspan="2">
                                    <?php
//echo $form->field($modelnewnominee, 'name')->textInput(['name' => 'nominee[name]'])->label('Name');
                                    ?>
                        </td>
                    </tr>
                    <tr>
                        <td  colspan="2">
                                    <?php
//echo $form->field($modelnewnominee, 'cnic')->textInput(['name' => 'nominee[cnic]'])->label('CNIC');
                                    ?>
                        </td>
                    </tr>
                    <tr>
                        <td  colspan="2">
                                    <?php
//echo $form->field($modelnewnominee, 'phone')->textInput(['name' => 'nominee[phone]'])->label('Contact No.');
                                    ?>
                        </td>
                    </tr>
                </table>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="widget-box widget-color-dark light-border ui-sortable-handle">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Reserve a Plot</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Sector</td>
                                            <td >
                                                <?php
                                                echo Html::dropDownList('plot_sector', 0, ArrayHelper::map(app\models\application\Sectors::find()->all(), 'id', 'sector_name'), // Flat array ('id'=>'label')
                                                        ['prompt' => 'Not Selected',
                                                    'value' => "",
                                                    'onchange' => ' 
                                                            $.get( "' . Url::toRoute('/property/config/streets/dropdown') . '", '
                                                            . '             { '
                                                            . '                 sectorid: $(this).val(), '
                                                            . '                 
                                                                    } 
                                                                 )
                                                                .done(function( data ) {
                                                                    $( "#plot_street" ).html( data );
                                                                }
                                                            );
                                ',
                                                        ]    // options
                                                );

                                                
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Street</td>
                                            <td>
                                                <?php
                                                echo Html::dropDownList('plot_street', 0, ArrayHelper::map(app\models\application\Streets::find()->all(), 'id', 'street'), // Flat array ('id'=>'label')
                                                        ['prompt' => 'Not Selected',
                                                    'value' => "", 'id' => "plot_street",
                                                    'onchange' => ' 
                                                            $.get( "' . Url::toRoute('/property/config/plots/dropdown') . '", '
                                                            . '             { '
                                                            . '                 streetid: $(this).val(), '
                                                            . '                 size: $("#' . Html::getInputId($model, 'property_size') . '").val(), '
                                                            . '                 comres: $("#' . Html::getInputId($model, 'property_type') . '").val(), '
                                                            . '                 reserved: 0, '
                                                            . '                 
                                                                    } 
                                                                 )
                                                                .done(function( data ) {
                                                                    $( "#plot_nos" ).html( data );
                                                                }
                                                            );
                                ',
                                                        ]    // options
                                                );

                                                
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Plot No.</td>
                                            <td>
                                                <?php
                                                echo Html::dropDownList('plot_nos', 0, ArrayHelper::map(app\models\application\Plots::find()->where(['type' => 'Plot'])->all(), 'id', 'plot_no'), // Flat array ('id'=>'label')
                                                        ['prompt' => 'Not Selected',
                                                    'value' => "", 'id' => "plot_nos",
                                                    'onchange' => ' 
                                );
                                ',
                                                        ]    // options
                                                );

                                                
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  <div class="row">
                      <div class="col-xs-12">
                          <div class="widget-box">
                              <div class="widget-header widget-header-small">
                                  <h6 class="widget-title bigger"><i class="icon-th-large"></i> Payment Detail</h6>
                              </div>
                              <div class="widget-body">
                                  <div class="widget-main">
<?php //$form->field($model, 'voucher_id')->hiddenInput()->label(FALSE)      ?>
                                      <div class="row">
                                          <div class="col-xs-3">
                <?php
                /*  echo $form->field($modelvoucher, 'voucher_type')
                  ->dropDownList(
                  array('1' => 'Cash', '2' => 'Bank'), // options
                  ['prompt' => 'Select Type']  // options
                  ); */
                ?>
                                          </div>
                                          <div class="col-xs-3">
                <?php
                /*  echo $form->field($modelvoucher, 'bank_id')
                  ->dropDownList(
                  ArrayHelper::map(app\models\application\Fmsbanks::find()->all(), 'bank_id', 'bank_title'), // Flat array ('id'=>'label')
                  ['prompt' => 'Select Bank']  // options
                  ); */
                ?>
                                          </div>
                                          <div class="col-xs-3">
                <?php
//echo $form->field($modelvoucher, 'transaction_date')->textInput();
                ?>
                                          </div>
                                          <div class="col-xs-3">
                <?php
//echo $form->field($modelvoucher, 'vouchert_sr_no')->textInput();
                ?>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-xs-3">
                <?php
//echo $form->field($modelvoucherfee, 'dr_amount')->textInput(['name' => 'fee[dr_amount]'])->label('Fee');
                ?>
                                          </div>
                                          <div class="col-xs-3">
                                          </div>
                                          <div class="col-xs-3">
                <?php
//echo $form->field($modelvoucherbooking, 'dr_amount')->textInput(['name' => 'booking[dr_amount]'])->label('Booking Amount');
                ?>
                                          </div>
                                          <div class="col-xs-3">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Attachments</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row">
                                        <div class="col-xs-4">
                <?php
//echo $form->field($modelphoto, 'image')->fileInput(['name' => 'photo[image]'])->label('Passport Size Photograph');
                ?>
                                        </div>
                                        <div class="col-xs-4">
                <?php
//echo $form->field($modelcnic, 'image')->fileInput(['name' => 'cnic[image]'])->label('CNIC');
                ?>
                                        </div>
                                        <div class="col-xs-4">
                <?php
//echo $form->field($modelbankdoc, 'image')->fileInput(['name' => 'bankdoc[image]'])->label('Pay Order');
                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group pull-right">
                            <button type="submit" class="btn btn-primary btn-white btn-round">
                                <i class="ace-icon fa fa-floppy-o bigger-125"></i>
<?= ($model->isNewRecord ? 'Create' : 'Update') ?>
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
