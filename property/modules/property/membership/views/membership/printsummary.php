<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\PlotsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plots';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Type      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Project id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Street id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Plot detail address      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Plot size      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Size2      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Installment      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Price      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Create date      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Modify date      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Com res      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Category id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Sector      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Image      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Shap id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Cstatus      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Status      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Fstatus      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Rstatus      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Bstatus      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Bid      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Atype      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Rownumber      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Application id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Ms member id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Ms creation date      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Ms modification date      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Ms status      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Ms no      </th>
      <th class="HeaderRight" style="border-bottom:thin solid">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->type; ?>      </td>

                                                                  <td class="GridMiddleCell" align="right"><?php echo $row->project_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->street_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->plot_detail_address; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->plot_size; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->size2; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->installment; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->price; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->create_date; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->modify_date; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->com_res; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->category_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->sector; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->image; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->shap_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->cstatus; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->status; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->fstatus; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->rstatus; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->bstatus; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->bid; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->atype; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->rownumber; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->application_id; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->ms_member_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->ms_creation_date; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->ms_modification_date; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->ms_status; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->ms_no; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

