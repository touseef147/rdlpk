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
            ["link" => "property/membership/memberships/index", "title" => "Memberships"],
            ["link" => "", "title" => Html::encode($this->title)],
        ],
    ])
    ?>

    <input type="hidden" id="tpageno" name="tpageno" value="<?= "0"//$dataProvider->pagination->page   ?>">
    <input type="hidden" id="tpagesize" name="tpagesize" value="<?= "50"//$dataProvider->pagination->pageSize   ?>">
    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-6">
                <!-- PAGE CONTENT BEGINS -->


                <div class="widget-box ui-sortable-handle" id="widget-box-1">
                    <div class="widget-header widget-header-small">
                        <h6 class="widget-title">Property Details</h6>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <?=
                            $this->renderFile(
                                    Yii::getAlias("@app") . '/modules/property/config/views/files/_showdetail.php', [
                                'model' => $plot
                            ]);
                            ?>                                    
                        </div>
                    </div>
                </div>
            </div><!-- /.col -->
            <div class="col-xs-6">
                <div class="widget-box ui-sortable-handle" id="widget-box-1">
                    <div class="widget-header widget-header-small">
                        <h6 class="widget-title">Member Details</h6>

                        <div class="widget-toolbar">
                            MS. No. : <span class="red bolder"><?php echo ($plot->currentmembership == null ? "N/A" : ($plot->currentmembership->ms_status == 1 ? "Pending" : $plot->currentmembership->ms_no)); ?></span>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <?php
                            if ($plot->currentmembership != NULL) {
                                echo $this->renderFile(
                                        Yii::getAlias("@app") . '/modules/members/views/members/showrecord.php', [
                                    'model' => $plot->currentmembership->member
                                ]);
                            }
                            ?>                                    
                        </div>
                    </div>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <br />

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->


                <?php if ($multiplerights) {
                    ?>                
                    <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active childtabs">
                                <a onclick="$('.childtabs').removeClass('active' ); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/plotinstallments&id=<?php echo $plot->id; ?>">
                                    <i class="green ace-icon fa fa-home bigger-120"></i>
                                    Payment Details
                                </a>
                            </li>

                            <?php
//                            if ($depositallowd) {
                            ?>
                            <li class=" childtabs">
                                <a onclick="$('.childtabs').removeClass('active' ); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/voucherplotdetail/plotreceipts&id=<?php echo $plot->id; ?>">
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
                                <a onclick="$('.childtabs').removeClass('active' ); $(this).parent().addClass('active');" class="ajaxlink" data-targetdiv="contentdetail" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/plotmemberships&id=<?php echo $plot->id; ?>">
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
                                'model' => $model
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
                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

</div>
