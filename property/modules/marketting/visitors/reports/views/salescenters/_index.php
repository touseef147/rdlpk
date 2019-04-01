<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\DailyvisitorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Salescenters Report';


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
<div class="dailyvisitors-index">

    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "marketting", "title" => "Marketting"],
            ["link" => "marketting/visitors", "title" => "Visitors"],
            ["link" => "", "title" => "Sales Center Report"],
        ],
    ])
    ?>

    <input type="hidden" id="tpageno" name="tpageno" value="1">
    <input type="hidden" id="tpagesize" name="tpagesize" value="100000">
    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="widget-box ui-sortable-handle" id="widget-box-1">
                    <div class="widget-header widget-header-large">
                        <h4 class="widget-title"><?= Html::encode($this->title) ?></h4>

                        <div class="widget-toolbar">
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/users/printsummary" class="reportlink orange2">
                                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/print_printer.png">
                            </a>
                            &nbsp;|&nbsp;
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/users/pdfsummary" class="reportlink orange2">
                                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/pdf.png">
                            </a>
                            &nbsp;|&nbsp;
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/users/chart" class="reportlink orange2">
                                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/gnumeric.png">
                            </a>
                            <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/reports/sidebarsummary">
                            <input type="hidden" id="tsort" name="tsort" value="">
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="simple-table" class="table  table-bordered table-hover table-report">
                                <thead>
                                    <tr>
                                        <th class="center" style="width:20px;">#</th>
                                        <th class="detail-col  <?php echo $colnameclass; ?>">Sales Center<?php //echo $dataProvider->sort->link('profession_id')    ?>      </th>
                                       

                                        <th  style="width:40px;" class="detail-col  <?php echo $colnameclass; ?>">No of Visits<?php //echo $dataProvider->sort->link('city')    ?>      </th>
                                        <th style="width:40px;" class="detail-col  <?php echo $colnameclass; ?>">No of Calls<?php //echo $dataProvider->sort->link('contactno')    ?>      </th>
                                        <th style="width:40px;" class="detail-col  <?php echo $colnameclass; ?>">No of Interests<?php //echo $dataProvider->sort->link('contactno')    ?>      </th>

                                        <th style="width:40px;" class="detail-col  <?php echo $colnameclass; ?>">No of Bookings<?php //echo $dataProvider->sort->link('contactno')    ?>      </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //$rows = $dataProvider->getModels();  ?>
                                    <?php
                                    $recs = 0;
                                    $noofvisits = 0;
                                    $noofcalls = 0;
                                    $noofinterests = 0;
                                    $noofbookings = 0;
                                    foreach ($model as $row) {

                                        $recs++;
                                        $noofvisits+=$row->no_of_visits;
                                        $noofcalls+=$row->no_of_calls;
                                        $noofinterests+=$row->no_of_interests;
                                        $noofbookings+=$row->no_of_bookings;
                                        ?>
                                        <tr>
                                            <td class="center"><?php echo $recs; ?></td>

                                            <td><a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/users&UsersSearch[center]=<?php echo $row->userid; ?>" class="ajaxlink"><?php echo $row->center_name; ?></a>      </td>
                                         


                                            <td align="right"><?php echo $row->no_of_visits; //echo ($row->visitorCity == null ? "" : $row->visitorCity->city);    ?>      </td>
                                            <td align="right"><?php echo $row->no_of_calls; ?>      </td>
                                            <td align="right"><?php echo $row->no_of_interests; ?>      </td>
                                            <td align="right"><?php echo $row->no_of_bookings; ?>      </td>
                                             </tr>
<?php } ?>
                                    <tr class="widget-toolbox">
                                        <td class="center">      </td>
                                        <td align="left"><strong>TOTAL</strong></td>
                                       
                                       
                                        <td align="right"><?php echo $noofvisits; ?></td>
                                        <td align="right"><?php echo $noofcalls; ?></td>
                                        <td align="right"><?php echo $noofinterests; ?></td>
                                        <td align="right"><?php echo $noofbookings; ?></td>
                                        </td>
                                    </tr>
                                </tbody>
                                  </table>

                        </div>
                    </div>
                </div>
                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

</form>


</div>
