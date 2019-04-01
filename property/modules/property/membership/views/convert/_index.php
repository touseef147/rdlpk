<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\PropertymembershipsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Convert File';


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
$tab1allowed = true;
$tab2allowed = FALSE;
$tab3allowed = FALSE;

$transferallowed = FALSE;
$updateallowed = FALSE;
$cancelallowed = FALSE;

$multiplerights = FALSE;

if (array_key_exists("property/membership/convert/update", $myrights)) {
    $updateallowed = true;
}

if (array_key_exists("property/membership/convert/financever", $myrights)) {
    $tab2allowed = true;
}

if (array_key_exists("property/membership/convert/approval", $myrights)) {
    $tab3allowed = true;
}

if ($tab1allowed || $tab2allowed || $tab3allowed) {
    $multiplerights = true;
}


//if (array_key_exists("property/membership/transfers/create", $myrights)) {
//    $transferallowed = true;
//}
//
//if (array_key_exists("property/membership/memberships/update", $myrights)) {
//    $updateallowed = true;
//}
//
//if (array_key_exists("property/membership/memberships/update", $myrights)) {
//    $cancelallowed = true;
//}
?>
<div class="propertymemberships-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            //["link" => "property/membership/index", "title" => "Memberships"],
            ["link" => "", "title" => Html::encode($this->title)],
        ],
    ])
    ?>

    <input type="hidden" id="tpageno" name="tpageno" value="<?= $dataProvider->pagination->page ?>">
    <input type="hidden" id="tpagesize" name="tpagesize" value="<?= $dataProvider->pagination->pageSize ?>">
    <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/convert/sidebarsummary">
    <input type="hidden" id="tsort" name="tsort" value="">
    <div class="page-content">

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
                                <li class="active">
                                    <a>
                                        <i class="green ace-icon fa fa-home bigger-120"></i>
                                        Convert Files
                                    </a>
                                </li>
                                <?php
                            }
                            ?>

                            <?php
                            if ($tab2allowed) {
                                ?>
                                <li>
                                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/convert/financever">
                                        <i class="green ace-icon fa fa-th bigger-120"></i>
                                        Finance Verification
                                        <span class="badge badge-danger">---</span>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>

                            <?php
                            if ($tab3allowed) {
                                ?>
                                <li>
                                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/convert/approval">
                                        <i class="green ace-icon fa fa-th bigger-120"></i>
                                        Approval
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
                                <!--                    <div class="widget-header widget-header-large">
                                                        <h4 class="widget-title"><?= Html::encode($this->title) ?></h4>
                                
                                                        <div class="widget-toolbar">
                                <?php if (array_key_exists("property/membership/memberships/create", $myrights)) {
                                    ?>                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/create" class="ajaxlink">Add</a>
                                <?php }
                                ?>                                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/sidebarsummary">
                                                            <input type="hidden" id="tsort" name="tsort" value="">
                                                        </div>
                                                    </div>-->

                                <div class="widget-body">
                                    <div class="widget-main no-padding">
                                        <table id="simple-table" class="table  table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="width:120px;"><?php echo "Application No."; ?>      </th>
                                                    <th style="width:70px;"><?php echo $dataProvider->sort->link('ms_no') ?>      </th>
                                                    <th style="width:150px;"><?php echo $dataProvider->sort->link('plot_id') ?>      </th>
                                                    <th><?php echo $dataProvider->sort->link('member_id') ?>      </th>
                                                    <th style="width:80px;">Status      </th>
                                                    <th style="width:70px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $rows = $dataProvider->getModels(); ?>
                                                <?php foreach ($rows as $row) { ?>
                                                    <tr>
                                                        <td align="left">
                                                            <?php if ($updateallowed) { ?>
                                                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/convert/update&id=<?php echo $row->ms_id; ?>" data-toggle="tooltip" title="Click to update record." class="ajaxlink"><?php echo $row->currentmembership->application->application_no; ?></a>
                                                                <?php
                                                            } else {
                                                                echo $row->currentmembership->application->application_no;
                                                            }
                                                            ?>                                                                    

                                                        </td>
                                                        <td align="left"><?php echo $row->completecode; ?>      </td>
                                                        <td>                            
                                                            <?php if ($updateallowed) { ?>
                                                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/convert/update&id=<?php echo $row->ms_id; ?>" data-toggle="tooltip" title="Click to update record." class="ajaxlink"><?php echo $row->plot->completecode; ?></a>
                                                                <?php
                                                            } else {
                                                                echo $row->plot->completecode;
                                                            }
                                                            ?>                                                                    
                                                        </td>

                                                        <td align="left"><?php echo $row->member->name; ?>      </td>
                                                        <td align="left"><?php echo $row->plot->activationstatustitle; ?>      </td>
                                                        <td class="center">
                                                            <!--<?php if ($updateallowed) { ?>      <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/update&id=<?php echo $row->ms_id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                                                            <span class="blue">
                                                                                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                                            </span>
                                                                                        </a><?php } ?>
                                                            <?php if (array_key_exists("property/membership/memberships/delete", $myrights)) { ?>      <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/delete&id=<?php echo $row->ms_id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
                                                                                            <span class="red">
                                                                                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                            </span>
                                                                                        </a><?php } ?>-->
                                                            <div class="dropdown">
<!--                                                                <a aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                                    Details &nbsp;
                                                                    <i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-info">
                                                                    <li>
                                                                        <a class="ajaxlink" data-toggle="tooltip" title="Click for payment detail." href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/plotpaymentdetails&id=<?php echo $row->plot_id; ?>&parentpage=property/membership/memberships/index">Payment Details</a>
                                                                    </li>

                                                                    <?php
//                                                                    if ($transferallowed) {
//                                                                        if ($row->ms_status == 10 || $row->ms_status == 20) {
//                                                                            ?>
                                                                            <li>
                                                                                <a class="ajaxlink" href="//<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/transfers/create&id=<?php echo $row->plot_id; ?>">Transfer</a>
                                                                            </li>
                                                                            <?php
//                                                                        }
//                                                                    }
                                                                    ?>

                                                                    <?php
//                                                                    if ($cancelallowed) {
                                                                        //if ($row->ms_status == 10 || $row->ms_status == 20) {
                                                                        ?>
                                                                        <li>
                                                                            <a class="ajaxlink" data-toggle="tooltip" title="Click Cancel file."  href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/convert/createrequest&id=<?php echo $row->ms_id; ?>">Cancel Membership</a>
                                                                        </li>
                                                                        <?php
                                                                        //}
//                                                                    }
                                                                    ?>
                                                                </ul>-->
                                                            </div>
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
                            </div>  <!-- Tab pane -->


                        </div><!-- /.tab content -->
                    </div><!-- /.tabable -->
                    <?php
                }
                ?>
            </div><!-- col-xs-12 -->




        </div> <!-- row -->
    </div> <!-- page content -->
</div> <!-- propertymemberships-index -->
