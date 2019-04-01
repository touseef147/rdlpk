<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\finance\models\ChargesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Charges';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Name      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Note      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Monthly      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Total      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Type      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Project id      </th>
      <th class="HeaderRight" style="border-bottom:thin solid">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->name; ?>      </td>

                                                                  <td class="GridMiddleCell" align="left"><?php echo $row->note; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->monthly; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->total; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->type; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->project_id; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

