<div class="general-default-index">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard">Home</a>
            </li>
            <li class="active">Property Reports</li>
        </ul><!-- /.breadcrumb -->
    </div>
    <div class="page-content">

        <div class="page-header">
            <h1>
                Plot Sizewise Summary                        
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                </small>
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="widget-box ui-sortable-handle" id="widget-box-1">
                    <div class="widget-header widget-header-large">
                        <h4 class="widget-title">Residential</h4>

                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center" style="width:40px;">#      </th>
                                        <th>Size      </th>
                                        <th style="width:100px;">Files Allotted      </th>
                                        <th style="width:100px;">Plots Allotted</th>
                                        <th style="width:70px;">Total      </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $totalfiles = 0; 
                                    $totalplots = 0; 
                                    $count=0;//$rows = $dataProvider->getModels(); ?>
                                    <?php foreach ($dataProvider as $row) { 
    $totalfiles += intval($row["no_of_files"]);
    $totalplots += intval($row["no_of_plots"]);
    $count++;
    $rtotal = intval($row["no_of_files"]) + intval($row["no_of_plots"]);
                                        ?>
                                        <tr>
                                            <td class="right" style="text-align: right;"> <?= $count ?>     </td>
                                            <td align="left">                            
                                                <?php 
                                                    echo $row["size"];
                                                ?>                                                                    
                                            </td>

                                            <td class="right" style="text-align: right;">                            
                                                <?php echo $row["no_of_files"] ?>
                                            </td>

                                            <td class="right" style="text-align: right;">
                                                <?php echo $row["no_of_plots"] ?>
                                            </td>
                                            <td class="right" style="text-align: right;"><?php echo ($rtotal == 0 ? "" : number_format($rtotal)); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                        <tr class="footer">
                                            <th class="right" style="background-color: #EEE;">      </th>
                                            <th align="left" style="background-color: #EEE;">                            
                                                Total
                                            </th>

                                            <th class="right" style="text-align: right; background-color: #EEE;">                            
                                                <?php echo $totalfiles ?>
                                            </th>

                                            <th class="right" style="text-align: right; background-color: #EEE;">
                                                <?php echo $totalplots ?>
                                            </th>
                                            <th class="right" style="text-align: right; background-color: #EEE;"><?php echo ($totalfiles + $totalplots == 0 ? "" : number_format($totalfiles + $totalplots)); ?>
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
