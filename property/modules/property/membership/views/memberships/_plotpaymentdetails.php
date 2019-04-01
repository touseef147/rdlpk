<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\InstallpaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment Details';


$colnameclass = "";

/*
  if(isset($dataProvider->sort->orders["role_type_name"]))
  {
  if($dataProvider->sort->orders["role_type_name"] ==4)
  {
  $colnameclass="sorting_asc";
  }
  if($dataProvider->sort->orders["role_type_name"] ==3)
  {
  $colnameclass="sorting_desc";
  }
  }
 */
$depositallowd = false;
$verificationallowd = false;
$approvalallowed = false;

$multiplerights = TRUE;

//if (array_key_exists("finance/fmsvoucher/centerverification", $myrights)) {
//    $depositallowd = true;
//}
//
//if (array_key_exists("finance/fmsvoucher/financeverification", $myrights)) {
//    $verificationallowd = true;
//}
//
//if (array_key_exists("finance/fmsvoucher/financeapproval", $myrights)) {
//    $approvalallowed = true;
//}
//
//if ($depositallowd || $verificationallowd || $approvalallowed) {
//    $multiplerights = true;
//}
?>
<div class="installpayment-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => $parentpage, "title" => "Memberships"],
            ["link" => "", "title" => Html::encode($this->title)],
        ],
    ])
    ?>

    <input type="hidden" id="tpageno" name="tpageno" value="<?= "0"//$dataProvider->pagination->page       ?>">
    <input type="hidden" id="tpagesize" name="tpagesize" value="<?= "50"//$dataProvider->pagination->pageSize       ?>">
    <div class="page-content">
        <span class="pull-right bolder bigger-110 " style="margin-top: 10px;">Membership No.: <span class="red"><?php echo ($plot->currentmembership == null ? "N/A" : ($plot->currentmembership->ms_status == 1 ? "Pending" : $plot->currentmembership->completecode)); ?></span></span>
        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>


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
                            class="lazycontent" data-url="<?php //echo Yii::$app->urlManager->baseUrl."/index.php?r=property/application/propertyapplication/comments&id=" . $model->application_id      ?>"
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
                                        <?php foreach ($modeljointmembers as $row) { ?>
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
                <?= ""// $form->field($model, 'member_id')->hiddenInput()->label(false) ?>
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

        <br />

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="widget-box widget-color-purple ui-sortable-handle">
                    <div class="widget-header">
                        <h5 class="widget-title">Financial Details</h5>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <?php if ($multiplerights) {
                                ?>                
                                <div class="tabbable">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="childtabs">
                                            <a onclick="$('.childtabs').removeClass('active'); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/financialsmry&id=<?php echo $plot->id; ?>">
                                                <i class="green ace-icon fa fa-home bigger-120"></i>
                                                Summary
                                            </a>
                                        </li>

                                        <li class=" childtabs">
                                            <a onclick="$('.childtabs').removeClass('active'); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/plotcharges&id=<?php echo $plot->id; ?>&sourcepage=<?php echo Yii::$app->urlManager->baseUrl . "/index.php?r=property/membership/memberships/plotpaymentdetails%26id=" . $plot->id; ?>%26parentpage=<?php echo $parentpage; ?>">
                                                <i class="green ace-icon fa fa-th bigger-120"></i>
                                                Fees/Charges
                                            </a>
                                        </li>

                                        <li class="active childtabs">
                                            <a onclick="$('.childtabs').removeClass('active'); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/plotinstallments&id=<?php echo $plot->id; ?>&sourcepage=<?php echo Yii::$app->urlManager->baseUrl . "/index.php?r=property/membership/memberships/plotpaymentdetails%26id=" . $plot->id; ?>%26parentpage=<?php echo $parentpage; ?>">
                                                <i class="green ace-icon fa fa-home bigger-120"></i>
                                                Installment Details
                                            </a>
                                        </li>
                                        <?php
//                            if ($depositallowd) {
                                        ?>
                                        <li class=" childtabs">
                                            <a onclick="$('.childtabs').removeClass('active'); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/voucherplotdetail/plotreceipts&id=<?php echo $plot->id; ?>">
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
                                            <a onclick="$('.childtabs').removeClass('active'); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/plotmemberships&id=<?php echo $plot->id; ?>">
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
                                        }       //check multiple rights
                                        ?>
                                        <?=
                                        $this->renderFile(
                                                Yii::getAlias("@app") . '/modules/finance/views/installpayment/_plotinstallments.php', [
                                            'model' => $model,
                                            'myrights' => $instpaymentrights,
                                            'sourcepage' => Yii::$app->urlManager->baseUrl . "/index.php?r=property/membership/memberships/plotpaymentdetails%26id=" . $plot->id . "%26parentpage=" . $parentpage,
                                            'allowedit' => "no",
                                        ]);
                                        ?>                                    
                                        <?php
                                        if ($multiplerights) {
                                            ?>
                                        </div>

                                    </div><!-- /.col -->
                                </div><!-- /.tabable -->
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

</div>
