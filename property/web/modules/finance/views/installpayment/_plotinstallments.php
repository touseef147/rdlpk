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
<div class="widget-box ui-sortable-handle" id="widget-box-1">
    <div class="widget-body">
        <div class="widget-main no-padding">
            <table id="simple-table" class="table  table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center" style="width:40px;">      </th>
                        <th class="detail-col  <?php echo $colnameclass; ?>">Description</th>
                        <th class="detail-col  <?php echo $colnameclass; ?>">Due Date</th>
                        <th class="detail-col  <?php echo $colnameclass; ?>">Due Amount</th>
                        <th class="detail-col  <?php echo $colnameclass; ?>">Paid Date</th>
                        <th class="detail-col  <?php echo $colnameclass; ?>">Paid Amount      </th>
                        <th class="detail-col  <?php echo $colnameclass; ?>">Remarks</th>
                        <th class="detail-col  <?php echo $colnameclass; ?>">Receipt No.</th>
                        <th style="width:40px;">      </th>
                    </tr>
                </thead>
                <tbody>
                    <?php //$rows = $dataProvider->getModels(); ?>
                    <?php foreach ($model as $row) { ?>
                        <tr>
                            <td class="center">      </td>
                            <td align="left"><?php echo $row->lab; ?>      </td>
                            <td align="left"><?php echo $row->showduedate; ?>      </td>
                            <td align="right"><?php echo number_format($row->dueamount); ?>      </td>
                            <td align="left"><?php echo ($row->receipt == "" ? "" : $row->receipt->instrument->showentrydate); ?>      </td>
                            <td align="right"><?php echo ($row->paidamount == "" || $row->paidamount == 0 ? "" : number_format($row->paidamount)); ?>      </td>
                            <td align="left"><?php echo $row->remarks; ?>      </td>
                            <td align="left"><?php echo ($row->receipt == "" ? "" : $row->receipt->receipt_no); ?>      </td>
                            <td class="center">
                                <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/update&id=<?php echo $row->id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                    <span class="blue">
                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                    </span>
                                </a>
                                <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/delete&id=<?php echo $row->id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
                                    <span class="red">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                    </span>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
        <div class="widget-toolbox padding-8 clearfix">
            <?= ""//LinkPager::widget(['pagination' => $dataProvider->pagination]) ?>
        </div>        
    </div>
</div>
