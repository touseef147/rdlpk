<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\PropertymembershipsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Propertymemberships';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Plot id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Member id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Ms no      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Ms status      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Created on      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Modified on      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Is joint      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Parent ms id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">User id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Is active      </th>
      <th class="HeaderRight" style="border-bottom:thin solid">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->plot_id; ?>      </td>

                                                                  <td class="GridMiddleCell" align="right"><?php echo $row->member_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->ms_no; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->ms_status; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->created_on; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->modified_on; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->is_joint; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->parent_ms_id; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->user_id; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->is_active; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

