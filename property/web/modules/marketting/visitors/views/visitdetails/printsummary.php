<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\visits\models\VisitdetailssSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Visitdetails';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Visitors id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Visit no      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Visit type      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Visit date      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Deal by      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Next visit      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Followup status      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Remarks      </th>
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

                                                                  <td class="GridMiddleCell" align="left"><?php echo $row->visit_no; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->visit_type; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->visit_date; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->deal_by; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->next_visit; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->followup_status; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->remarks; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->center_id; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

