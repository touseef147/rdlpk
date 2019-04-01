<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\FmsvoucherplotdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Receipts';


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
<div class="fmsvoucherplotdetail-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard">Home</a>
            </li>
            <li>
                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance" class="ajaxlink">Finance</a>
            </li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ul><!-- /.breadcrumb -->
    </div>

    <input type="hidden" id="tpageno" name="tpageno" value="<?= $dataProvider->pagination->page ?>">
    <input type="hidden" id="tpagesize" name="tpagesize" value="<?= $dataProvider->pagination->pageSize ?>">
    <div class="page-content">

        <div class="page-header">
            <h1>
                <?= Html::encode($this->title) ?>
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                </small>
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="widget-box ui-sortable-handle" id="widget-box-1">
                    <div class="widget-header widget-header-large">
                        <h4 class="widget-title"><?= Html::encode($this->title) ?></h4>

                        <div class="widget-toolbar">
                            <?php if (array_key_exists("finance/voucherplotdetail/create", $myrights)) {
                                ?>                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/voucherplotdetail/create" class="ajaxlink">Add</a>
                            <?php }
                            ?>                                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/voucherplotdetail/sidebarsummary">
                            <input type="hidden" id="tsort" name="tsort" value="">
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center" style="width:40px;">      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('voucher_id') ?>      </th>
<!--                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php //echo $dataProvider->sort->link('member_id') ?>      </th>-->
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('plot_id') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('membership_id') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('receipt_no') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('amount') ?>      </th>
                                        <th style="width:40px;">      </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $rows = $dataProvider->getModels(); ?>
                                    <?php foreach ($rows as $row) { ?>
                                        <tr>
                                            <td class="center">      </td>
                                            <td align="left">                            
                                                <?php if (array_key_exists("finance/voucherplotdetail/update", $myrights)) {
                                        ?>
                                                    <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/voucherplotdetail/update&id=<?php echo $row->voucher_plot_detail_id; ?>" class="ajaxlink"><?php echo $row->instrument->showentrydate; ?></a>
                                                <?php
                                                } else {
                                                    echo $row->instrument->showentrydate;
                                                }
                                                ?>                                                                    </td>

<!--                                            <td align="left"><?php //echo $row->member_id; ?>      </td>-->
                                            <td align="left"><?php echo $row->plot->completecode; ?>      </td>
                                            <td align="left"><?php echo ($row->membership == null ? "" : $row->membership->completecode); ?>      </td>
                                            <td align="left"><?php echo $row->receipt_no; ?>      </td>
                                            <td align="right"><?php echo $row->amount; ?>      </td>
                                            <td class="center">
                                                <?php if (array_key_exists("finance/fmsvoucher/update", $myrights)) {
                                                    
                                                        if($row->instrument->amount_type == 5){
                                                            ?>
                                                <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/update&id=<?php echo $row->voucher_id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                <span class="blue">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </span>
                                                </a>
                                                <?php                                                            
                                                        } else {
                                                            ?>
                                                <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/update&id=<?php echo $row->voucher_id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                <span class="blue">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </span>
                                                </a>
                                                <?php
                                                        }
                                                    ?>      
                                                    <?php
                                                } ?>
                                                <?php if (array_key_exists("finance/voucherplotdetail/update", $myrights)) {?>      <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/voucherplotdetail/update&id=<?php echo $row->voucher_plot_detail_id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                <span class="blue">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </span>
                                                </a><?php } ?>
                                                <?php if (array_key_exists("finance/voucherplotdetail/delete", $myrights)) {?>      <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/voucherplotdetail/delete&id=<?php echo $row->voucher_plot_detail_id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
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
                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

</form>


</div>
