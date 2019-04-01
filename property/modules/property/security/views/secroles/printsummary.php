<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\security\models\SecrolesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Secroles';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Role type id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Role category id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Role name      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Role so      </th>
      <th class="HeaderRight" style="border-bottom:thin solid">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->role_type_id; ?>      </td>

                                                                  <td class="GridMiddleCell" align="right"><?php echo $row->role_category_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->role_name; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->role_so; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

