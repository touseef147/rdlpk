<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

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
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Form No.</td>
                                            <td style="border-bottom: dotted"><?= $model->application_no ?></td>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Date</td>
                                            <td style="border-bottom: dotted"><?= $model->application_date ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Against</td>
                                            <td style="border-bottom: dotted" colspan="3"><?= $model->propertyagainsttitle ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Project</td>
                                            <td style="border-bottom: dotted" colspan="3"><?= $model->project->project_name ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Sales Center</td>
                                            <td style="border-bottom: dotted" colspan="3"><?= $model->salecenter->name ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Dealer</td>
                                            <td style="border-bottom: dotted" colspan="3"><?= ($model->dealer == NULL ? "" : $model->dealer->name)        ?></td>
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
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Property Type</td>
                                            <td style="border-bottom: dotted"><?= $model->propertytypetitle ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Size</td>
                                            <td style="border-bottom: dotted"><?= $model->plotsize->size ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Installment Plan</td>
                                            <td style="border-bottom: dotted"><?= $model->installmentplan->description ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Plan Start Date</td>
                                            <td style="border-bottom: dotted"><?= date("d-m-Y", strtotime($model->plan_start_date)) ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">File Details</td>
                                            <td style="border-bottom: dotted" >
                                                <div id="filedetails"><?php echo $model->file->completecode; ?></div>
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
                                    class="lazycontent" data-url="<?php //echo Yii::$app->urlManager->baseUrl."/index.php?r=property/application/propertyapplication/comments&id=" . $model->application_id  ?>"
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
                                                        <?= ""//app\components\Showimage::widget(['path' => Yii::$app->urlManager->baseUrl . "/uploads/property/documents/picture/" ,'file_name'=>$modelphoto->file_name, 'height' => 80]) ?>
                                                    </td>
                                                    <td align="left"><?= $model->member->name ?></td>
                                                    <td align="left"><?= $model->member->sodowo ?></td>
                                                    <td align="left"><?= $model->member->cnic ?></td>
                                                    <td align="left"><?= $model->member->phone ?></td>
                                                    <td align="left"><?= ($model->nominee == NULL ? "" : $model->nominee->name) ?></td>
                                                </tr>
                                                <?php foreach ($model->plot->jointmembers as $row) { ?>
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
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="dynamic_row_content" id="new_member">

                                    </div>
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
