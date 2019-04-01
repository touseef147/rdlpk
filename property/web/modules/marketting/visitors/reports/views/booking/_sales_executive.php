<div class="widget-box widget-color-blue  no-border" id="widget-box-1">
    <div class="widget-header widget-header-medium"  style="background-color: #f5f5f5;">
        <h4 class="widget-title" style="color: #006699;">Sales Executive Report</h4>


        <div class="widget-toolbar">
            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/booking/printsummary" class="reportlink orange2">
                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/print_printer.png">
            </a>
            &nbsp;|&nbsp;
            <div class="widget-menu">
                <a href="#" data-action="settings" data-toggle="dropdown">
                    <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/pdf.png">
                </a>

                <ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
                    <li>
                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/booking/pdfsummary&pagesize=a4p">Portrait</a>
                    </li>

                    <li>
                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/booking/pdfsummary&pagesize=a4l">Landscape</a>
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
                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/booking/chart&charttype=bar">Bar Chart</a>
                    </li>

                    <li>
                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/booking/chart&charttype=line">Line Chart</a>
                    </li>

                    <li>
                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/booking/chart&charttype=pie">Pie Chart</a>
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
                        <th colspan="3" class="center" style="width:40px;">Description      </th>
                        <th colspan="<?php echo 3+ count($modelColumns); ?>" class="center">Totals      </th>
                    </tr>
                    <tr>
                        <th class="center" style="width:40px;">#      </th>
                        <th>User Name<?php //echo $dataProvider->sort->link('name')        ?>      </th>
                        <th>Sales Center<?php //echo $dataProvider->sort->link('profession_id')        ?>      </th>
                        <?php
                        foreach ($modelColumns as $col) {
                            ?>
                            <th style="width:70px;"><?php echo $col->value ?>      </th>
                            <?php
                        }
                        ?>
                        <th style="width:40px;">Total<?php //echo $dataProvider->sort->link('email')       ?>      </th>
                    </tr>
                </thead>
                <tbody>
                    <?php //$rows = $dataProvider->getModels();   ?>
                    <?php
                    $count = 0;
                    
                    foreach ($modelRows as $row) {
                        $count++;

                        //$totalvisits+= $row->no_of_visits;
                        //$totalcalls+= $row->no_of_calls;
                        ?>
                        <tr>
                            <td class="center"><?php echo $count; ?>      </td>
                            <td align="left"><?php echo $row->value; ?></td>
                            <td><?php echo $row->tag; ?>      </td>
                            <?php
                            foreach ($modelColumns as $col) {
                                $found = 0;

                                foreach ($model as $value) {
                                    if ($col->id == $value->columnid && $row->id == $value->rowid) {
                                        $found = 1;
                                        
                                        $col->total += $value->value;
                                        $row->total += $value->value;
                                        
                                        ?>
                                        <td align="right"><?php echo $value->value; //echo ($row->visitorCity == null ? "" : $row->visitorCity->city);      ?>      </td>
                                        <?php
                                    }
                                }
                                if ($found == 0) {
                                    ?>
                                        <td align="right">&nbsp;</td>
                                    <?php
                                }
                            }
                            ?>
                            <td align="right"><?php echo $row->total;     ?>      </td>
                        </tr>
                    <?php } ?>
                    <tr class="footer-row">
                        <td class="center"></td>
                        <td align="left" class="">Total</td>
                        <td></td>
                        <?php
                        $gtotal=0;
                        
                        foreach ($modelColumns as $col) {
                            $gtotal+=$col->total;
                            
                            ?>
                            <td align="right"><?php echo $col->total; ?></td>
                            <?php
                        }
                        ?>
                        <td align="right"><?php echo $gtotal;  ?></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>