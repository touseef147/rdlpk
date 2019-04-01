<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\PlotsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plots';


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
<div class="plots-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard">Home</a>
            </li>
            <li>
                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config" class="ajaxlink">Property Configuration</a>
            </li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ul><!-- /.breadcrumb -->
    </div>

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
                            <?php if (array_key_exists("property/config/plots/create", $myrights)) { ?> 

                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/plots/create" class="ajaxlink">
                                    <label class="btn btn-sm btn-primary btn-white btn-round">
                                        <i class="ace-icon fa fa-plus bigger-110"></i> Add
                                    </label>
                                </a>
                            <?php } ?>
                            <div class="btn btn-xs btn-primary btn-white btn-round dropdown">
                                <a aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="ace-icon fa fa-table"></i>
                                    Excel &nbsp;
                                    <i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-info">
                                    <li>
                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/plots/printsummary&allpages=no&resulttype=excel">Current Page</a>
                                    </li>

                                    <li>
                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/plots/printsummary&resulttype=excel">All Pages</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="btn btn-xs btn-primary btn-white btn-round dropdown">
                                <a aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="ace-icon fa fa-print"></i>
                                    Print &nbsp;
                                    <i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-info">
                                    <li>
                                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/plots/printsummary&allpages=no">Current Page</a>
                                    </li>

                                    <li>
                                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/plots/printsummary">All Pages</a>
                                    </li>
                                </ul>
                            </div>
                            <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/plots/sidebarsummary">
                            <input type="hidden" id="tsort" name="tsort" value="">
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center" style="width:40px;">      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('project_id') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('street_id') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('plot_detail_address') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('plot_size') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('size2') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('com_res') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('status') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo 'Action' ?>      </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $rows = $dataProvider->getModels(); ?>
                                    <?php foreach ($rows as $row) { ?>
                                        <tr>
                                            <td class="center">      </td>
                                            <td align="left"> 

                                                <?= app\components\Detaillistaction::widget(["action" => "property/config/plots/update", "id" => $row->id, "text" => $row->project->project_name, "rights" => $myrights]) ?>


                                            </td>

                                            <td align="left"><?php echo $row->street->street; ?>      </td>
                                            <td align="left"><?php echo $row->completecode; ?>      </td>
                                            <td align="left"><?php echo $row->plot_size; ?>      </td>
                                            <td align="left"><?php echo $row->sizeCat->size; ?>      </td>
                                            <td align="left"><?php echo $row->com_res; ?>      </td>
                                            <td align="left"><?php
                                                if ($row->status == "Alotted")
                                                    echo "Allotted";
                                                else
                                                    echo"<a href=" . Yii::$app->urlManager->baseUrl . "/index.php?r=property/config/plots/allot&id=$row->id>Allot</a>";
                                                ?>      </td>
                                            <td align="left"> <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                                                        <span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#">Reallocate</a></li>
                                                        <li><a href="#">Upload Docs</a></li>
                                                        <li>  
                                                            <?php if (array_key_exists("property/config/plots/update", $myrights)) { ?>      
                                                                <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/plots/update&id=<?php echo $row->id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                                    <span class="blue">
                                                                        Edit &nbsp;   <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                    </span>
                                                                </a><?php } ?>  


                                                            </a></li>
                                                        <li>
                                                            <?php if (array_key_exists("property/config/plots/delete", $myrights)) { ?>      
                                                                <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/plots/delete&id=<?php echo $row->id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
                                                                    <span class="red">
                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                    </span>
                                                                </a><?php } ?>
                                                            <span class="red">
                                                                Delete&nbsp;      <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                            </span>
                                                            </a></li>
                                                    </ul>
                                                </div></td>
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
