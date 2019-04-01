<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\SeccontrollerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Controllers';


$colnameclass = "";
?>
<div class="seccontroller-index">

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "security", "title" => "Security"],
            ["link" => "", "title" => "Controllers"],
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
                            if (array_key_exists("security/seccontroller/create", $myrights)) {
                                ?>
                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/seccontroller/create" class="ajaxlink">Add</a>
                                <?php
                            }
                            ?>
                            <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/seccontroller/sidebarsummary">
                            <input type="hidden" id="tsort" name="tsort" value="">
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center" style="width:40px;">      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('module_title') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('controller_code') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('controller_name') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('sort_order') ?>      </th>
                                        <th style="width:40px;">      </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $rows = $dataProvider->getModels(); ?>
                                    <?php foreach ($rows as $row) { ?>
                                        <tr>
                                            <td class="center">      </td>
                                            <td align="right">
                                                <?= app\components\Detaillistaction::widget(["action" => "security/seccontroller/update", "id" => $row->controller_id, "text" => ($row->module == null ? "" : $row->module->module_title), "rights" => $myrights]) ?>
                                            </td>

                                            <td align="left"><?php echo $row->controller_code; ?>      </td>
                                            <td align="left"><?php echo $row->controller_name; ?>      </td>
                                            <td align="right"><?php echo $row->sort_order; ?>      </td>
                                            <td class="center">
                                                <?= app\components\Updatelistaction::widget(["action" => "security/seccontroller/update", "id" => $row->controller_id, "rights" => $myrights]) ?>
                                                <?= app\components\Deletelistaction::widget(["action" => "security/seccontroller/delete", "id" => $row->controller_id, "rights" => $myrights]) ?>
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
