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
      <th class="HeaderMiddle" style="border-bottom:thin solid">User Name      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Sales Center      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">No of Visits      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">No of Calls      </th>
      </tr>
  </thead>
  <tbody>
<?php      //$rows = $dataProvider->getModels(); ?>
<?php      foreach ($model as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->username; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->center_name; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->no_of_visits; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->no_of_calls; ?>      </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

