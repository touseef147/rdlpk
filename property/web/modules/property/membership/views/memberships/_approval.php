<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\FmsvoucherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Membership Approval';


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

$tab1allowed = FALSE;
$tab2allowed = FALSE;
$tab3allowed = true;

$multiplerights = FALSE;

if (array_key_exists("property/membership/memberships/index", $myrights)) {
    $tab1allowed = true;
}

if (array_key_exists("property/membership/memberships/financever", $myrights)) {
    $tab2allowed = true;
}

//if (array_key_exists("property/membership/memberships/approval", $myrights)) {
//    $tab3allowed = true;
//}

if ($tab1allowed || $tab2allowed || $tab3allowed) {
    $multiplerights = true;
}
?>
<div class="fmsvoucher-index">

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            //["link" => "finance", "title" => "property/memberships"],
            ["link" => "", "title" => "Approvals"],
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
                                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/index">
                                        <i class="green ace-icon fa fa-home bigger-120"></i>
                                        Memberships
                                    </a>
                                </li>
                                <?php
                            }
                            ?>

                            <?php
                            if ($tab2allowed) {
                                ?>
                                <li>
                                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/financever">
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
                            <li class="active">
                                <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/approval">
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
                                <div class="widget-header widget-header-large">
                                    <h4 class="widget-title"><?= Html::encode($this->title) ?></h4>

                                    <div class="widget-toolbar">
                                        <?php if (array_key_exists("finance/fmsvoucher/create", $myrights)) {
                                            ?>                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/findmember" class="ajaxlink">Add</a>
                                        <?php }
                                        ?>                                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/sidebarfinanceversearch">
                                        <input type="hidden" id="tsort" name="tsort" value="">
                                    </div>
                                </div>

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
                                                    <th style="width:40px;">      </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $rows = $dataProvider->getModels(); ?>
                                                <?php foreach ($rows as $row) { ?>
                                                    <tr>
                                                        <td class="center">      </td>
                                                        <td align="right">                            
                                                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/approvaldetail&id=<?php echo $row->ms_id; ?>" class="ajaxlink"><?php echo $row->plot->completecode; ?></a>
                                                        </td>

                                                        <td align="left"><?php echo $row->member->name; ?>      </td>
                                                        <td align="left"><?php echo $row->completecode; ?>      </td>
                                                        <td align="left"><?php echo $row->membershipstatustitle; ?>      </td>
                                                        <td align="left"><?php echo $row->isjointtitle; ?>      </td>
                                                        <td align="left"><?php echo $row->membershiptype; ?>      </td>
                                                        <td class="center">
                                                            <!--<?php if (array_key_exists("property/membership/memberships/update", $myrights)) { ?>      <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/update&id=<?php echo $row->ms_id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
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
                                                                <a aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                                    Details &nbsp;
                                                                    <i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-info">
                                                                    <li>
                                                                        <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/memberships/plotpaymentdetails&id=<?php echo $row->plot_id; ?>">Payment Details</a>
                                                                    </li>

                                                                    <?php
                                                                    if ($row->ms_status == 10 || $row->ms_status == 20) {
                                                                        ?>
                                                                        <li>
                                                                            <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/transfers/create&id=<?php echo $row->plot_id; ?>">Transfer</a>
                                                                        </li>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </ul>
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
