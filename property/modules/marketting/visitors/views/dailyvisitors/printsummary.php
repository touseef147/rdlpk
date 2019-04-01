<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\visits\models\DailyvisitorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Visitors';
?>
<table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Name      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Profession      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">City      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Contactno      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Email      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Refered by      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Reference      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Reg date      </th>
      <th class="HeaderRight" style="border-bottom:thin solid">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->name; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->profession; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->city; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->contactno; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->email; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->refered_by; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->reference; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->reg_date; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

