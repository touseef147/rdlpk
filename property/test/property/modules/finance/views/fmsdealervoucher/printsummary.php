<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\finance\models\FmsvoucherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fmsvouchers';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Voucher type      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Bank id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Entry date      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Transaction date      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Voucher sr no      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Sales center id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Folio no      </th>
      <th class="HeaderRight" style="border-bottom:thin solid">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->voucher_type; ?>      </td>

                                                                  <td class="GridMiddleCell" align="right"><?php echo $row->bank_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->entry_date; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->transaction_date; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->voucher_sr_no; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->sales_center_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->folio_no; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

