<div class="general-default-index">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard">Home</a>
            </li>
            <li class="active">Visitors</li>
        </ul><!-- /.breadcrumb -->
    </div>
    <div class="page-content">

        <div class="page-header">
                <h1>
                    Visitors
                        <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                                            </small>
                </h1>
        </div><!-- /.page-header -->
        
        <div class="row">
            <div class="col-sm-2">
                <div class="main-icons" style="height: 90px;">
                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/dailyvisitors/index">
                        <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/category-icon.png" style="height: 50px;">
                        <br>Visitors
                    </a>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="main-icons" style="height: 90px;">
                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitdetails/index">
                        <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/icon_projects.png" style="height: 50px;">
                        <br>Followup
                    </a>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="main-icons" style="height: 90px;">
                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/complains/index">
                        <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/street-icon.png" style="height: 50px;">
                        <br>Complains
                    </a>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="main-icons" style="height: 90px;">
                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/suggestions/index">
                        <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/i-scheduled-payment.png" style="height: 50px;">
                        <br>Suggestions
                    </a>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="main-icons" style="height: 90px;">
                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/bookings/index">
                        <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/landsize.png" style="height: 50px;">
                        <br>Direct Bookings
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
        <div class="page-header">
                <h1 class="orange">
                    Reports
                        <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                                            </small>
                </h1>
        </div><!-- /.page-header -->
        
        <div class="row">
            <div class="col-sm-4">
                <div class="main-icons" style="height: 90px;">
                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/default/index">
                        <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/category-icon.png" style="height: 50px;">
                        <br>Visitors
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="main-icons" style="height: 90px;">
                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/users">
                        <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/icon_projects.png" style="height: 50px;">
                        <br>Interest/Booking
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="main-icons" style="height: 90px;">
                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/salescenters">
                        <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/street-icon.png" style="height: 50px;">
                        <br>Followup
                    </a>
                </div>
            </div>
        </div>
            </div>
            <div class="col-sm-6">

        <div class="page-header">
            <h1 class="orange">
                    Progress Reports
                        <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                                            </small>
                </h1>
        </div><!-- /.page-header -->
        
        <div class="row">
            <div class="col-sm-4">
                <div class="main-icons" style="height: 90px;">
                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/dailyreport/index">
                        <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/category-icon.png" style="height: 50px;">
                        <br>Daily
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="main-icons" style="height: 90px;">
                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/users">
                        <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/icon_projects.png" style="height: 50px;">
                        <br>Monthly
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="main-icons" style="height: 90px;">
                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/salescenters">
                        <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/street-icon.png" style="height: 50px;">
                        <br>Annual
                    </a>
                </div>
            </div>
        </div>
            </div>
    </div>
</div>
