<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\FilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Files';


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
<div class="files-index">

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "property/config", "title" => "Property Configuration"],
            ["link" => "", "title" => "Files"],
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
                               <?php if (array_key_exists("property/config/files/create", $myrights)) {
                                ?> 
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/files/create" class="ajaxlink">Add</a>
                               <?php }?>
                            <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/files/sidebarsummary">
                            <input type="hidden" id="tsort" name="tsort" value="">
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="detail-col  <?php echo $colnameclass; ?>">Membership No.</th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('project_id') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('plot_detail_address') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('plot_size') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('size2') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('com_res') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('status') ?>      </th>

                                        <th style="width:40px;">      </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $rows = $dataProvider->getModels(); ?>
                                    <?php foreach ($rows as $row) { ?>
                                        <tr>
                                            <td align="left"><?php echo ($row->currentmembership == NULL ? "" : $row->currentmembership->completecode); ?></td>
                                                <td align="left"> 
                                                  <?= app\components\Detaillistaction::widget(["action" => "property/config/files/update", "id" => $row->id, "text" => ($row->project== NULL ? "" : $row->project->code), "rights" => $myrights]) ?>
                            
                                                       </td>

<!--                                           <td align="left"><?php // echo $row->memberplot->plotno; ?>      </td>-->
                                            <td align="left"><?php echo $row->completecode; ?>      </td>
                                            <td align="left"><?php echo $row->plot_size; ?>      </td>
                                            <td align="left"><?php echo $row->sizeCat->size; ?>      </td>
                                            <td align="left"><?php echo $row->com_res; ?>      </td>
                                            <td align="left"><?php echo ($row->currentmembership == NULL ? "" : $row->currentmembership->membershipstatustitle); ?>      </td>
                                             <td class="center">
                                                 <?php if (array_key_exists("property/config/files/update", $myrights)) { ?>      
                                                <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/files/update&id=<?php echo $row->id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                        </span>
                                                    </a><?php } ?>
                                                <?php if (array_key_exists("property/config/files/delete", $myrights)) { ?>
                                                <?php //if($row->currentmembership == ""){ echo $row->currentmembership; ?>      
                                                <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/files/delete&id=<?php echo $row->id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title=""><?php // }else { echo'';}?>
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



</div>
<!--<div id="googlechart" class="google_chart" 
     data-url="<?php //echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/files/charttest" 
     data-charttype="BARCHART" data-method="url" data-form="">
    
</div>

<div id="googlechartpie" class="google_chart" 
     data-url="<?php //echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/files/charttest" 
     data-charttype="PIECHART" data-method="url" data-form="">
    
</div>-->