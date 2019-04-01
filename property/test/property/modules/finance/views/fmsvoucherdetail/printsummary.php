<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\finance\models\FmsvoucherdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fmsvoucherdetails';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Voucher id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Application id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Member id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Plot id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Membership id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Account id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Dr amount      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Cr amount      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Remarks      </th>
      <th class="HeaderRight" style="border-bottom:thin solid">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->voucher_id; ?>      </td>

                                                                  <td class="GridMiddleCell" align="right"><?php echo $row->application_id; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->member_id; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->plot_id; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->membership_id; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->account_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->dr_amount; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->cr_amount; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->remarks; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

