<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\SecmoduleactionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Module Actions';


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
<div class="secmoduleactions-index">

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "security", "title" => "Security"],
            ["link" => "", "title" => "Screens"],
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
                            <?php
                            if (array_key_exists("security/secmoduleactions/create", $myrights)) {
                                ?>
                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secmoduleactions/create" class="ajaxlink">Add</a>
                                <?php
                            }
                            ?>
                            <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secmoduleactions/sidebarsummary">
                            <input type="hidden" id="tsort" name="tsort" value="">
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center" style="width:40px;">      </th>
                                        <th class="  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('module_title') ?>      </th>
                                        <th class="  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('controller_name') ?>      </th>
                                        <th class="  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('action_code') ?>      </th>
                                        <th class="  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('action_title') ?>      </th>
                                        <th class="  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('view_name') ?>      </th>
                                        <th style="width:90px;" class="  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('action_so') ?>      </th>
                                        <th style="width:40px;" class="  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('for_admin') ?>      </th>
                                        <th style="width:50px;">      </th>
                                    </tr>
                                </thead>
                                <tbody>
<?php $rows = $dataProvider->getModels(); ?>
                                    <?php foreach ($rows as $row) { ?>
                                        <tr>
                                            <td class="center">      </td>
                                            <td align="left"><?php echo ($row->controller == null || $row->controller->module == null ? "" : $row->controller->module->module_title); ?>      </td>
                                            <td>
    <?php
    if (array_key_exists("security/secmoduleactions/update", $myrights)) {
        ?>
                                                    <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secmoduleactions/update&id=<?php echo $row->action_id; ?>" class="ajaxlink"><?php if ($row->controller == null) echo "";
                                            else echo ($row->controller->controller_id == 0 ? "" : $row->controller->controller_name); ?></a>
                                                    <?php
                                                }
                                                else {
                                                    if ($row->controller == null)
                                                        echo "";
                                                    else
                                                        echo ($row->controller->controller_id == 0 ? "" : $row->controller->controller_name);
                                                }
                                                ?>
                                            </td>
                                            <td align="left"><?php echo ($row->controller == null || $row->controller->module == NULL ? "" : $row->action_code); ?>      </td>
                                            <td align="left"><?php echo $row->action_title; ?>      </td>
                                            <td align="left"><?php echo $row->view_name; ?>      </td>
                                            <td align="right"><?php echo $row->action_so; ?>      </td>
                                            <td align="center"><?php if($row->for_admin==0) { echo "&nbsp;"; } else { ?><img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/tick.png" width="22"> <?php } ?>      </td>
                                            <td class="center">
                                                <?php
                                                if (array_key_exists("security/secmoduleactions/update", $myrights)) {
                                                    ?>
                                                    <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secmoduleactions/update&id=<?php echo $row->action_id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                        </span>
                                                    </a>
                                                    <?php
                                                }

                                                if (array_key_exists("security/secmoduleactions/delete", $myrights)) {
                                                    ?>
                                                    <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secmoduleactions/delete&id=<?php echo $row->action_id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
                                                        <?php
                                                    }
                                                    ?>
                                                    <span class="red">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                    </span>
                                                </a>
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
