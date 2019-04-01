<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\PropertydocumentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Propertydocuments';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Category id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Title      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">File name      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Remarks      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Project id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Sales center id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Membership id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Entered by      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Entry date      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Application id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Plot id      </th>
      <th class="HeaderRight" style="border-bottom:thin solid">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->category_id; ?>      </td>

                                                                  <td class="GridMiddleCell" align="left"><?php echo $row->title; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->file_name; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->remarks; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->project_id; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->sales_center_id; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->membership_id; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->entered_by; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->entry_date; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->application_id; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->plot_id; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

