<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\security\models\SecrolesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Roles';
//$this->params['breadcrumbs'][] = $this->title;

$this->reporttitle1 = "Roles Summary";
$this->reportdocno = "RDBL/PROP/01";
$this->reportrev = "01";
$this->reportdocdate = "01-Jan-2014";
$this->reportwidth = "98%";
?>
<table cellpadding="3" cellspacing="0" width="100%">
    <thead>
        <tr class="HeaderBlue" height="25">
            <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Role type      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Role category      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Role name      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Role so      </th>
            <th class="HeaderRight" style="border-bottom:thin solid">      </th>
        </tr>
    </thead>
    <tbody>
<?php $rows = $dataProvider->getModels(); ?>
<?php foreach ($rows as $row) { ?>
            <tr>
                <td class="GridLeftCell">      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->roleType->role_type_name; ?>      </td>

                <td class="GridMiddleCell" align="left"><?php echo $row->roleCategory->role_category_name; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->role_name; ?>      </td>
                <td class="GridMiddleCell" align="right"><?php echo $row->role_so; ?>      </td>
                <td class="GridRightCell">       </td>
            </tr>
<?php } ?>
    </tbody>
</table>


