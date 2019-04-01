<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\propertyconfig\models\MemberplotSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Memberplots';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Plot id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Member id      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Create date      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Modify date      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Noi      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Insplan      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Status      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Fstatus      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">User name      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Plotno      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Comment      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Fcomment      </th>
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
      <td class="GridMiddleCell" align="left"><?php echo $row->create_date; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->modify_date; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->noi; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->insplan; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->status; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->fstatus; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->user_name; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->plotno; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->comment; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->fcomment; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

