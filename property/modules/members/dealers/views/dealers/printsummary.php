<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\members\models\MembersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dealers';
$this->params['breadcrumbs'][] = $this->title;
?>
<table cellpadding="3" cellspacing="0" width="100%">
    <thead>
        <tr class="HeaderBlue" height="25">
            <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Name      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Mem id      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Username      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Sodowo      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Cnic      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Image      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Address      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">City id      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Phone      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Email      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Country id      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">State      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Nomineename      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Nomineecnic      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Rwa      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Password      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Status      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Fp      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Login status      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">User id      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Create date      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Modify date      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Dob      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">RFM      </th>
            <th class="HeaderRight" style="border-bottom:thin solid">      </th>
        </tr>
    </thead>
    <tbody>
<?php $rows = $dataProvider->getModels(); ?>
<?php foreach ($rows as $row) { ?>
            <tr>
                <td class="GridLeftCell">      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->name; ?>      </td>

                <td class="GridMiddleCell" align="left"><?php echo $row->mem_id; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->username; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->sodowo; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->cnic; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->image; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->address; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->city_id; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->phone; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->email; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->country_id; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->state; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->nomineename; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->nomineecnic; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->rwa; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->password; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->status; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->fp; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->login_status; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->user_id; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->create_date; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->modify_date; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->dob; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->RFM; ?>      </td>
                <td class="GridRightCell">       </td>
            </tr>
<?php } ?>
    </tbody>
</table>


