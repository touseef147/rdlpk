<div class="widget-box widget-color-blue  no-border" id="widget-box-1">
    <div class="widget-header widget-header-medium"  style="background-color: #f5f5f5;">
        <h4 class="widget-title" style="color: #006699;">Sales Center Report</h4>


        <div class="widget-toolbar">
            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/default/printsummary" class="reportlink orange2">
                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/print_printer.png">
            </a>
            &nbsp;|&nbsp;
            <div class="widget-menu">
                <a href="#" data-action="settings" data-toggle="dropdown">
                    <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/pdf.png">
                </a>

                <ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
                    <li>
                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/default/pdfsummary&pagesize=a4p">Portrait</a>
                    </li>

                    <li>
                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/default/pdfsummary&pagesize=a4l">Landscape</a>
                    </li>
                </ul>
            </div>
            &nbsp;|&nbsp;
            <div class="widget-menu">
                <a href="#" data-action="settings" data-toggle="dropdown">
                    <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/gnumeric.png">
                </a>

                <ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
                    <li>
                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/default/chart&charttype=bar">Bar Chart</a>
                    </li>

                    <li>
                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/default/chart&charttype=line">Line Chart</a>
                    </li>

                    <li>
                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/default/chart&charttype=pie">Pie Chart</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="widget-body">
        <div class="widget-main no-padding">
            <table id="simple-table" class="table  table-bordered table-hover table-report">
                <thead>
                    <tr>
                        <th colspan="2" class="center" style="width:40px;">Description      </th>
                        <th colspan="3" class="center">Totals      </th>
                    </tr>
                    <tr>
                        <th class="center" style="width:40px;">#</th>
                        <th>Sales Center<?php //echo $dataProvider->sort->link('profession_id')     ?>      </th>
                        <th style="width:40px;">Visits<?php //echo $dataProvider->sort->link('city')     ?>      </th>
                        <th style="width:40px;">Calls<?php //echo $dataProvider->sort->link('contactno')     ?>      </th>
                        <th style="width:40px;">Total<?php //echo $dataProvider->sort->link('email')     ?>      </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=0;
                    $totalvisits=0;
                    $totalcalls=0;
                    
                    foreach ($model as $row) { 
                        $count++;
                        
                        $totalvisits+= $row->no_of_visits;
                        $totalcalls+= $row->no_of_calls;
                        ?>
                        <tr>
                            <td class="center"><?php echo $count; ?></td>
                            <td align="left"><?php echo $row->center_name; ?></td>
                            <td align="right"><?php echo $row->no_of_visits; //echo ($row->visitorCity == null ? "" : $row->visitorCity->city);     ?>      </td>
                            <td align="right"><?php echo $row->no_of_calls; ?>      </td>
                            <td align="right"><?php echo $row->no_of_visits + $row->no_of_calls;     ?>      </td>
                        </tr>
                    <?php } ?>
                        <tr class="footer-row">
                            <td class="center"></td>
                            <td align="left">Total</td>
                            <td align="right"><?php echo $totalvisits; //echo ($row->visitorCity == null ? "" : $row->visitorCity->city);     ?>      </td>
                            <td align="right"><?php echo $totalcalls; ?>      </td>
                            <td align="right"><?php echo $totalvisits + $totalcalls;     ?>      </td>
                        </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>