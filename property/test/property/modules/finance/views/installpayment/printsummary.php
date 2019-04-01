<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\finance\models\InstallpaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Installpayments';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Ref      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Plot id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Payment type      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Paidamount      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Dueamount      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Discount      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Surcharge      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Lab      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Paidsurcharge      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Mem id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Paidas      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Detail      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Date      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Remarks      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Others      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Due date      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Paid date      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Fstatus      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Fid      </th>
      <th class="HeaderRight" style="border-bottom:thin solid">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->ref; ?>      </td>

                                                                  <td class="GridMiddleCell" align="left"><?php echo $row->plot_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->payment_type; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->paidamount; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->dueamount; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->discount; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->surcharge; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->lab; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->paidsurcharge; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->mem_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->paidas; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->detail; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->date; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->remarks; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->others; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->due_date; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->paid_date; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->fstatus; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->fid; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

