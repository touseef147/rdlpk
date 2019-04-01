<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\PropertymembershipsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transfers';


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
<div class="propertymemberships-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
//            ["link" => "property/membership/default/index", "title" => "Memberships Control Panel"],
            ["link" => "", "title" => Html::encode($this->title)],
        ],
    ])
    ?>

    <input type="hidden" id="tpageno" name="tpageno" value="<?= $dataProvider->pagination->page ?>">
    <input type="hidden" id="tpagesize" name="tpagesize" value="<?= $dataProvider->pagination->pageSize ?>">
    <div class="page-content">

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
                        <li>
                            <a class="tab-pane-content" data-toggle="tab" href="#tab1" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/index">
                                <i class="green ace-icon fa fa-home bigger-120"></i>
                                Memberships
                            </a>
                        </li>

                        <li>
                            <a class="tab-pane-content" data-toggle="tab" href="#tab2" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/allotments/index">
                                <i class="green ace-icon fa fa-th bigger-120"></i>
                                Allotments
                                <span class="badge badge-danger">---</span>
                            </a>
                        </li>

                        <li class="active">
                            <a data-toggle="tab" href="#tab3">
                                <i class="green ace-icon fa fa-th bigger-120"></i>
                                Transfers
                                <span class="badge badge-danger">---</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content no-padding">
                        <div id="tab1" class="tab-pane fade in">
                        </div>

                        <div id="tab2" class="tab-pane fade in">
                        </div>

                        <div id="tab3" class="tab-pane fade in active">
                            <div class="widget-box ui-sortable-handle" id="widget-box-1">
<!--                                <div class="widget-header widget-header-large">
                                    <h4 class="widget-title"><?= Html::encode($this->title) ?></h4>

                                    <div class="widget-toolbar">
                                        <?php if (array_key_exists("property/membership/transfers/create", $myrights)) {
                                            ?>                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/transfers/create" class="ajaxlink">Add</a>
                                        <?php }
                                        ?>                                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/transfers/sidebarsummary">
                                        <input type="hidden" id="tsort" name="tsort" value="">
                                    </div>
                                </div>-->

                                <div class="widget-body">
                                    <div class="widget-main no-padding">
                                        <table id="simple-table" class="table  table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="center" style="width:40px;">      </th>
                                                    <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('plot_id') ?>      </th>
                                                    <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('member_id') ?>      </th>
                                                    <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('ms_no') ?>      </th>
                                                    <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('ms_status') ?>      </th>
                                                    <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('is_joint') ?>      </th>
                                                    <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('parent_ms_id') ?>      </th>
                                                    <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('is_active') ?>      </th>
                                                    <th style="width:40px;">      </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $rows = $dataProvider->getModels(); ?>
                                                <?php foreach ($rows as $row) { ?>
                                                    <tr>
                                                        <td class="center">      </td>
                                                        <td align="right">                            <?php if (array_key_exists("property/membership/transfers/update", $myrights)) {
                                                    ?>                                                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/transfers/update&id=<?php echo $row->ms_id; ?>" class="ajaxlink"><?php echo $row->plot_id; ?></a>
                                                            <?php
                                                            } else {
                                                                echo $row->plot_id;
                                                            }
                                                            ?>                                                                    </td>

                                                        <td align="right"><?php echo $row->member_id; ?>      </td>
                                                        <td align="left"><?php echo $row->ms_no; ?>      </td>
                                                        <td align="right"><?php echo $row->ms_status; ?>      </td>
                                                        <td align="right"><?php echo $row->is_joint; ?>      </td>
                                                        <td align="right"><?php echo $row->parent_ms_id; ?>      </td>
                                                        <td align="right"><?php echo $row->is_active; ?>      </td>
                                                        <td class="center">
                                                            <?php if (array_key_exists("property/membership/transfers/update", $myrights)) {?>      <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/transfers/update&id=<?php echo $row->ms_id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                            <span class="blue">
                                                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                            </span>
                                                            </a><?php } ?>
                                                            <?php if (array_key_exists("property/membership/transfers/delete", $myrights)) {?>      <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/transfers/delete&id=<?php echo $row->ms_id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
                                                            <span class="red">
                                                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                            </span>
                                                            </a><?php } ?>
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
                        </div>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>


        </div>
    </div>

</div>