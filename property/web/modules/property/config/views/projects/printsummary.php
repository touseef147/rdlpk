<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\propertyconfig\models\ProjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Project name      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Url      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Code      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Teaser      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Details      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Project image      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Project map      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Land map      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Status      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Create date      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Modify date      </th>
      <th class="HeaderRight" style="border-bottom:thin solid">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->project_name; ?>      </td>

                                                                  <td class="GridMiddleCell" align="left"><?php echo $row->url; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->code; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->teaser; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->details; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->project_image; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->project_map; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->land_map; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->status; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->create_date; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->modify_date; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

