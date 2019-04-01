<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\MemberplotSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Memberplots';


$colnameclass="";

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
<div class="memberplot-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                    <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard">Home</a>
                    </li>
                    <li>
                                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=propertyconfig" class="ajaxlink">Propertyconfig</a>
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
                                                                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=propertyconfig/memberplot/create" class="ajaxlink">Add</a>
                                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=propertyconfig/memberplot/sidebarsummary">
                                        <input type="hidden" id="tsort" name="tsort" value="">
                                    </div>
                            </div>

                            <div class="widget-body">
                                    <div class="widget-main no-padding">
                                            <table id="simple-table" class="table  table-bordered table-hover">
  <thead>
      <tr>
      <th class="center" style="width:40px;">      </th>
      <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('plot_id') ?>      </th>
      <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('member_id') ?>      </th>
      <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('create_date') ?>      </th>
      <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('modify_date') ?>      </th>
      <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('noi') ?>      </th>
      <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('insplan') ?>      </th>
      <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('status') ?>      </th>
      <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('fstatus') ?>      </th>
      <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('user_name') ?>      </th>
      <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('plotno') ?>      </th>
      <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('comment') ?>      </th>
      <th class="detail-col  <?php echo $colnameclass; ?>"><?php echo $dataProvider->sort->link('fcomment') ?>      </th>
      <th style="width:40px;">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="center">      </td>
      <td align="right"><a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=propertyconfig/memberplot/update&id=<?php echo $row->id; ?>" class="ajaxlink"><?php echo $row->plot_id; ?></a></td>

                                                                  <td align="right"><?php echo $row->member_id; ?>      </td>
      <td align="left"><?php echo $row->create_date; ?>      </td>
      <td align="left"><?php echo $row->modify_date; ?>      </td>
      <td align="left"><?php echo $row->noi; ?>      </td>
      <td align="right"><?php echo $row->insplan; ?>      </td>
      <td align="left"><?php echo $row->status; ?>      </td>
      <td align="left"><?php echo $row->fstatus; ?>      </td>
      <td align="left"><?php echo $row->user_name; ?>      </td>
      <td align="left"><?php echo $row->plotno; ?>      </td>
      <td align="left"><?php echo $row->comment; ?>      </td>
      <td align="left"><?php echo $row->fcomment; ?>      </td>
      <td class="center">
      <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=propertyconfig/memberplot/update&id=<?php echo $row->id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
              <span class="blue">
                      <i class="ace-icon fa fa-pencil bigger-120"></i>
              </span>
      </a>
      <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=propertyconfig/memberplot/delete&id=<?php echo $row->id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
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
