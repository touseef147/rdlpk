<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\security\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;




?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Firstname      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Middelname      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Lastname      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Pic      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Sodowo      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Cnic      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Address      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">City      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Email      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">State      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Zip      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Country      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Mobile      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Username      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Password      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per1      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per2      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per3      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per4      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per5      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per6      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per7      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per8      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per9      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per10      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per11      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per12      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per13      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per14      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per15      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per16      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Per17      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Status      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Fp      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Login status      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">User id      </th>
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
      <td class="GridMiddleCell" align="left"><?php echo $row->firstname; ?>      </td>

                                                                  <td class="GridMiddleCell" align="left"><?php echo $row->middelname; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->lastname; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->pic; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->sodowo; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->cnic; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->address; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->city; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->email; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->state; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->zip; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->country; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->mobile; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->username; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->password; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->per1; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->per2; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->per3; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->per4; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->per5; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->per6; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->per7; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->per8; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->per9; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->per10; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->per11; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->per12; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->per13; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->per14; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->per15; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->per16; ?>      </td>
      <td class="GridMiddleCell" align="right"><?php echo $row->per17; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->status; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->fp; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->login_status; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->user_id; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->create_date; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->modify_date; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

