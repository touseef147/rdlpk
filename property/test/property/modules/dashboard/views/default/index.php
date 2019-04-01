<?php

use app\components\Dashboarditem;
use app\components\Breadcrumb;
?>
<div class="general-default-index">
    <?=
    Breadcrumb::widget([
        "items" => [
            ["link" => "", "title" => "Control Panel"],
        ],
    ])
    ?>
    <div class="page-content">

        <div class="row">
            <div class="col-sm-12">
                <?php
                if (array_key_exists("visits/visitdetails/index", $myrights)) {
                    ?>
                    <div class="widget-box widget-color-blue ui-sortable-handle" id="widget-box-3">
                        <div class="widget-header widget-header-small">
                            <h6 class="widget-title">
                                <i class="ace-icon fa fa-sort"></i>
                                Marketting
                            </h6>

                            <div class="widget-toolbar">
                                <a href="#" data-action="collapse">
                                    <i class="ace-icon fa fa-minus" data-icon-show="fa-plus" data-icon-hide="fa-minus"></i>
                                </a>
                            </div>
                        </div>

                        <div style="" class="widget-body">
                            <div class="widget-main">
                                <div class="row">
                                    <?php
                                    if (array_key_exists("visits/visitdetails/index", $myrights)) {
                                        ?>
                                        <div class="col-sm-2">
                                            <div class="main-icons" style="height: 70px;">
                                                <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitdetails/index">
                                                    <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/icon-visitor.png" style="width: 50%">
                                                    <br>Visitors
                                                </a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="col-sm-2">
                                        <!--<div class="main-icons" style="height: 70px;">
                                            <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard/controller/index">
                                                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/logo_small.gif" style="width: 90%">
                                                <br>Two
                                            </a>
                                        </div>-->
                                    </div>
                                    <div class="col-sm-2">
                                        <!--<div class="main-icons" style="height: 70px;">
                                            <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard/controller/index">
                                                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/logo_small.gif" style="width: 90%">
                                                <br>Three
                                            </a>
                                        </div>-->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div class="widget-box widget-color-blue ui-sortable-handle" id="widget-box-3">
                    <div class="widget-header widget-header-small">
                        <h6 class="widget-title">
                            <i class="ace-icon fa fa-sort"></i>
                            Members
                        </h6>

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-minus" data-icon-show="fa-plus" data-icon-hide="fa-minus"></i>
                            </a>
                        </div>
                    </div>

                    <div style="" class="widget-body">
                        <div class="widget-main">
                            <div class="row">
                                <?=
                                Dashboarditem::widget([
                                    "title" => "Members", "rights" => $myrights,
                                    "links" => [
                                        ["url" => "members/members/index", "icon" => "members-icon.jpg", "title" => "", "counturl" => "members/members/count"],
                            ]])
                                ?>
                                <?=
                                Dashboarditem::widget([
                                    "title" => "Dealers", "rights" => $myrights,
                                    "links" => [
                                        ["url" => "members/dealers/dealers/index", "icon" => "dashboard_dealer.png", "title" => "", "counturl" => "members/dealers/dealers/count"],
                                        ["url" => "finance/fmsdealervoucher/index", "icon" => "dashboard_dealer.png", "title" => "", "counturl" => ""],
                            ]])
                                ?>
                                <?=
                                Dashboarditem::widget([
                                    "title" => "Land Owners", "rights" => $myrights,
                                    "links" => [
                                        ["url" => "members/owners/owners/index", "icon" => "members-icon.jpg", "title" => "", "counturl" => "members/owners/owners/count"],
                            ]])
                                ?>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="widget-box widget-color-blue ui-sortable-handle" id="widget-box-3">
                    <div class="widget-header widget-header-small">
                        <h6 class="widget-title">
                            <i class="ace-icon fa fa-sort"></i>
                            Property
                        </h6>

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-minus" data-icon-show="fa-plus" data-icon-hide="fa-minus"></i>
                            </a>
                        </div>
                    </div>

                    <div style="" class="widget-body">
                        <div class="widget-main">
                            <div class="row">
                                <?=
                                Dashboarditem::widget([
                                    "title" => "Application", "rights" => $myrights,
                                    "links" => [
                                        ["url" => "property/application/propertyapplication/index", "icon" => "register_icon.png", "title" => "", "counturl" => "property/application/propertyapplication/count"],
                            ]])
                                ?>

                                <?=
                                Dashboarditem::widget([
                                    "title" => "Instrument", "rights" => $myrights,
                                    "links" => [
                                        ["url" => "finance/fmsvoucher/financeapproval", "icon" => "recovery-icon.png", "title" => "", "counturl" => "finance/fmsvoucher/count"],
                                        ["url" => "finance/fmsvoucher/financeverification", "icon" => "recovery-icon.png", "title" => "", "counturl" => "finance/fmsvoucher/count"],
                                        ["url" => "finance/fmsvoucher/centerverification", "icon" => "recovery-icon.png", "title" => "", "counturl" => "finance/fmsvoucher/count"],
                                        ["url" => "finance/fmsvoucher/index", "icon" => "dashboard_instrument.png", "title" => "", "counturl" => "finance/fmsvoucher/count"],
                            ]])
                                ?>

                                <?=
                                Dashboarditem::widget([
                                    "title" => "Receipts", "rights" => $myrights,
                                    "links" => [
                                        ["url" => "finance/voucherplotdetail/index", "icon" => "receipt_book.gif", "title" => "", "counturl" => "finance/voucherplotdetail/count"],
                            ]])
                                ?>

                                <?=
                                Dashboarditem::widget([
                                    "title" => "Installments", "rights" => $myrights,
                                    "links" => [
                                        ["url" => "finance/installpayment/index", "icon" => "installments.gif", "title" => "", "counturl" => ""],
                            ]])
                                ?>

                                <?=
                                Dashboarditem::widget([
                                    "title" => "Allotments", "rights" => $myrights,
                                    "links" => [
                                        ["url" => "property/membership/memberships/approval", "icon" => "memberhsip.png", "title" => "", "counturl" => "property/membership/memberships/countapp"],
                                        ["url" => "property/membership/memberships/financever", "icon" => "memberhsip.png", "title" => "", "counturl" => "property/membership/memberships/countver"],
                                        ["url" => "property/membership/memberships/index", "icon" => "memberhsip.png", "title" => "", "counturl" => "property/membership/memberships/count"],
                            ]])
                                ?>

                                <?= ""
//                                Dashboarditem::widget([
//                                    "title" => "Allotments", "rights" => $myrights,
//                                    "links" => [
//                                        ["url" => "property/membership/allotments/index", "icon" => "recovery-icon.png", "title" => "", "counturl" => ""],
//                            ]])
                                ?>

                                <?=
                                Dashboarditem::widget([
                                    "title" => "Transfers", "rights" => $myrights,
                                    "links" => [
                                        ["url" => "property/membership/transfers/index", "icon" => "transfer.png", "title" => "", "counturl" => ""],
                            ]])
                                ?>


                                <?=
                                Dashboarditem::widget([
                                    "title" => "Cancel Membership", "rights" => $myrights,
                                    "links" => [
                                        ["url" => "property/membership/cancel/approval", "icon" => "memberhsip.png", "title" => "", "counturl" => "property/membership/cancel/countapp"],
                                        ["url" => "property/membership/cancel/financever", "icon" => "memberhsip.png", "title" => "", "counturl" => "property/membership/cancel/countver"],
                                        ["url" => "property/membership/cancel/index", "icon" => "memberhsip.png", "title" => "", "counturl" => "property/membership/cancel/count"],
                            ]])
                                ?>

                                <?=
                                Dashboarditem::widget([
                                    "title" => "Convert File", "rights" => $myrights,
                                    "links" => [
                                        ["url" => "property/membership/convert/approval", "icon" => "memberhsip.png", "title" => "", "counturl" => "property/membership/convert/countapp"],
                                        ["url" => "property/membership/convert/financever", "icon" => "memberhsip.png", "title" => "", "counturl" => "property/membership/convert/countver"],
                                        ["url" => "property/membership/convert/index", "icon" => "memberhsip.png", "title" => "", "counturl" => "property/membership/convert/count"],
                            ]])
                                ?>

                                <?=
                                Dashboarditem::widget([
                                    "title" => "Merge File", "rights" => $myrights,
                                    "links" => [
                                        ["url" => "property/membership/merge/approval", "icon" => "memberhsip.png", "title" => "", "counturl" => "property/membership/merge/countapp"],
                                        ["url" => "property/membership/merge/financever", "icon" => "memberhsip.png", "title" => "", "counturl" => "property/membership/merge/countver"],
                                        ["url" => "property/membership/merge/index", "icon" => "memberhsip.png", "title" => "", "counturl" => "property/membership/merge/count"],
                            ]])
                                ?>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="widget-box widget-color-blue ui-sortable-handle" id="widget-box-3">
                    <div class="widget-header widget-header-small">
                        <h6 class="widget-title">
                            <i class="ace-icon fa fa-sort"></i>
                            Configuration
                        </h6>

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-minus" data-icon-show="fa-plus" data-icon-hide="fa-minus"></i>
                            </a>
                        </div>
                    </div>

                    <div style="" class="widget-body">
                        <div class="widget-main">
                            <div class="row">
                                <?php
                                if (array_key_exists("property/config/default/index", $myrights)) {
                                    ?>
                                    <div class="col-sm-2">

                                        <div class="main-icons" style="height: 70px;">
                                            <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config">
                                                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/street-icon.png" style="height: 35px">
                                                <br>Property
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                }
                                if (array_key_exists("property/config/default/index", $myrights)) {
                                    ?>
                                <div class="col-sm-2">
                                    <div class="main-icons" style="height: 70px;">
                                        <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=general">
                                            <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/toolbars-icon.png" style="height: 35px">
                                            <br>General
                                        </a>
                                    </div>
                                </div>
                                    <?php
                                }
                                if (array_key_exists("property/config/default/index", $myrights)) {
                                    ?>
                                <div class="col-sm-2">
                                    <div class="main-icons" style="height: 70px;">
                                        <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance">
                                            <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/finance.png" style="height: 35px">
                                            <br>Finance
                                        </a>
                                    </div>
                                </div>
                                    <?php
                                }
                                if (yii::$app->user->identity->roletype ==1) {
                                    ?>
                                <div class="col-sm-2">
                                    <div class="main-icons" style="height: 70px;">
                                        <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security">
                                            <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/ch2.png" style="height: 35px">
                                            <br>Security
                                        </a>
                                    </div>
                                </div>
                                    <?php
                                }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
<!--            <div class="col-sm-3">

            </div>-->
        </div>

    </div>
</div>
