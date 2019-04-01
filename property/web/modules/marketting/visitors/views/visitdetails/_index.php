<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\visits\models\VisitdetailssSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Visitdetails';


$colnameclass = "";

/*
  if(isset($dataProvider->sort->orders["role_type_name"]))
  {
  if($dataProvider->sort->orders["role_type_name"] ==4)
  {
  $colnameclass="sorting_asc";
  }
  if($dataProvider->sort->orders["role_type_name"] ==3)
  {
  $colnameclass="sorting_desc";
  }
  }
 */
?>
<div class="visitdetails-index">

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "marketting", "title" => "Marketting"],
            ["link" => "marketting/visitors", "title" => "Visits"],
            ["link" => "marketting/visitors/dailyvisits/index", "title" => "Daily Transactions"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <input type="hidden" id="tpageno" name="tpageno" value="<?= $dataProvider->pagination->page ?>">
    <input type="hidden" id="tpagesize" name="tpagesize" value="<?= $dataProvider->pagination->pageSize ?>">
    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="widget-box ui-sortable-handle" id="widget-box-1">
                    <div class="widget-header widget-header-large">
                        <h4 class="widget-title"><?= Html::encode($this->title) ?></h4>

                        <div class="widget-toolbar">
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/dailyvisitors/create" class="ajaxlink">Add Visitor</a>
                            <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitdetails/sidebarsummary">
                            <input type="hidden" id="tsort" name="tsort" value="">
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center" style="width:40px;">      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('visitors_id') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('visit_type') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('visit_date') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('next_visit') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('followup_status') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('remarks') ?>      </th>
                                        <th style="width:40px;">      </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $rows = $dataProvider->getModels(); ?>
                                    <?php foreach ($rows as $row) { ?>
                                        <tr>
                                            <td class="center">      </td>
                                            <td align="right"><a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitdetails/followup&id=<?php echo $row->visitors_id; ?>&visitid=<?php echo $row->id; ?>" class="ajaxlink"><?php echo ($row->visitor == null ? "" : ($row->visitors_id == 0 ? "" : $row->visitor->name)); ?></a>
                                            </td>

                                            <td align="left"><?php echo $row->visit_type; ?>      </td>
                                            <td align="left"><?php echo date("d-m-Y",  strtotime($row->visit_date)); ?>      </td>
                                            <td align="left"><?php echo date("d-m-Y",  strtotime($row->next_visit)); ?>      </td>
                                            <td align="left">
                                                <?php
                                                if ($row->followup_status == 0)
                                                    echo "Pending";
                                                elseif ($row->followup_status == 1)
                                                    echo "Done";
                                                elseif ($row->followup_status == 2)
                                                    echo "Cancelled";
                                                elseif ($row->followup_status == 3)
                                                    echo "Visit Again";
                                                ?>
                                            </td>
                                            <td align="left"><?php echo $row->remarks; ?>      </td>
                                            <td class="center">
                                                <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitdetails/update&id=<?php echo $row->id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                    <span class="blue">
                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                    </span>
                                                </a>
                                                <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitdetails/delete&id=<?php echo $row->id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
                                                    <span class="red">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
<?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="widget-toolbox padding-8 clearfix">
<?= LinkPager::widget(['pagination' => $dataProvider->pagination]) ?>
                        </div>        
                    </div>
                </div>
                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

</form>


</div>
