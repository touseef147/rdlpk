<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\SecrolesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles';


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
$recs = $dataProvider->getModels();
print_r($recs);
die();
?>
<div class="secroles-index">

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "security", "title" => "Security"],
            ["link" => "", "title" => "Roles"],
        ],
    ])
    ?>

    <input type="hidden" id="tpageno" name="tpageno" value="0">
    <input type="hidden" id="tpagesize" name="tpagesize" value="1000">
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
                            if (array_key_exists("security/secroles/create", $myrights)) {
                                ?>
                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secroles/create" class="ajaxlink">Add</a>
                                <?php
                            }
                            ?>
                            <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secroles/sidebarsummary">
                            <input type="hidden" id="tsort" name="tsort" value="">
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center" style="width:40px;">      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>">Role Type      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>">Role Category</th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>">Role</th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>">Sort Order</th>
                                        <th style="width:40px;">      </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
//                                    for($i=0; $i<count($dataProvider); $i++)
//                                    {
//                                    echo $i;
//                                    }
                                    //die();
                                    //$rows = $dataProvider->getModels(); ?>
                                    <?php foreach ((array)$dataProvider as $rowd) { //print_r($row); ?>
                                        <tr>
                                            <td class="center">      </td>
                                            <td align="left">
                                                <?php
                                                if (array_key_exists("security/secroles/update", $myrights)) {
                                                    ?>
                                                    <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secroles/update&id=<?php echo $row->role_id; ?>" class="ajaxlink"><?php echo $row->roleType->role_type_name; ?></a>
                                                    <?php
                                                }
                                                else
                                                    echo $row->roleType->role_type_name;
                                                ?>
                                            </td>
                                            <td align="left"><?php echo $row->roleCategory->role_category_name; ?></td>
                                            <td align="left"><?php echo $row->role_name; ?>      </td>
                                            <td align="right"><?php echo $row->role_so; ?>      </td>
                                            <td class="center">
                                                <?php
                                                if (array_key_exists("security/secroles/update", $myrights)) {
                                                    ?>
                                                    <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secroles/update&id=<?php echo $row->role_id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                        </span>
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                if (array_key_exists("security/secroles/delete", $myrights)) {
                                                    ?>
                                                    <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secroles/delete&id=<?php echo $row->role_id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
                                                        <span class="red">
                                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="widget-toolbox padding-8 clearfix">
                            <?= ""//LinkPager::widget(['pagination' => $dataProvider->pagination]) ?>
                        </div>        
                    </div>
                </div>
                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

</form>


</div>
