<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';


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
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard">Home</a>
            </li>
            <li>
                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security" class="ajaxlink">Security</a>
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
                            <?php
                            if (array_key_exists("security/user/create", $myrights)) {
                                ?>
                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/user/create" class="ajaxlink">Add</a>
                                <?php
                            }
                            ?>
                            <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/user/sidebarsummary">
                            <input type="hidden" id="tsort" name="tsort" value="">
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center" style="width:40px;">      </th>
                                        <th style="width:40px;"><?php echo $dataProvider->sort->link('pic') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('person_name') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('sodowo') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('username') ?>      </th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('status') ?>      </th>

                                        <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('create_date') ?>      </th>
                                        <th style="width:40px;">Account      </th>
                                        <th style="width:40px;">      </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $rows = $dataProvider->getModels(); ?>
                                    <?php foreach ($rows as $row) { ?>
                                        <tr>
                                            <td class="center">      </td>
                                            <td align="left"><?php echo Html::img('uploads/users/' . $row->pic, ['height' => '100']); ?>     </td>
                                            <td align="left">  
                                                <?php
                                                if (array_key_exists("security/user/update", $myrights)) {
                                                    ?>
                                                    <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/user/update&id=<?php echo $row->id; ?>" class="ajaxlink"><?php echo $row->person_name; ?></a>
                                                    <?php
                                                }
                                                else
                                                    echo $row->person_name;
                                                ?>
                                            </td>

                                            <td align="left"><?php echo $row->sodowo; ?>      </td>
                                            <td align="left"><?php echo $row->username; ?>      </td>
                                            <td align="left"><?php if ($row->status == 0 or $row->status == '') {
                                                echo 'Inactive';
                                            } else {
                                                echo 'Active';
                                            } ?>      </td>

                                            <td align="left"><?php echo $row->create_date; ?>      </td>
                                            <td align="left">
    <?php
    if (array_key_exists("security/user/account", $myrights)) {
        ?>
                                                    <a data-original-title="Edit Account" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/user/account&id=<?php echo $row->id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                        Manage
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td class="center">
    <?php
    if (array_key_exists("security/user/update", $myrights)) {
        ?>
                                                    <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/user/update&id=<?php echo $row->id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                        </span>
                                                    </a>
                                                    <?php
                                                }
                                                ?>
    <?php
    if (array_key_exists("security/user/delete", $myrights)) {
        ?>
                                                    <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/user/delete&id=<?php echo $row->id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
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
