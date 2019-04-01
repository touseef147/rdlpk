<div class="widget-box widget-color-blue  no-border" id="widget-box-1">
    <div class="widget-header widget-header-medium"  style="background-color: #f5f5f5;">
        <h4 class="widget-title" style="color: #006699;">Sales Executive Report</h4>


        <div class="widget-toolbar">
            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/dailyprogress/printsummary" class="reportlink orange2">
                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/print_printer.png">
            </a>
            &nbsp;|&nbsp;
            <div class="widget-menu">
                <a href="#" data-action="settings" data-toggle="dropdown">
                    <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/pdf.png">
                </a>

                <ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
                    <li>
                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/dailyprogress/pdfsummary&pagesize=a4p">Portrait</a>
                    </li>

                    <li>
                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/dailyprogress/pdfsummary&pagesize=a4l">Landscape</a>
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
                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/dailyprogress/chart&charttype=bar">Bar Chart</a>
                    </li>

                    <li>
                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/dailyprogress/chart&charttype=line">Line Chart</a>
                    </li>

                    <li>
                        <a class="reportlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/dailyprogress/chart&charttype=pie">Pie Chart</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="widget-body">
        <div class="widget-main no-padding">
            <div class="scrollable-horizontal" data-size="2000">
                <table id="simple-table" class="table  table-bordered table-hover table-report">
                <thead>
                    <tr>
                        <th colspan="3" class="center" style="width:40px;">Description      </th>
                        <?php
                        foreach ($modelColumns as $col) {
                            ?>
                        <th colspan="2" style="width:50px;" class="center"><?php echo $col->value ?>      </th>
                            <?php
                        }
                        ?>
                        <th colspan="2" style="width:50px;">Total      </th>
                    </tr>
                    <tr>
                        <th class="center" style="width:40px;">#      </th>
                        <th>User Name<?php //echo $dataProvider->sort->link('name')        ?>      </th>
                        <th>Sales Center<?php //echo $dataProvider->sort->link('profession_id')        ?>      </th>
                        <?php
                        foreach ($modelColumns as $col) {
                            ?>
                            <th class="center" style="width:25px;">F      </th>
                            <th class="center" style="width:25px;">B      </th>
                            <?php
                        }
                        ?>
                        <th class="center" style="width:25px;">F<?php //echo $dataProvider->sort->link('email')       ?>      </th>
                        <th class="center" style="width:25px;">B<?php //echo $dataProvider->sort->link('email')       ?>      </th>
                    </tr>
                </thead>
                <tbody>
                    <?php //$rows = $dataProvider->getModels();   ?>
                    <?php
                    $count = 0;
                    
                    foreach ($modelRows as $row) {
                        $count++;

                        $row->total=0;
                        $row->totalsec=0;

                        //$totalvisits+= $row->no_of_visits;
                        //$totalcalls+= $row->no_of_calls;
                        ?>
                        <tr>
                            <td class="center"><?php echo $count; ?>      </td>
                            <td align="left"><?php echo $row->value; ?></td>
                            <td><?php echo $row->tag; ?>      </td>
                            <?php
                            foreach ($modelColumns as $col) {
                                $found1 = 0;
                                $found2 = 0;

                                $col->total=0;
                                $col->totalsec=0;

                                foreach ($model as $value) {
                                    if ($col->id == $value->columnid && $row->id == $value->rowid) {
                                        $found1 = 1;
                                        
                                        $col->total += $value->value;
                                        $row->total += $value->value;
                                        
                                        ?>
                                        <td align="right"><?php echo $value->value; //echo ($row->visitorCity == null ? "" : $row->visitorCity->city);      ?>      </td>
                                        <?php
                                    }
                                }

                                foreach ($modelp as $value) {
                                    if ($col->id == $value->columnid && $row->id == $value->rowid) {
                                        $found2 = 1;
                                        
                                        $col->totalsec += $value->value;
                                        $row->totalsec += $value->value;
                                        
                                        ?>
                                        <td align="right"><?php echo $value->value; //echo ($row->visitorCity == null ? "" : $row->visitorCity->city);      ?>      </td>
                                        <?php
                                    }
                                }
                                
                                if ($found1 == 0) {
                                    ?>
                                        <td align="right">&nbsp;</td>
                                    <?php
                                }
                                if ($found2 == 0) {
                                    ?>
                                        <td align="right">&nbsp;</td>
                                    <?php
                                }
                            }
                            ?>
                            <td align="right"><?php echo $row->total;     ?>      </td>
                            <td align="right"><?php echo $row->totalsec;     ?>      </td>
                        </tr>
                    <?php } ?>
                    <tr class="footer-row">
                        <td class="center"></td>
                        <td align="left" class="">Total</td>
                        <td></td>
                        <?php
                        $gtotal1=0;
                        $gtotal2=0;
                        
                        foreach ($modelColumns as $col) {
                            $gtotal1+=$col->total;
                            $gtotal2+=$col->totalsec;
                            
                            ?>
                            <td align="right"><?php echo $col->total; ?></td>
                            <td align="right"><?php echo $col->totalsec; ?></td>
                            <?php
                        }
                        ?>
                        <td align="right"><?php echo $gtotal1;  ?></td>
                        <td align="right"><?php echo $gtotal2;  ?></td>
                    </tr>
                </tbody>
            </table>
            </div>
            

        </div>
    </div>
</div>