<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\security\models\SecmoduleactionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Secmoduleactions';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Module id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Action title      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Action so      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Action detail      </th>
      <th class="HeaderRight" style="border-bottom:thin solid">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->module_id; ?>      </td>

                                                                  <td class="GridMiddleCell" align="left"><?php echo $row->action_title; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->action_so; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->action_detail; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

