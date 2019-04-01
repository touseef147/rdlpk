<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\application\Fmsvoucher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fmsvoucher-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
//            ["link" => "property/membership/default/index", "title" => "Memberships Control Panel"],
            ["link" => "property/membership/cancel/approval", "title" => "Cancel Requests"],
            ["link" => "", "title" => "Membership Cancellation Approval"],
        ],
    ])
    ?>

    <div class="page-content">
        <span class="pull-right bolder bigger-110 " style="margin-top: 10px;">Membership No.: <span class="red"><?php echo $model->completecode; ?></span></span>

        <?= \app\components\Pageheader::widget(["title" => "Membership Cancellation Approval", "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>

                <?= ""//Html::errorSummary($model) ?>
                <?= $form->field($model, 'ms_id')->hiddenInput()->label(false) ?>

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
                                            <td style="border-bottom: dotted"><?= $appform->application_no ?></td>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Date</td>
                                            <td style="border-bottom: dotted"><?= $appform->application_date ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Against</td>
                                            <td style="border-bottom: dotted" colspan="3"><?= $appform->propertyagainsttitle ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Project</td>
                                            <td style="border-bottom: dotted" colspan="3"><?= $appform->project->project_name ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Sales Center</td>
                                            <td style="border-bottom: dotted" colspan="3"><?= $appform->salecenter->name ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Dealer</td>
                                            <td style="border-bottom: dotted" colspan="3"><?= ($appform->dealer == NULL ? "" : $appform->dealer->name) ?></td>
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
                                            <td style="border-bottom: dotted"><?= $appform->propertytypetitle ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Size</td>
                                            <td style="border-bottom: dotted"><?= $appform->plotsize->size ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Installment Plan</td>
                                            <td style="border-bottom: dotted"><?= $appform->installmentplan->description ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Plan Start Date</td>
                                            <td style="border-bottom: dotted"><?= date("d-m-Y", strtotime($appform->plan_start_date)) ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">File Details</td>
                                            <td style="border-bottom: dotted" >
                                                <div id="filedetails"><?php echo $appform->file->completecode; ?></div>
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
                            </div>
                            <div class="widget-body">
                                <div class="widget-main no-padding">
                                    <!-- 
                                    class="lazycontent" data-url="<?php //echo Yii::$app->urlManager->baseUrl."/index.php?r=property/application/propertyapplication/comments&id=" . $model->application_id     ?>"
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
                                                        <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/uploads/members/pictures/<?php echo $appform->member->image; ?>?<?php echo date('H-i-s'); ?>" height="60">
                                                        <?= ""//app\components\Showimage::widget(['path' => Yii::$app->urlManager->baseUrl . "/uploads/property/documents/picture/" ,'file_name'=>$modelphoto->file_name, 'height' => 80])  ?>
                                                    </td>
                                                    <td align="left"><?= $appform->member->name ?></td>
                                                    <td align="left"><?= $appform->member->sodowo ?></td>
                                                    <td align="left"><?= $appform->member->cnic ?></td>
                                                    <td align="left"><?= $appform->member->phone ?></td>
                                                    <td align="left"><?= ($appform->nominee == NULL ? "" : $appform->nominee->name) ?></td>
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
                                </div>
                            </div>
                        </div>

                        <!--                        <div class="widget-box">
                                                    <div class="widget-header widget-header-medium">
                                                        <h6 class="widget-title bigger"><i class="icon-th-large"></i> Members</h6>
                                                    </div>
                                                    <div class="widget-body">
                                                        <div class="widget-main">
                        <?= $form->field($model, 'member_id')->hiddenInput()->label(false) ?>
                        <?=
                        ""
//                                    $this->renderFile(
//                                            Yii::getAlias("@app") . '/modules/members/views/members/_showdetail.php', [
//                                        'model' => \app\models\application\Members::find()->where(['id' => $model->member_id])->one(),
//                                    ]);
                        ?>                                    
                                                        </div>
                                                    </div>
                                                </div>-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="widget-box transparent">
                            <div class="widget-header widget-header-flat">
                                <h4 class="widget-title lighter">
                                    <i class="ace-icon fa fa-signal"></i>
                                    Approval
                                </h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main padding-4">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="widget-box widget-color-blue3" id="widget-box-7">
                                                <div class="widget-header widget-header-small">
                                                    <h6 class="widget-title smaller">Submission Details</h6>
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        <table style="width: 100%;" >
<!--                                                            <tr>
                                                                <td style="width: 80px; height: 30px;">
                                                                    Date
                                                                </td>
                                                                <td style="border-bottom: dotted;">
<?php //echo $file->showsubmissiondate;  ?>
                                                                </td>
                                                            </tr>-->
                                                            <tr>
                                                                <td style="vertical-align: top;">
                                                                    Remarks
                                                                </td>
                                                                <td style="height: 83px; vertical-align: top;">
<?php echo $file->activation_remarks ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>                                        
                                        </div>                    
                                        <div class="col-xs-4">
                                            <div class="widget-box widget-color-blue3" id="widget-box-7">
                                                <div class="widget-header widget-header-small">
                                                    <h6 class="widget-title smaller">Finance Verification</h6>
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        <table style="width: 100%;" >
                                                            <tr>
                                                                <td style="width: 80px; height: 30px;">
                                                                    Refund Amount
                                                                </td>
                                                                <td style="border-bottom: dotted;">
<?php echo $file->refund_amount; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="vertical-align: top;">
                                                                    Remarks
                                                                </td>
                                                                <td style="height: 83px; vertical-align: top;">
<?php echo $file->activation_fin_remarks ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>                                        
                                        </div>                    
                                        <div class="col-xs-4">
                                            <div class="widget-box widget-color-blue3" id="widget-box-7">
                                                <div class="widget-header widget-header-small">
                                                    <h6 class="widget-title smaller">Approval</h6>
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        <?php
                                                        echo $form->field($file, 'activation_ver_remarks')->textarea()->label('Remarks');
                                                        ?>
                                                    </div>
                                                    <div class="widget-toolbox padding-8 clearfix">
                                                        <!--                                                        <button class="btn btn-xs btn-danger pull-left">
                                                                                                                    <i class="ace-icon fa fa-times"></i>
                                                                                                                    <span class="bigger-110">I don't accept</span>
                                                                                                                </button>-->

                                                        <button class="btn btn-xs btn-success pull-right multiplesubmitbuttons" type="submit" name="submit" value="submit">
                                                            <span class="bigger-110">Approve</span>

                                                            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                        </button>
                                                    </div>                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>                    
                                </div>

                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
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
                                                <a onclick="$('.childtabs').removeClass('active'); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/financialsmry&id=<?php echo $appform->file->id; ?>">
                                                    <i class="green ace-icon fa fa-home bigger-120"></i>
                                                    Summary
                                                </a>
                                            </li>

                                            <li class=" childtabs">
                                                <a onclick="$('.childtabs').removeClass('active'); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/plotcharges&id=<?php echo $appform->file->id; ?>&sourcepage=<?php echo Yii::$app->urlManager->baseUrl . "/index.php?r=property/membership/memberships/approvaldetail%26id=" . $model->ms_id; ?>&allowedit=no">
                                                    <i class="green ace-icon fa fa-th bigger-120"></i>
                                                    Fees/Charges
                                                </a>
                                            </li>

                                            <li class="active childtabs">
                                                <a onclick="$('.childtabs').removeClass('active'); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/plotinstallments&id=<?php echo $appform->file->id; ?>&sourcepage=<?php echo Yii::$app->urlManager->baseUrl . "/index.php?r=property/membership/memberships/approvaldetail%26id=" . $model->ms_id; ?>&allowedit=no">
                                                    <i class="green ace-icon fa fa-home bigger-120"></i>
                                                    Installment Details
                                                </a>
                                            </li>
                                            <?php
//                            if ($depositallowd) {
                                            ?>
                                            <li class=" childtabs">
                                                <a onclick="$('.childtabs').removeClass('active'); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/voucherplotdetail/plotreceipts&id=<?php echo $appform->file->id; ?>">
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
                                                <a onclick="$('.childtabs').removeClass('active'); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/plotmemberships&id=<?php echo $appform->file->id; ?>">
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
                                                    'model' => $modelinstallmentplan,
                                                    'sourcepage' => Yii::$app->urlManager->baseUrl . "/index.php?r=property/membership/memberships/approvaldetail%26id=" . $model->ms_id,
                                                    'myrights' => $instpaymentrights,
                                                    'allowedit' => 'no',
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
            </div>
        </div>

        <?php
        if (!$model->isNewRecord) {
            echo \app\components\Commentbox::widget([
                'title' => 'Comments',
                'dataurl' => 'property/membership/memberships/comments&id=' . $model->ms_id,
                'submiturl' => 'property/membership/memberships/updatecomments',
                'parentval' => $model->ms_id,
                'allowadd' => 1,
            ]);
        }
        ?>
<?php ActiveForm::end(); ?>
    </div>
</div>
<?php
//echo $this->renderFile(Yii::getAlias("@app").'\modules\members\views\members\_find.php', ['model'=> new app\models\application\Members()]);
?>