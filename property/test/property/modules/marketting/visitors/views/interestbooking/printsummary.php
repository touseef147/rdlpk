<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\visits\models\InterestbookingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Interestbookings';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Visitors id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Com res      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Size2      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Amount      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Booking date      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">No of plots      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Type      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Deal by      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Center id      </th>
      <th class="HeaderRight" style="border-bottom:thin solid">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->visitors_id; ?>      </td>

                                                                  <td class="GridMiddleCell" align="left"><?php echo $row->com_res; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->size2; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->amount; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->booking_date; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->no_of_plots; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->type; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->deal_by; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->center_id; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

