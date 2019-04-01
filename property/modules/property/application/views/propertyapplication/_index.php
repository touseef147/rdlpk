<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\PropertyapplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Application Forms';


$colnameclass = "";

$arrorder = null;
$sortdesc = "";

//if(isset($dataProvider->sort->getOrders())){
    $arrorder = $dataProvider->sort->getOrders();
    
    $sortdesc = key($arrorder);
    
    if($arrorder[$sortdesc] == 3)
        $sortdesc = "-".$sortdesc;
//}
?>
<div class="propertyapplication-index">

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "", "title" => "Finance"],
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
                            <?php if (array_key_exists("property/application/propertyapplication/create", $myrights)) {
                                ?>                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/application/propertyapplication/create" class="ajaxlink" data-toggle="tooltip" title="Click to Add record.">Add</a>
                            <?php }
                            ?>                                        
                            <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/application/propertyapplication/sidebarsummary">
                            <input type="hidden" id="tsort" name="tsort" value="<?php echo $sortdesc; ?>">
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo $dataProvider->sort->link('application_no') ?>      </th>
                                        <th><?php echo $dataProvider->sort->link('project_id') ?>      </th>
                                        <th><?php echo $dataProvider->sort->link('sales_center_id') ?>      </th>
                                        <th><?php echo $dataProvider->sort->link('member_id') ?>      </th>
                                        <th><?php echo $dataProvider->sort->link('property_type') ?>      </th>
                                        <th><?php echo $dataProvider->sort->link('property_size') ?>      </th>
                                        <th><?php echo $dataProvider->sort->link('dealer_id') ?>      </th>
                                        <th style="width:40px;"><?php echo $dataProvider->sort->link('application_status') ?></th>
                                        <th style="width:40px;">      </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $rows = $dataProvider->getModels(); ?>
                                    <?php foreach ($rows as $row) { ?>
                                        <tr>
                                            <td align="left">
                                                <?php
                                                if ($row->application_status == 0) {
                                                    ?>
                                                    <?= app\components\Detaillistaction::widget(["action" => "property/application/propertyapplication/update", "id" => $row->application_id, "text" => $row->application_no, "rights" => $myrights]) ?>
                                                    <?php
                                                } else {
                                                    if (array_key_exists("property/application/propertyapplication/update", $myrights)) {
                                                        ?>      
                                                        <a  data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/application/propertyapplication/view&id=<?php echo $row->application_id; ?>" class="ajaxlink" data-toggle="tooltip" title="Click to update record.">
                                                            <?php echo $row->application_no; ?>
                                                        </a>
                                                        <?php
                                                        } else {?> <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/application/propertyapplication/view&id=<?php echo $row->application_id; ?>" data-toggle="tooltip" title="Click to update record."> <?php  echo  $row->application_no; }
                                                }
                                                ?></a>
                                            </td>
                                            <td align="left">
                                                <?= ($row->project == null ? "" : $row->project->code) ?>
                                            </td>

                                            <td align="left"><?php echo $row->salecenter->name; ?>      </td>
                                            <td align="left"><?php echo $row->member->name; ?>      </td>
                                            <td align="left">
                                                <?php
                                                if ($row->property_type == 1)
                                                    echo "Residential";
                                                elseif ($row->property_type == 2)
                                                    echo "Commercial";
                                                else
                                                    echo "";
                                                ?>
                                            </td>
                                            <td align="left"><?php echo $row->plotsize->size; ?>      </td>
                                            <td align="left"><?php echo ($row->dealer == null ? "" : $row->dealer->dealers_business_title); ?>      </td>
                                            <td align="left">
                                                <?php if (array_key_exists("property/application/propertyapplication/submit", $myrights)) {
                                                    if($row->application_status ==0 || $row->application_status ==1 || $row->application_status ==2) {
                                                    ?>      
                                                    <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/application/propertyapplication/submit&id=<?php echo $row->application_id; ?>" class="ajaxlink"  data-toggle="tooltip" title="Click to submit record."><?= $row->statustitle ?>
                                                    </a><?php
                                                    } else { echo $row->statustitle;  }
                                                    } ?>
                                            </td>
                                            <td class="center">
                                                <?php if (array_key_exists("property/application/propertyapplication/update", $myrights)) { ?>      <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/application/propertyapplication/update&id=<?php echo $row->application_id; ?>" class="tooltip-error ajaxlink" data-toggle="tooltip" title="Click to update record.">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                        </span>
                                                    </a><?php } ?>
                                                <?php if (array_key_exists("property/application/propertyapplication/delete", $myrights)) { ?>      <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/application/propertyapplication/delete&id=<?php echo $row->application_id; ?>" class="tooltip-error deletelink" data-toggle="tooltip" title="Click to delete record.">
                                                        <span class="red">
                                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                        </span>
                                                    </a><?php } ?>
                                            </td>
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
