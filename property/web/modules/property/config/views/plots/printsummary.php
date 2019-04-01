<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\propertyconfig\models\PlotsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plots';
$this->params['breadcrumbs'][] = $this->title;

$this->reporttitle1 = "Plots Summary";
$this->reportdocno = "RDBL/PROP/01";
$this->reportrev = "01";
$this->reportdocdate = "01-Jan-2014";
$this->reportwidth = "98%";
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
            <th class="HeaderMiddle" style="border-bottom:thin solid">Price      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Com res      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Category id      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Sector      </th>
            <th class="HeaderMiddle" style="border-bottom:thin solid">Image      </th>
        </tr>
    </thead>
    <tbody>
<?php $rows = $dataProvider->getModels(); ?>
<?php foreach ($rows as $row) { ?>
            <tr>
                <td class="GridLeftCell">      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->type; ?>      </td>

                <td class="GridMiddleCell" align="right"><?php echo $row->project_id; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->street_id; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->plot_detail_address; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->plot_size; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->size2; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->price; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->com_res; ?>      </td>
                <td class="GridMiddleCell" align="right"><?php echo $row->category_id; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->sector; ?>      </td>
                <td class="GridMiddleCell" align="left"><?php echo $row->image; ?>      </td>
            </tr>
<?php } ?>
    </tbody>
</table>


