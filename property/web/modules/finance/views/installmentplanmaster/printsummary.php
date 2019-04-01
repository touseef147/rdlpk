<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\InstallmentplanmasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Installmentplanmasters';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Project id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Category id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Description      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Total amount      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">No of installments      </th>
      <th class="HeaderRight" style="border-bottom:thin solid">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->project_id; ?>      </td>

                                                                  <td class="GridMiddleCell" align="right"><?php echo $row->category_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->description; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->total_amount; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->no_of_installments; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

