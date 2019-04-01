<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\FmstransdetaildistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Instruments Summary';


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
<div class="fmstransdetaildist-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "members/dealers/default/index", "title" => "Dealers Control Panel"],
            ["link" => "", "title" => Html::encode($this->title)],
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
                            <a  class="tab-pane-content" data-toggle="tab" href="#home" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/dealers/index">
                                <i class="green ace-icon fa fa-home bigger-120"></i>
                                Dealers
                            </a>
                        </li>

                        <li class="active">
                            <a data-toggle="tab" href="#messages">
                                <i class="green ace-icon fa fa-th bigger-120"></i>
                                Instruments
                            </a>
                        </li>

                        <li>
                            <a class="tab-pane-content" data-toggle="tab" href="#tab1" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/index">
                                <i class="green ace-icon fa fa-th bigger-120"></i>
                                Funds Transfer
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content no-padding">
                        <div id="tab1" class="tab-pane fade in">
                        </div>

                        <div id="tab2" class="tab-pane fade in active">
                            <div class="widget-box ui-sortable-handle" id="widget-box-1">
                                <div class="widget-header widget-header-medium">
                                    <h4 class="widget-title"><?= Html::encode($this->title) ?></h4>

                                    <div class="widget-toolbar no-border">
                                        <?php if (array_key_exists("members/dealers/instruments/create", $myrights)) { ?>
                                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/instruments/create" class="btn btn-white btn-round btn-primary ajaxlink">
                                                &nbsp;<i class="ace-icon fa fa-plus"></i>&nbsp;Add&nbsp;
                                            </a>
                                        <?php } ?>
                                        <a href="#" style="display:none;" class="btn btn-white btn-round btn-primary">
                                            &nbsp;<i class="ace-icon fa fa-print"></i>&nbsp;Print&nbsp;
                                        </a>
                                        <a href="#" style="display:none;" class="btn btn-white btn-round btn-primary">
                                            &nbsp;<i class="ace-icon fa fa-envelope"></i>&nbsp;PDF&nbsp;
                                        </a>
                                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/instruments/sidebarsummary">
                                        <input type="hidden" id="tsort" name="tsort" value="">
                                    </div>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main no-padding">
                                        <table id="simple-table" class="table  table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="width:90px;"><?php echo $dataProvider->sort->link('trans_type') ?>      </th>
                                                    <th style="width:85px;"><?php echo $dataProvider->sort->link('trans_date') ?>      </th>
                                                    <th><?php echo $dataProvider->sort->link('name') ?>      </th>
                                                    <th><?php echo $dataProvider->sort->link('bank_title') ?>      </th>
                                                    <th style="width:90px;"><?php echo $dataProvider->sort->link('bank_trans_no') ?>      </th>
                                                    <th style="width:70px;"><?php echo $dataProvider->sort->link('cr_amount') ?>      </th>
                                                    <th><?php echo $dataProvider->sort->link('remarks') ?>      </th>
                                                    <th><?php echo $dataProvider->sort->link('status') ?>      </th>
                                                    <th class="center" colspan="2">Actions      </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $rows = $dataProvider->getModels(); ?>
                                                <?php foreach ($rows as $row) { ?>
                                                    <tr>
                                                        <td>                            
                                                            <?php if (array_key_exists("members/dealers/instruments/update", $myrights)) { ?> 
                                                                <a data-toggle="tooltip" title="Click to update record." href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/instruments/update&id=<?php echo $row->distribution_id; ?>" class="ajaxlink"><?php echo $row->transaction->transtypetitle; ?></a>
                                                                <?php
                                                            } else {
                                                                echo $row->transaction->transtypetitle;
                                                            }
                                                            ?>                                                                    
                                                        </td>

                                                        <td align="left"><?php echo $row->transaction->viewtransdate; ?>      </td>
                                                        <td align="left"><?php echo ($row->person == null ? "" : $row->person->dealers_business_title); ?>      </td>
                                                        <td align="left"><?php echo ($row->bank == null ? "" : $row->bank->bank_title); ?>      </td>
                                                        <td align="left"><?php echo $row->bank_trans_no; ?>      </td>
                                                        <td align="right"><?php echo $row->viewcramount; ?>      </td>
                                                        <td align="left"><?php echo $row->transaction->remarks; ?>      </td>
                                                        <td align="left"><?php echo $row->transaction->statustitle; ?>      </td>
                                                        <td class="center" style="width:70px;">      
                                                            <div class="dropdown">
                                                                <a aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                                    Details &nbsp;
                                                                    <i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-info">
                                                                    <?php if (array_key_exists("members/dealers/instruments/update", $myrights)) { ?>      
                                                                    <li>
                                                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/instruments/deposit&id=<?php echo $row->distribution_id; ?>" class="tooltip-error ajaxlink" data-toggle="tooltip" title="Click to update Bank details.">Submit</a>
                                                                    </li>
                                                                    <?php } ?>
                                                                    <?php if (array_key_exists("members/dealers/instruments/verify", $myrights)) { 
                                                                        
                                                                        if($row->transaction->status == 2){
                                                                        ?>      
                                                                    <li>
                                                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/instruments/verify&id=<?php echo $row->distribution_id; ?>" class="tooltip-error ajaxlink" data-toggle="tooltip" title="Click to Submit record for verification.">Verify</a>
                                                                    </li>
                                                                        <?php }  } ?>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td class="center" style="width:40px;">
                                                            <?php if (array_key_exists("members/dealers/instruments/update", $myrights)) { ?>      
                                                                <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/instruments/update&id=<?php echo $row->distribution_id; ?>" class="tooltip-error ajaxlink" data-toggle="tooltip" title="Click to update record.">
                                                                    <span class="blue">
                                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                    </span>
                                                                </a>
                                                            <?php } ?>
                                                            <?php if (array_key_exists("members/dealers/instruments/delete", $myrights)) { ?>      <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/instruments/delete&id=<?php echo $row->distribution_id; ?>" class="tooltip-error deletelink" data-toggle="tooltip" title="Click to delete record.">
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
                    </div>
                </div>                

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

</div>
