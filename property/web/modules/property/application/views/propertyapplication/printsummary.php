<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\finance\models\PropertyapplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Propertyapplications';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Project id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Sales center id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Member id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Application no      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Property type      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Property size      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Dealer id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Nominee id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Voucher id      </th>
      <th class="HeaderRight" style="border-bottom:thin solid">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->project_id; ?>      </td>

                                                                  <td class="GridMiddleCell" align="right"><?php echo $row->sales_center_id; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->member_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->application_no; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->property_type; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->property_size; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->dealer_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->nominee_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->voucher_id; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

