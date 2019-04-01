<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\InstallmentplanmasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Installment Plans';


$colnameclass = "";
?>
<div class="installmentplanmaster-index">

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "finance", "title" => "Finance"],
            ["link" => "", "title" => "Installment Plans"],
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
                            <?php if (array_key_exists("finance/installmentplanmaster/create", $myrights)) {
                                ?>                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installmentplanmaster/create" class="ajaxlink">Add</a>
                            <?php }
                            ?>                                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installmentplanmaster/sidebarsummary">
                            <input type="hidden" id="tsort" name="tsort" value="">
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center" style="width:40px;">#</th>
                                        <th><?php echo $dataProvider->sort->link('project_id') ?>      </th>
                                        <th><?php echo $dataProvider->sort->link('category_id') ?>      </th>
                                        <th><?php echo $dataProvider->sort->link('plan_land_type') ?>      </th>
                                        <th><?php echo $dataProvider->sort->link('plan_development_type') ?>      </th>
                                        <th><?php echo $dataProvider->sort->link('description') ?>      </th>
                                        <th><?php echo $dataProvider->sort->link('total_amount') ?>      </th>
                                        <th><?php echo $dataProvider->sort->link('no_of_installments') ?>      </th>
                                        <th style="width:40px;">      </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $rows = $dataProvider->getModels();
                                    $count = 0;
                                    ?>
                                    <?php
                                    foreach ($rows as $row) {
                                        $count++;
                                        ?>
                                        <tr>
                                            <td class="center"><?php echo $count; ?></td>
                                            <td><?= app\components\Detaillistaction::widget(["action" => "finance/installmentplanmaster/update", "id" => $row->plan_id, "text" => ($row->project == null ? "" : $row->project->project_name), "rights" => $myrights]) ?></td>

                                            <td><?php echo $row->category->size; ?>      </td>
                                            <td>
                                                <?php
                                                if ($row->plan_land_type == 1)
                                                    echo "Residential";
                                                elseif ($row->plan_land_type == 2)
                                                    echo "Commercial";
                                                else
                                                    echo "";
                                                ?>
                                            </td>
                                            <td><?php
                                                if ($row->plan_development_type == 1)
                                                    echo "Land";
                                                elseif ($row->plan_development_type == 2)
                                                    echo "Development";
                                                else
                                                    echo "Common";
                                                ?>      </td>
                                            <td><?php echo $row->description; ?>      </td>
                                            <td align="right"><?php echo number_format($row->total_amount); ?>      </td>
                                            <td align="right"><?php echo $row->no_of_installments; ?>      </td>
                                            <td class="center">
                                                <?php if (array_key_exists("finance/installmentplanmaster/update", $myrights)) { ?>      <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installmentplanmaster/update&id=<?php echo $row->plan_id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                        </span>
                                                    </a><?php } ?>
                                                <?php if (array_key_exists("finance/installmentplanmaster/delete", $myrights)) { ?>      <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installmentplanmaster/delete&id=<?php echo $row->plan_id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
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
