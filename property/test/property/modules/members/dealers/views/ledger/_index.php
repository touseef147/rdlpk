<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\FmstransdetaildistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Commissions Summary';


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

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="widget-box ui-sortable-handle" id="widget-box-1">
                    <div class="widget-header widget-header-large">
                        <h4 class="widget-title"><?= Html::encode($this->title) ?></h4>

                        <div class="widget-toolbar">
                            <?php if (array_key_exists("members/dealers/ledger/create", $myrights)) {
                                ?>                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/ledger/create" class="ajaxlink">Add</a>
                            <?php }
                            ?>                                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/ledger/sidebarsummary">
                            <input type="hidden" id="tsort" name="tsort" value="">
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center" style="width:40px;">      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('serial_no') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('trans_type') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('trans_date') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('name') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('bank_title') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('bank_trans_no') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('cr_amount') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('remarks') ?>      </th>
                                        <th style="width:40px;">      </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $rows = $dataProvider->getModels(); ?>
                                    <?php foreach ($rows as $row) { ?>
                                        <tr>
                                            <td class="center">      </td>
                                            <td align="right">                            
                                                <?php 
                                                    echo $row->transaction->serial_no;
                                                ?>                                                                    
                                            </td>

                                            <td>                            
                                                <?php echo $row->transaction->transtypetitle; ?>
                                            </td>

                                            <td align="left"><?php echo $row->transaction->viewtransdate; ?>      </td>
                                            <td align="left"><?php echo $row->person->name; ?>      </td>
                                            <td align="left"><?php echo ($row->bank == null ? "" : $row->bank->bank_title); ?>      </td>
                                            <td align="left"><?php echo $row->bank_trans_no; ?>      </td>
                                            <td align="right"><?php echo $row->viewcramount; ?>      </td>
                                            <td align="left"><?php echo $row->transaction->remarks; ?>      </td>
                                            <td class="center">
                                                <?php if (array_key_exists("members/dealers/ledger/update", $myrights)) { ?>      <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/ledger/update&id=<?php echo $row->distribution_id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                <span class="blue">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </span>
                                                </a><?php } ?>
                                                <?php if (array_key_exists("members/dealers/ledger/delete", $myrights)) {?>      <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/ledger/delete&id=<?php echo $row->distribution_id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
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
