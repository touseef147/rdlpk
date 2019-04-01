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
$allowinstupdate = false;
$allowinstdelete = false;

$depositallowd = false;
$verificationallowd = false;
$approvalallowed = false;

$multiplerights = TRUE;


if (array_key_exists("finance/installpayment/update", $myrights)) {
    $allowinstupdate = true;
}

if (array_key_exists("finance/installpayment/delete", $myrights)) {
    $allowinstdelete = true;
}

if ($allowedit != "yes") {
    $allowinstupdate = FALSE;
    $allowinstdelete = FALSE;
}

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
$plotid = 0;
//$allowinstupdate = false;
//$allowinstdelete = false;
////$approvalallowed = false;
//
//$multiplerights = TRUE;
//
//if (array_key_exists("finance/installpayment/update", $myrights)) {
//    $allowinstupdate = true;
//}
//
//if (array_key_exists("finance/installpayment/delete", $myrights)) {
//    $allowinstdelete = true;
//}
?>
<div class="widget-box ui-sortable-handle" id="widget-box-1">
    <div class="widget-body">
        <div class="widget-main no-padding">
            <table id="simple-table" class="table  table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Paid Date</th>
                        <th>Due Amount</th>
                        <th>Paid Amount      </th>
                        <th>Payment Mode</th>
                        <th>Instrument No.</th>
                        <th>Deposit Slip No.</th>
                        <th>Receipt/JV No.</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th style="width:40px;">      </th>
                    </tr>
                </thead>
                <tbody>
                    <?php //$rows = $dataProvider->getModels(); ?>
                    <?php 
                    foreach ($model as $row) { 
                        $plotid = $row->plot_id;
                        
                        $allowrecupdate = ($row->receipt == "" ? true : ($row->receipt->instrument->entry_status == 4 ? FALSE : TRUE));
                        $entrystatuscss = ($row->receipt == "" ? "" : ($row->receipt->instrument->entry_status == 4 ? "color: rgb(87, 189, 87);" : ""));
                        ?>
                        <tr>
                            <td align="left"><?php echo $row->lab; ?>      </td>
                            <td align="left"><?php echo $row->showduedate; ?>      </td>
                            <td align="left"><?php echo ($row->receipt == "" ? "" : $row->receipt->instrument->showentrydate); ?>      </td>
                            <td align="right"><?php echo number_format($row->dueamount); ?>      </td>
                            <td align="right"><?php echo ($row->paidamount == "" || $row->paidamount == 0 ? "" : number_format($row->paidamount)); ?>      </td>
                            <td align="left"><?php echo ($row->receipt == "" ? "" : $row->receipt->instrument->amounttypetitle); ?>      </td>
                            <td align="left"><?php echo ($row->receipt == "" ? "" : $row->receipt->instrument->voucher_sr_no); ?>      </td>
                            <td align="left"><?php echo ($row->receipt == "" ? "" : $row->receipt->deposit_slip_no); ?>      </td>
                            <td align="left"><?php echo ($row->receipt == "" ? "" : ($row->receipt->receipt_no == "" ? $row->receipt->jv_no : $row->receipt->receipt_no)); ?>      </td>
                            <td align="left"><?php echo $row->remarks; ?>      </td>
                            <td align="left"><?php echo ($row->receipt == "" ? "" : $row->receipt->instrument->entrystatustitle); ?>      </td>
                            <td class="center">
                                <?php
                                if ($allowinstupdate && $allowrecupdate) {
                                    ?>
                                <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/update&id=<?php echo $row->id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                    <span class="blue">
                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                    </span>
                                </a>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($allowinstdelete && $allowrecupdate) {
                                    ?>
                                <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/delete&id=<?php echo $row->id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
                                    <span class="red">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                    </span>
                                </a>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
        <div class="widget-toolbox padding-8 clearfix">
            <?php
            if ($allowinstupdate) {
                ?>
                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/addplotcharges&id=<?php echo $plotid; ?>&sourcepage=<?php echo str_replace("&", "%26", $sourcepage); ?>" class="ajaxlink">Add</a>
                <?php
            }
            ?>
            <?= ""//LinkPager::widget(['pagination' => $dataProvider->pagination]) ?>
        </div>        
    </div>
</div>
