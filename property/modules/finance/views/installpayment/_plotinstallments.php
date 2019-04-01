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
//$approvalallowed = false;

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
                    <?php //$rows = $dataProvider->getModels();  ?>
                    <?php
                    $plotid = 0;
                    $totaldue = 0;
                    $totalpaid = 0;
                    foreach ($model as $row) {
                        //print_r($row->receipt);
                        //if($row->receipt != NULL && $row->receipt->instrument != NULL)
                          //  print_r($row->receipt->instrument);
                        
                        $plotid = $row->plot_id;
                        $totaldue += floatval($row->dueamount);
                        $totalpaid += floatval($row->paidamount);

                        $allowrecupdate = ($row->receipt == NULL || $row->receipt->instrument == NULL ? true : ($row->receipt->instrument->entry_status == 4 ? FALSE : TRUE));
                    $entrystatuscss = ($row->receipt == NULL || $row->receipt->instrument == NULL ? "" : ($row->receipt->instrument->entry_status == 4 ? "color: rgb(87, 189, 87);" : ""));
                        ?>
                        <tr>
                            <td align="left"><?php echo $row->lab; ?>      </td>
                            <td align="left"><?php echo $row->showduedate; ?>      </td>
                            <td align="left"><?php echo ($row->receipt == NULL || $row->receipt->instrument == NULL ? "" : $row->receipt->instrument->showentrydate); ?>      </td>
                            <td align="right"><?php echo number_format($row->dueamount); ?>      </td>
                            <td align="right"><?php echo ($row->paidamount == "" || $row->paidamount == 0 ? "" : number_format($row->paidamount)); ?>      </td>
                            <td align="left"><?php echo ($row->receipt == NULL || $row->receipt->instrument == NULL ? "" : $row->receipt->instrument->amounttypetitle); ?>      </td>
                            <td align="left"><?php echo ($row->receipt == NULL || $row->receipt->instrument == NULL ? "" : $row->receipt->instrument->voucher_sr_no); ?>      </td>
                            <td align="left"><?php echo ($row->receipt == NULL || $row->receipt->instrument == NULL ? "" : $row->receipt->deposit_slip_no); ?>      </td>
                            <td align="left"><?php echo ($row->receipt == NULL || $row->receipt->instrument == NULL ? "" : ($row->receipt->receipt_no == "" ? $row->receipt->jv_no : $row->receipt->receipt_no)); ?>      </td>
                            <td align="left"><?php echo $row->remarks; ?>      </td>
                            <td align="left" style="<?= $entrystatuscss ?>">
                                <?php echo ($row->receipt == NULL || $row->receipt->instrument == NULL ? "" : $row->receipt->instrument->entrystatustitle); ?>      
                            </td>
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
                    <tr style="background-color: rgb(240, 240, 240);">
                        <td align="left"><strong>TOTAL</strong></td>
                        <td align="left"></td>
                        <td align="left"></td>
                        <td align="right"><strong><?php echo number_format($totaldue); ?></strong>      </td>
                        <td align="right"><strong><?php echo number_format($totalpaid); ?></strong>      </td>
                        <td align="left"></td>
                        <td align="left"></td>
                        <td align="left"></td>
                        <td align="left"></td>
                        <td align="left"></td>
                        <td align="left"></td>
                        <td class="center">
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="widget-toolbox padding-8 clearfix">
<?php
if ($allowinstupdate) {
    ?>
                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/plotcustomizeinstallments&id=<?php echo $plotid; ?>&sourcepage=<?php echo str_replace("&", "%26", $sourcepage); ?>" class="ajaxlink">Customize Plan</a>
                <?php
            }
            ?>
            <?= ""//LinkPager::widget(['pagination' => $dataProvider->pagination])  ?>
        </div>        
    </div>
</div>
