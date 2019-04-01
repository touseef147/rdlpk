<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\application\Propertyapplication */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Update Application Form';
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

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput', 'enctype' => 'multipart/form-data']]); ?>
                <?= $form->field($model, 'application_id')->hiddenInput()->label(FALSE) ?>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Form Detail</h6>
                                <div class="widget-toolbar <?php
                                if ($model->application_status == 3)
                                    echo "red";
                                else
                                    echo "black";
                                ?>">
                                    <div id="filedetails" class="pull-left bolder"><?php echo $model->statustitle; ?></div>
                                </div>
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
                                        <tr id="dealerrow" class="<?php echo ($model->property_against == 1 ? "hidecontent" : "") ?>">
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
                                        <tr id="ownerrow" class="<?php echo ($model->property_against != 1 ? "hidecontent" : "") ?>">
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
                                                        '
                                                                ]  // options
                                                        )->label(false);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr class="instplancontent <?php echo ($model->property_against == 1 ? "hidecontent" : "") ?>">
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
                                        <tr class="instplancontent <?php echo ($model->property_against == 1 ? "hidecontent" : "") ?>">
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Plan Start Date</td>
                                            <td >
                                                <?= $form->field($model, 'plan_start_date')->textInput(['class' => 'date-picker'])->label(false) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">File/Plot Details</td>
                                            <td >
                                                <?php echo $model->file->completecode; ?>
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
                                <div class="widget-toolbar">
                                    <a href="javascript:;" 
                                       class="dynamic_form" 
                                       data-targetdiv="new_member" 
                                       data-listcontainer="members_list" 
                                       data-allowaction="yes" 
                                       data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/findrecord"
                                       data-compurl1="<?php echo Yii::$app->urlManager->baseUrl . "/index.php?r=property/application/propertyapplication/attachmember" ?>"
                                       data-listurl="<?php echo Yii::$app->urlManager->baseUrl . "/index.php?r=members/members/propertyapplication/memberslist&id=" . $model->application_id . "&type=application" ?>"
                                       >
                                        Add
                                    </a>
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main no-padding">
                                    <!-- 
                                    class="lazycontent" data-url="<?php //echo Yii::$app->urlManager->baseUrl."/index.php?r=property/application/propertyapplication/comments&id=" . $model->application_id        ?>"
                                    -->
                                    <div id="members_list" >
                                        <table id="members-list" class="table  table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="center" style="width:40px;">      </th>
                                                    <th>Picture</th>
                                                    <th>Name</th>
                                                    <th>S/o, D/o, W/o</th>
                                                    <th>CNIC</th>
                                                    <th>Contact No.</th>
                                                    <th>Nominee</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="center">      </td>
                                                    <td align="left">
                                                        <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/uploads/members/pictures/<?php echo $model->member->image; ?>?<?php echo date('H-i-s'); ?>" height="60">
                                                        <?= ""//app\components\Showimage::widget(['path' => Yii::$app->urlManager->baseUrl . "/uploads/property/documents/picture/" ,'file_name'=>$modelphoto->file_name, 'height' => 80])    ?>
                                                    </td>
                                                    <td align="left"><?= $model->member->name ?></td>
                                                    <td align="left"><?= $model->member->sodowo ?></td>
                                                    <td align="left"><?= $model->member->cnic ?></td>
                                                    <td align="left"><?= $model->member->phone ?></td>
                                                    <td align="left"><?= ($model->nominee == NULL ? "" : $model->nominee->name) ?></td>
                                                </tr>
                                                <?php
                                                if (isset($model->plot) && $model->plot != NULL) {
                                                    foreach ($model->plot->jointmembers as $row) {
                                                        ?>
                                                        <tr>
                                                            <td class="center">      </td>
                                                            <td align="left">
                                                                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/uploads/members/pictures/<?php echo $row->member->image; ?>?<?php echo date('H-i-s'); ?>" height="60">
                                                            </td>
                                                            <td align="left"><?= $row->member->name ?></td>
                                                            <td align="left"><?= $row->member->sodowo ?></td>
                                                            <td align="left"><?= $row->member->cnic ?></td>
                                                            <td align="left"><?= $row->member->phone ?></td>
                                                            <td align="left"><?= ($row->nominee == null ? "" : $row->nominee->name) ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="dynamic_row_content" id="new_member">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <?php
                        $plot = \app\models\application\Plots::find()->where(['application_id' => $model->application_id])->one();
                        $resplot = \app\models\application\Plots::find()->where(['id' => $plot->reserved_plot_id])->one();
                        $resstreet = app\models\application\Streets::find()->where(['id' => ($resplot == null ? 0 : $resplot->street_id)])->one();

                        $resplots = \app\models\application\Plots::find()->where(['street_id' => ($resplot == null ? 0 : $resplot->street_id)])->andWhere(['size2' => $model->property_size])->andWhere(['type'=>'Plot'])->all();
                        $resstreets = \app\models\application\Streets::find()->where(['sector_id' => ($resstreet == null ? 0 : $resstreet->sector_id)])->all();
                        $ressectors = \app\models\application\Sectors::find()->where(['project_id' => $model->project_id])->all();
                        ?>
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
                                                echo Html::dropDownList('plot_sector', 0, ArrayHelper::map($ressectors, 'id', 'sector_name'), // Flat array ('id'=>'label')
                                                        ['prompt' => 'Not Selected',
                                                            'options' => [($resstreet == NULL ? "" : $resstreet->sector_id) => ['Selected' => true]],
    'id' => "plot_sector",
                                                    //'value' => ,
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
echo Html::dropDownList('plot_street', 0, ArrayHelper::map($resstreets, 'id', 'street'), // Flat array ('id'=>'label')
        ['prompt' => 'Not Selected',
                                                            'options' => [($resstreet == NULL ? "" : $resstreet->id) => ['Selected' => true]],
    'id' => "plot_street",
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
echo Html::dropDownList('plot_nos', 0, ArrayHelper::map($resplots, 'id', 'plot_no'), // Flat array ('id'=>'label')
        ['prompt' => 'Not Selected',
                                                            'options' => [($resplot == null ? "" : $resplot->id) => ['Selected' => true]],
    'id' => "plot_nos",
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

                <div class="row">
                    <div class="col-xs-12">
                        <div class="widget-box widget-color-purple ui-sortable-handle">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Fincncial Details</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main no-padding">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <li class="childtabs">
                                                <a onclick="$('.childtabs').removeClass('active'); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/financialsmry&id=<?php echo $model->file->id; ?>">
                                                    <i class="green ace-icon fa fa-home bigger-120"></i>
                                                    Summary
                                                </a>
                                            </li>

                                            <li class=" childtabs">
                                                <a onclick="$('.childtabs').removeClass('active'); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/plotcharges&id=<?php echo $model->file->id; ?>&sourcepage=<?php echo Yii::$app->urlManager->baseUrl . "/index.php?r=property/application/propertyapplication/update%26id=" . $model->application_id; ?>">
                                                    <i class="green ace-icon fa fa-th bigger-120"></i>
                                                    Fees/Charges
                                                </a>
                                            </li>

                                            <li class="active childtabs">
                                                <a onclick="$('.childtabs').removeClass('active'); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/plotinstallments&id=<?php echo $model->file->id; ?>&sourcepage=<?php echo Yii::$app->urlManager->baseUrl . "/index.php?r=property/application/propertyapplication/update%26id=" . $model->application_id; ?>">
                                                    <i class="green ace-icon fa fa-home bigger-120"></i>
                                                    Installment Details
                                                </a>
                                            </li>
<?php
//                            if ($depositallowd) {
?>
                                            <li class=" childtabs">
                                                <a onclick="$('.childtabs').removeClass('active'); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/voucherplotdetail/plotreceipts&id=<?php echo $model->file->id; ?>">
                                                    <i class="green ace-icon fa fa-th bigger-120"></i>
                                                    Receipts
                                                </a>
                                            </li>
                                            <?php
                                            //                          }
                                            ?>

<?php
//                        if ($verificationallowd) {
?>
                                            <li class=" childtabs">
                                                <a onclick="$('.childtabs').removeClass('active'); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/plotmemberships&id=<?php echo $model->file->id; ?>">
                                                    <i class="green ace-icon fa fa-th bigger-120"></i>
                                                    Property Transactions
                                                </a>
                                            </li>
                                            <?php
//                      }
                                            ?>
                                        </ul>

                                        <div class="tab-content no-padding">
                                            <div class="tab-pane fade in active" id="contentdetail">
                                            <?php
                                            //                          }       //check multiple rights
                                            ?>
<?=
$this->renderFile(
        Yii::getAlias("@app") . '/modules/finance/views/installpayment/_plotinstallments.php', [
//                                                    'model' => $modelinstallmentplan,
    'model' => $modelinstallmentplan,
    'sourcepage' => Yii::$app->urlManager->baseUrl . "/index.php?r=property/application/propertyapplication/update%26id=" . $model->application_id,
    'myrights' => $instpaymentrights,
    'allowedit' => "yes",
]);
?>                                    
                                                <?php
//                            if ($multiplerights) {
                                                ?>
                                            </div>

                                        </div><!-- /.col -->
                                    </div><!-- /.tabable -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<?php
if (!$model->isNewRecord) {
    echo \app\components\Commentbox::widget([
        'title' => 'Comments',
        'dataurl' => 'property/application/propertyapplication/comments&id=' . $model->application_id,
        'submiturl' => 'property/application/propertyapplication/updatecomments',
        'parentval' => $model->application_id,
        'allowadd' => 1,
    ]);
}
?>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-xs-12">
                        <div class="form-group pull-right">
                            <button type="submit" class="btn btn-primary btn-white btn-round">
                                <i class="ace-icon fa fa-floppy-o bigger-125"></i>
                                Update
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
