<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';


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
<div class="categories-index">

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "property", "title" => "Property"],
            ["link" => "property/config", "title" => "Configuration"],
            ["link" => "", "title" => "Categories"],
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
                            <?php if (array_key_exists("property/config/categories/create", $myrights)) {
                                ?>                                 
                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/categories/create" class="ajaxlink">
                                    <label class="btn btn-sm btn-primary btn-white btn-round">
                                        <i class="ace-icon fa fa-plus bigger-110"></i> Add
                                    </label>
                                </a>
                                <?php
                            }
                            ?>      
                            <div class="btn btn-xs btn-primary btn-white btn-round dropdown">
                                <a aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="ace-icon fa fa-table"></i>
                                    Excel &nbsp;
                                    <i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-info">
                                    <li>
                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/categories/printsummary&allpages=no&resulttype=excel">Current Page</a>
                                    </li>

                                    <li>
                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/categories/printsummary&resulttype=excel">All Pages</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="btn btn-xs btn-primary btn-white btn-round dropdown">
                                <a aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="ace-icon fa fa-save"></i>
                                    Pdf &nbsp;
                                    <i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-info">
                                    <li>
                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/categories/pdfsummary&allpages=no&resulttype=excel">Current Page</a>
                                    </li>

                                    <li>
                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/categories/pdfsummary&resulttype=excel">All Pages</a>
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
                                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/categories/printsummary&allpages=no">Current Page</a>
                                    </li>

                                    <li>
                                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/categories/printsummary">All Pages</a>
                                    </li>
                                </ul>
                            </div>
                            <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/categories/sidebarsummary">
                            <input type="hidden" id="tsort" name="tsort" value="">
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center" style="width:40px;">      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('title') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('name') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('sign') ?>      </th>
                                        <th style="width:40px;">      </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $rows = $dataProvider->getModels(); ?>
                                    <?php foreach ($rows as $row) { ?>
                                        <tr>
                                            <td class="center">      </td>
                                            <td align="left">                                                                
                                                <?= app\components\Detaillistaction::widget(["action" => "property/config/categories/update", "id" => $row->id, "text" => $row->title, "rights" => $myrights]) ?>
                                            </td>

                                            <td align="left"><?php echo $row->name; ?>      </td>
                                            <td align="left">    <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/uploads/categories/<?php echo $row->sign."?".date('H-i-s'); ?>" height="100">     </td>
                                            <td class="center">
                                                <?php if (array_key_exists("property/config/categories/update", $myrights)) { ?>      
                                                    <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/categories/update&id=<?php echo $row->id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                        </span>
                                                    </a><?php } ?>
                                                <?php if (array_key_exists("property/config/categories/delete", $myrights)) { ?>      
                                                    <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/categories/delete&id=<?php echo $row->id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
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
