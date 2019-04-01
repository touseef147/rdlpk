<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\FmsvoucherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Instrument Deposit';

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

$tab1allowed = false;
$tab2allowed = false;
$tab3allowed = false;
$tab4allowed = false;

$multiplerights = false;

if (array_key_exists("finance/fmsdealervoucher/index", $myrights)) {
    $tab1allowed = true;
}

if (array_key_exists("finance/fmsdealervoucher/financeverification", $myrights)) {
    $tab3allowed = true;
}

if (array_key_exists("finance/fmsdealervoucher/financeapproval", $myrights)) {
    $tab4allowed = true;
}

if ($tab1allowed || $tab2allowed || $tab3allowed || $tab4allowed) {
    $multiplerights = true;
}
?>
<div class="fmsvoucher-index">

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
//            ["link" => "finance", "title" => "finance"],
            ["link" => "", "title" => "Deposit Instruments"],
        ],
    ])
    ?>

    <input type="hidden" id="tpageno" name="tpageno" value="<?= $dataProvider->pagination->page ?>">
    <input type="hidden" id="tpagesize" name="tpagesize" value="<?= $dataProvider->pagination->pageSize ?>">
    <div class="page-content">

        <?php
        if ($multiplerights == FALSE) {
            echo \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]);
        }
        ?>

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <?php if ($multiplerights) {
                    ?>                
                    <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTab">
                            <?php
                            if ($tab1allowed) {
                                ?>
                                <li>
                                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/index">
                                        <i class="green ace-icon fa fa-th bigger-120"></i>
                                        Instruments
                                    </a>
                                </li>
                                <?php
                            }
                            ?>

                            <li class="active">
                                <a data-toggle="tab" href="#tab2">
                                    <i class="green ace-icon fa fa-home bigger-120"></i>
                                    Deposit
                                    <span class="badge badge-danger">---</span>
                                </a>
                            </li>

                            <?php
                            if ($tab3allowed) {
                                ?>
                                <li>
                                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/financeverification">
                                        <i class="green ace-icon fa fa-th bigger-120"></i>
                                        Verify
                                        <span class="badge badge-danger">---</span>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>

                            <?php
                            if ($tab4allowed) {
                                ?>
                                <li>
                                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/financeapproval">
                                        <i class="green ace-icon fa fa-th bigger-120"></i>
                                        Approve
                                        <span class="badge badge-danger">---</span>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>

                        <div class="tab-content no-padding">
                            <div class="tab-pane fade in active">
                                <?php
                            }       //check multiple rights
                            ?>

                            <div class="widget-box ui-sortable-handle" id="widget-box-1">
                                <div class="widget-header widget-header-large">
                                    <h4 class="widget-title"><?= Html::encode($this->title) ?></h4>

                                    <div class="widget-toolbar">
                                        <?php if (array_key_exists("finance/fmsdealervoucher/create", $myrights)) {
                                            ?>                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/findmember" class="ajaxlink">Add</a>
                                        <?php }
                                        ?>                                        
                                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/sidebarcenterversearch">
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
                                                    <th style="width:40px;">Receipts      </th>
                                                    <th style="width:40px;">      </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $rows = $dataProvider->getModels(); ?>
                                                <?php foreach ($rows as $row) { ?>
                                                    <tr>
                                                        <td class="center">      </td>
                                                        <td align="left">                            
                                                            <?php
                                                            if ($row->entry_status == 2) {
                                                                //if (array_key_exists("finance/fmsdealervoucher/centerverification", $myrights)) {
                                                                    ?>                                                                
                                                                    <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/centerverdetail&amp;id=<?php echo $row->voucher_id; ?>" class="ajaxlink"><?php echo $row->showentrydate; ?></a>
                                                                    <?php
                                                                //} else {
                                                                  //  echo $row->showentrydate;
                                                                //}
                                                            } else {
                                                                echo $row->showentrydate;
                                                                ?>
<!--                                                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/view&id=<?php echo $row->voucher_id; ?>" class="ajaxlink"><?php echo $row->showentrydate; ?></a>-->
                                                                <?php
                                                            }
                                                            ?>                                                                    
                                                        </td>

                                                        <td align="left"><?php echo ($row->person == null ? "" : $row->person->name); ?>      </td>
                                                        <td align="left"><?php echo ($row->salescenter == null ? "" : $row->salescenter->name); ?>      </td>
                                                        <td align="left"><?php echo ($row->project == null ? "" : $row->project->code); ?>      </td>
                                                        <td align="left"><?php echo $row->amounttypetitle; ?>      </td>
                                                        <td align="right"><?php echo number_format($row->amount); ?>      </td>
                                                        <td align="left"><?php echo $row->entrystatustitle; ?>      </td>
                                                        <td align="right"><?php echo count($row->receipts); ?>      </td>
                                                        <td class="center">
                                                            <?php
                                                            if ($row->entry_status == 2) {
                                                                //if (array_key_exists("finance/fmsdealervoucher/centerverification", $myrights)) {
                                                                    ?>      
                                                                    <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/centerverdetail&id=<?php echo $row->voucher_id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                                        <span class="blue">
                                                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                        </span>
                                                                    </a>
                                                                <?php
                                                                //}
                                                            }
                                                            ?>
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

                            <?php
                            if ($multiplerights) {
                                ?>
                            </div>

                        </div><!-- /.col -->
                    </div><!-- /.tabable -->
                    <?php
                }
                ?>

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

</form>


</div>
