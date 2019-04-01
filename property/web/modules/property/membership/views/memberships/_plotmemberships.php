<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\InstallpaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="widget-box ui-sortable-handle" id="widget-box-1">
    <div class="widget-body">
        <div class="widget-main no-padding">
            <table id="simple-table" class="table  table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center" style="width:40px;">      </th>
                        <th class="detail-col">Ms. No.</th>
                        <th class="detail-col">Date</th>
                        <th class="detail-col">Type</th>
                        <th class="detail-col">Status</th>
                        <th class="detail-col">Remarks</th>
                        <th style="width:40px;">      </th>
                    </tr>
                </thead>
                <tbody>
                    <?php //$rows = $dataProvider->getModels();  ?>
                    <?php foreach ($model as $row) { ?>
                        <tr>
                            <td class="center">      </td>
                            <td align="left"><?php echo $row->ms_no; ?>      </td>
                            <td align="left"><?php echo ""; //$row->showduedate;  ?>      </td>
                            <td align="right"><?php echo ""; //number_format($row->dueamount);  ?>      </td>
                            <td align="left"><?php echo ""; //($row->receipt == "" ? "" : $row->receipt->instrument->showentrydate);  ?>      </td>
                            <td align="left"><?php echo ""; //$row->remarks;  ?>      </td>
                            <td class="center">
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
        <div class="widget-toolbox padding-8 clearfix">
            <?= ""//LinkPager::widget(['pagination' => $dataProvider->pagination])  ?>
        </div>        
    </div>
</div>
