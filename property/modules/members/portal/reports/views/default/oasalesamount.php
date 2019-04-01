<div class="general-default-index">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard">Home</a>
            </li>
            <li class="active">Dealers Reports</li>
        </ul><!-- /.breadcrumb -->
    </div>
    <div class="page-content">

        <div class="page-header">
            <h1>
                Dealerwise Summary                        
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                </small>
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="widget-box ui-sortable-handle" id="widget-box-1">
                    <div class="widget-header widget-header-large">
                        <h4 class="widget-title">Dealerwise Summary</h4>

                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <?php
                                    $arrcols = array();
                                    ?>
                                    <tr>
                                        <th class="center" style="width:40px;">#      </th>
                                        <th style="width: 100px;"></th>
                                        <th>Name      </th>
                                        <th>Business Title      </th>
                                        <th>Group</th>
                                        <th style="width:70px;">Deposit      </th>
                                        <th style="width:70px;">Used      </th>
                                        <th style="width:70px;">Balance      </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    $count = 0;
                                    $directbookings = 0;
//$rows = $dataProvider->getModels(); 
                                    ?>
                                    <?php
                                    foreach ($dataProvider as $row) {
                                        $colno = -1;

                                        $total += intval($row["no_of_applications"]);
                                        $count++;
                                        ?>
                                        <tr>
                                            <td class="right" style="text-align: right;"> <?= $count ?>     </td>
                                            <td class="right" > <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/uploads/members/pictures/<?php echo $row["image"]; ?>?<?php echo date('H-i-s'); ?>" height="100">     </td>
                                            <td align="left">                            
                                                <?php
                                                echo $row["name"];
                                                ?>                                                                    
                                            </td>

                                            <td>                            
                                                <?php echo $row["dealers_business_title"] ?>
                                            </td>

                                            <td>
                                                <?php echo $row["group_title"] ?>
                                            </td>
                                            <td class="right" style="text-align: right; font-weight: bold;"><?php echo (intval($row["no_of_applications"]) == 0 ? "" : number_format($row["no_of_applications"])); ?>
                                            </td>
                                            <td class="right" style="text-align: right; font-weight: bold;"><?php echo (intval($row["no_of_applications"]) == 0 ? "" : number_format($row["no_of_applications"])); ?>
                                            </td>
                                            <td class="right" style="text-align: right; font-weight: bold;"><?php echo (intval($row["no_of_applications"]) == 0 ? "" : number_format($row["no_of_applications"])); ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    $count++;

                                            foreach ($dataProvidervalues as $rowv) {
                                                if (($rowv["dealer_id"] == null || intval($rowv["dealer_id"]) == 0)) {
                                                    $directbookings += intval($rowv["no_of_applications"]);
                                                    //$arrcols[$colno] += intval($rowv["no_of_applications"]);
                                                }
                                            }
                                    ?>
                                    <tr>
                                        <td class="right" style="text-align: right;"> <?= $count ?>     </td>
                                        <td class="right" >&nbsp;</td>
                                        <td align="left">                            
                                            Direct Booking
                                        </td>

                                        <td>                            
                                            &nbsp;
                                        </td>

                                        <td>
                                            &nbsp;
                                        </td>
                                        <td class="right" style="text-align: right; font-weight: bold;"><?php echo ($directbookings == 0 ? "" : number_format($directbookings));  ?>
                                        </td>
                                        <td class="right" style="text-align: right; font-weight: bold;"><?php echo ($directbookings == 0 ? "" : number_format($directbookings));  ?>
                                        </td>
                                        <td class="right" style="text-align: right; font-weight: bold;"><?php echo ($directbookings == 0 ? "" : number_format($directbookings));  ?>
                                        </td>
                                    </tr>
                                    <tr class="footer">
                                        <th class="right" style="background-color: #EEE;">      </th>
                                        <th align="left" style="background-color: #EEE;" colspan="4">                            
                                            Total
                                        </th>

                                        <th class="right" style="text-align: right; background-color: #EEE;"><?php echo ($total + $directbookings == 0 ? "" : number_format($total + $directbookings)); ?>
                                        </th>
                                        <th class="right" style="text-align: right; background-color: #EEE;"><?php echo ($total + $directbookings == 0 ? "" : number_format($total + $directbookings)); ?>
                                        </th>
                                        <th class="right" style="text-align: right; background-color: #EEE;"><?php echo ($total + $directbookings == 0 ? "" : number_format($total + $directbookings)); ?>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>
</div>
