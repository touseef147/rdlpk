<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\MembersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Funds Transfer';


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
<div class="members-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "finance", "title" => "finance"],
            ["link" => "", "title" => "Transactions"],
        ],
    ])
    ?>

    <input type="hidden" id="tpageno" name="tpageno" value="<?= $dataProvider->pagination->page ?>">
    <input type="hidden" id="tpagesize" name="tpagesize" value="<?= $dataProvider->pagination->pageSize ?>">
    <div class="page-content">

        <?= ""//\app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
                        <li>
                            <a class="tab-pane-content" data-toggle="tab" href="#tab2" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/dealers/index">
                                <i class="green ace-icon fa fa-home bigger-120"></i>
                                Dealers
                            </a>
                        </li>

                        <li>
                            <a class="tab-pane-content" data-toggle="tab" href="#tab2" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/instruments/index">
                                <i class="green ace-icon fa fa-th bigger-120"></i>
                                Instruments
                            </a>
                        </li>

                        <li class="active">
                            <a class="tab-pane-content" data-toggle="tab" href="#tab1" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/index">
                                <i class="green ace-icon fa fa-th bigger-120"></i>
                                Funds Transfer
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content no-padding">
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="widget-box ui-sortable-handle" id="widget-box-1">
                                <div class="widget-header widget-header-medium">
                                    <h4 class="widget-title"><?= Html::encode($this->title) ?></h4>

                                    <div class="widget-toolbar no-border">
                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/findmember" class="btn btn-white btn-round btn-primary ajaxlink">
                                            &nbsp;<i class="ace-icon fa fa-plus"></i>&nbsp;Add&nbsp;
                                        </a>
                                        <a href="#" style="display:none;" class="btn btn-white btn-round btn-primary">
                                            &nbsp;<i class="ace-icon fa fa-print"></i>&nbsp;Print&nbsp;
                                        </a>
                                        <a href="#" style="display:none;" class="btn btn-white btn-round btn-primary">
                                            &nbsp;<i class="ace-icon fa fa-envelope"></i>&nbsp;PDF&nbsp;
                                        </a>
                                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/sidebarsummary">
                                        <input type="hidden" id="tsort" name="tsort" value="">
                                    </div>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main no-padding">
                                        <table id="simple-table" class="table  table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="center" style="width:40px;">      </th>
                                                    <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('entry_date') ?>      </th>
                                                    <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('member_id') ?>      </th>
                                                    <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('sales_center_id') ?>      </th>
                                                    <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('project_id') ?>      </th>
                                                    <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('amount_type') ?>      </th>
                                                    <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('amount') ?>      </th>
                                                    <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('entry_status') ?>      </th>
                                                    <th style="width:40px;">Slips      </th>
                                                    <th style="width:40px;">      </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $rows = $dataProvider->getModels(); ?>
                                                <?php foreach ($rows as $row) { ?>
                                                    <tr>
                                                        <td class="center">      </td>
                                                        <td align="left">                            
                                                                    <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/update&id=<?php echo $row->voucher_id; ?>" data-toggle="tooltip" title="Click to update record." class="ajaxlink"><?php echo $row->showentrydate; ?></a>
                                                            <?php
//                                                            if ($row->entry_status == 1) {
  //                                                              if (array_key_exists("finance/fmsvoucher/update", $myrights)) {
                                                                    ?>                                                                
<!--                                                                    <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/update&id=<?php echo $row->voucher_id; ?>" data-toggle="tooltip" title="Click to update record." class="ajaxlink"><?php echo $row->showentrydate; ?></a>-->
                                                                    <?php
    //                                                            } else {
      //                                                              echo $row->showentrydate;
        //                                                        }
          //                                                  } else {
            //                                                    if ($row->amount_type == 5) {
                                                                ?>
<!--                                                                <a data-toggle="tooltip" title="Click to update record." target="_blank" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/viewfundtransfer&id=<?php echo $row->voucher_id; ?>"><?php echo $row->showentrydate; ?></a>-->
                                                                <?php
              //                                                  } else {
                                                                ?>
<!--                                                                <a data-toggle="tooltip" title="Click to update record." target="_blank" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/view&id=<?php echo $row->voucher_id; ?>"><?php echo $row->showentrydate; ?></a>-->
                                                                <?php
                //                                                }
                  //                                          }
                                                            ?>                                                                    
                                                        </td>

                                                        <td align="left"><?php echo ($row->person == null ? "" : $row->person->dealers_business_title); ?>      </td>
                                                        <td align="left"><?php echo ($row->salescenter == null ? "" : $row->salescenter->name); ?>      </td>
                                                        <td align="left"><?php echo ($row->project == null ? "" : $row->project->code); ?>      </td>
                                                        <td align="left"><?php echo $row->amounttypetitle; ?>      </td>
                                                        <td align="right"><?php echo number_format($row->amount); ?>      </td>
                                                        <td align="left"><?php echo $row->entrystatustitle; ?>      </td>
                                                        <td align="right"><?php echo count($row->receipts); ?>      </td>
                                                        <td class="center">
                                                            <?php if (array_key_exists("finance/fmsvoucher/update", $myrights)) { ?>      <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/update&id=<?php echo $row->voucher_id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                                    <span class="blue">
                                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                    </span>
                                                                </a><?php } ?>
                                                            <?php if (array_key_exists("finance/fmsvoucher/delete", $myrights)) { ?>      <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/delete&id=<?php echo $row->voucher_id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
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

                        <div id="tab2" class="tab-pane fade in">
                        </div>
                    </div>
                </div>

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>



<?php $this->beginBlock('pagesidebar'); ?>
<?=
$this->render('_summarysearch', [
    'searchModel' => $searchModel,
    'myrights' => $myrights,
]);
?>
<?php $this->endBlock(); ?>        
