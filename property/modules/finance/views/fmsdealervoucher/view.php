<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\application\Fmsvoucher */
/* @var $form yii\widgets\ActiveForm */
date_default_timezone_set('Asia/Karachi');

?>
<link rel="stylesheet" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/css/reportfonts.css">
<style media="print">
    * {transition: none !important}
    @page {
        size: legal;
        /*margin: 10%;*/
    }

    .pagebreakafter {
        page-break-after: always;
    }
    .pagebreakbefore {
        page-break-before: always;
    }
    .hideseperator {
        display: none;
    }
</style>
<script type="text/javascript" src="<?php echo Yii::$app->urlManager->baseUrl; ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->urlManager->baseUrl; ?>/js/barcode.js"></script>
<table style="width: 100%" cellpadding="0" cellspacing="0">
    <tr id="receiptcontainer1_1">
        <td style="padding: 15px;">
            <table style="width: 100%" cellpadding="0" cellspacing="0" data-sep1="receiptsep1_1" data-sec1="receiptcontainer1_1" data-sec2="receiptcontainer1_2" data-sep2="receiptsep1_2" class="receiptsection1">
                <tr>
                    <td style="border: thin solid #000;">
                        <table style="width: 100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="padding:10px; width: 80px;">
                                                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/icons/logo.gif" width="70" >
                                            </td>
                                            <td>
                                                <table style="width:100%" cellpadding="5" cellspacing="0">
                                                    <tr>
                                                        <td style="text-align: center; font-family: Californian FB; font-size: 24px; font-weight: bold;">
                                                            <?php echo $model->project->report_title_line1; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: rgb(156, 156, 156); color: #fff; padding-bottom: 5px; padding-top: 5px; text-align: center; font-family: Californian FB; font-size: 18px; font-weight: bold;">
                                                            <?php echo $model->project->report_title_line2; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center; font-family: Arial; font-size: 20px; font-weight: bold;">
                                                            F U N D S  T R A N S F E R
                                                        </td>
                                                    </tr>
                                                </table>                                                    
                                            </td>
                                            <td style="vertical-align: top; width: 120px;">
                                                <table style="width:100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="text-align: right; height: 35px;">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">
                                                            <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/uploads/property/projects/<?php echo $model->project->project_image; ?>" width="120" >
                                                        </td>
                                                    </tr>
                                                </table>                                                    
                                            </td>
                                            <td style="vertical-align: top; width: 130px;">
                                                <table style="width:100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="text-align: right;">
                                                            <div style="border-bottom-left-radius: 20px; background-color: #000; color: #fff; padding: 3px; width: 120px; float: right; margin-top: 0px; margin-right: 0px; font-family: Arial Narrow; font-weight: bold; font-size: 14px;">
                                                                Members Copy
                                                            </div>


                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">
                                                            <div class="barcodecontainer" data-value="FDH123234" data-type="datamatrix" data-renderas="css" style="float: right; margin-right: 3px; margin-top: 1px;"></div> <!--This element id should  be passed on to options-->
                                                        </td>
                                                    </tr>
                                                </table>                                                    
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table style="width:100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="padding-left:20px; padding-right: 20px;">
                                                <table style="width:100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td>
                                                            <table style="width:100%" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td style="font-family: Arial Narrow; font-size: 11px; width: 50px;" >
                                                                        Date:
                                                                    </td>
                                                                    <td style="font-family: Arial Narrow; font-size: 12px; font-weight: bold;" >
                                                                        03-Aug-16
                                                                    </td>
                                                                    <td style="font-family: Arial Narrow; font-size: 11px; width: 60px;" >
                                                                        JV No.:
                                                                    </td>
                                                                    <td style="font-family: Century Schoolbook; font-size: 18px; font-weight: bold; width: 100px;" >
                                                                        2015
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border: thin dotted #C1CEC4; background-color: #EDF3F7;">
                                                            <table style="width:100%" cellpadding="1" cellspacing="0">
                                                                <tr>
                                                                    <td style="font-family: Arrial Narrow; font-size: 9px;">
                                                                        Received with thanks from <span style="font-family: Segoe Script; font-weight: bold; font-size: 11px;">Muhammad Zubair Awan   s/o  Abdul Waheed Awan</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-family: Arrial Narrow; font-size: 9px;">
                                                                        On account of <span style="font-family: Segoe Script; font-weight: bold; font-size: 11px;">Booking of 1 Kanal Plot & other due installments including Pending payments</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table cellpadding="0" cellspacing="0">
                                                                            <tr>
                                                                                <td style="font-family: Arrial Narrow; font-size: 9px; width: 80px;">
                                                                                    PO/DD/Cheque #
                                                                                </td>
                                                                                <td style="font-family: Segoe Script; font-weight: bold; font-size: 11px;">
                                                                                    8988289  (MCB)
                                                                                </td>
                                                                                <td style="font-family: Arrial Narrow; font-size: 9px; width: 80px; text-align: right;">
                                                                                    Amounting to
                                                                                </td>
                                                                                <td style="font-family: Segoe Script; font-weight: bold; font-size: 11px; padding-left: 8px;">
                                                                                    Rs.1,320,000/-
                                                                                </td>
                                                                                <td style="font-family: Arrial Narrow; font-size: 9px; width: 80px; text-align: right;">
                                                                                    Dated
                                                                                </td>
                                                                                <td style="font-family: Segoe Script; font-weight: bold; font-size: 11px; padding-left: 8px;">
                                                                                    01-Aug-2016
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-left: thin dotted #C1CEC4; border-bottom: thin dotted #C1CEC4; border-right: thin dotted #C1CEC4;">
                                                            <table style="width:100%" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td style="padding: 3px; width: 90px; font-family: Arrial Narrow; font-size: 9px;">Membership No</td>
                                                                    <td style="padding: 3px; font-family: Segoe Script; font-weight: bold; font-size: 11px;">ROMN2-0001-RO5M</td>
                                                                    <td style="padding: 3px; width: 120px; text-align: right; font-family: Arrial Narrow; font-size: 9px;">Paid Amount</td>
                                                                    <td style="padding: 3px; background-color: #000; color: #fff; width: 150px; font-family: Segoe UI; font-weight: bold; font-size: 11px; text-align: right;">Rs.510,000</td>
                                                                </tr>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 4px;">
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-right: 1px; padding-left: 1px; height: 140px; vertical-align: top;">
                                                <table style="width: 100%;" cellpadding="3" cellspacing="0">
                                                    <tr>
                                                        <td style="border-top: thin dotted #000; border-bottom: thin dotted #000; background-color: #efefef; font-family: Arrial Narrow; font-size: 11px; font-weight: bold; width: 25px;">
                                                            Sr#
                                                        </td>
                                                        <td style="border-top: thin dotted #000; border-bottom: thin dotted #000; background-color: #efefef; font-family: Arrial Narrow; font-size: 11px; font-weight: bold;">
                                                            Paid Against
                                                        </td>
                                                        <td style="border-top: thin dotted #000; border-bottom: thin dotted #000; background-color: #efefef; font-family: Arrial Narrow; font-size: 11px; font-weight: bold;">
                                                            Description
                                                        </td>
                                                        <td style="border-top: thin dotted #000; border-bottom: thin dotted #000; background-color: #efefef; width: 100px; font-family: Arrial Narrow; font-size: 11px; font-weight: bold;">
                                                            Due Amount
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            1
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            Booking
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            ---
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            250,000
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            1
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            Booking
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            ---
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            250,000
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            1
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            Booking
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            ---
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            250,000
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            1
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            Booking
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            ---
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            250,000
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            1
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            Booking
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            ---
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            250,000
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-top: thin solid #000">
                                    <table style="width:100%" cellpadding="3" cellspacing="0">
                                        <tr>
                                            <td>
                                                <table style="width:100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9px;">
                                                            The Sum of Rupees: <span style="font-family: Segoe Print; font-weight: bold; font-size: 11px;">Five hundred Ten Thousands only</span>
                                                        </td>
                                                        <td style="width:200px; text-align: right; font-family: Arrial Narrow; font-size: 11px; font-weight: bold;">
                                                            Rs:250,000
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table style="width:100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="width: 120px;font-family: Arrial Narrow; font-size: 8px;">
                                                            [Receipt 1 of 1]
                                                        </td>
                                                        <td style="font-family: Arrial Narrow; font-size: 8px;">
                                                            <?php echo Yii::$app->user->identity->username; ?> | Multan Office. | <?php echo date("d-M-Y Hi")." Hrs"; ?>
                                                        </td>
                                                        <td style="border-top: thin solid #000; width: 150px; text-align: center; font-family: Arrial Narrow; font-size: 11px;">
                                                            S i g n a t u r e
                                                        </td>
                                                        <td style="width:100px;">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr id="receiptsep1_1">
        <td style="border-bottom: thin dashed #000; font-size: 1px;">&nbsp;
        </td>
    </tr>
    <tr id="receiptcontainer1_2">
        <td style="padding: 15px;">
            <table style="width: 100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="border: thin solid #000;">
                        <table style="width: 100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="padding:10px; width: 80px;">
                                                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/icons/logo.gif" width="70" >
                                            </td>
                                            <td>
                                                <table style="width:100%" cellpadding="5" cellspacing="0">
                                                    <tr>
                                                        <td style="text-align: center; font-family: Californian FB; font-size: 24px; font-weight: bold;">
                                                            Capital Smart City
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: rgb(156, 156, 156); color: #fff; padding-bottom: 5px; padding-top: 5px; text-align: center; font-family: Californian FB; font-size: 18px; font-weight: bold;">
                                                            Islamabad
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center; font-family: Arial; font-size: 20px; font-weight: bold;">
                                                            R E C E I P T
                                                        </td>
                                                    </tr>
                                                </table>                                                    
                                            </td>
                                            <td style="vertical-align: top; width: 120px;">
                                                <table style="width:100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="text-align: right; height: 35px;">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">
                                                            <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/uploads/property/projects/1.jpg" width="120" >
                                                        </td>
                                                    </tr>
                                                </table>                                                    
                                            </td>
                                            <td style="vertical-align: top; width: 130px;">
                                                <table style="width:100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="text-align: right;">
                                                            <div style="border-bottom-left-radius: 20px; background-color: #000; color: #fff; padding: 3px; width: 120px; float: right; margin-top: 0px; margin-right: 0px; font-family: Arial Narrow; font-weight: bold; font-size: 14px;">
                                                                Office Copy
                                                            </div>


                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">
                                                            <div class="barcodecontainer" data-value="FDH123234" data-type="datamatrix" data-renderas="css" style="float: right; margin-right: 3px; margin-top: 1px;"></div> <!--This element id should  be passed on to options-->
                                                        </td>
                                                    </tr>
                                                </table>                                                    
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table style="width:100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="padding-left:20px; padding-right: 20px;">
                                                <table style="width:100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td>
                                                            <table style="width:100%" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td style="font-family: Arial Narrow; font-size: 11px; width: 50px;" >
                                                                        Date:
                                                                    </td>
                                                                    <td style="font-family: Arial Narrow; font-size: 12px; font-weight: bold;" >
                                                                        03-Aug-16
                                                                    </td>
                                                                    <td style="font-family: Arial Narrow; font-size: 11px; width: 60px;" >
                                                                        Receipt No.:
                                                                    </td>
                                                                    <td style="font-family: Century Schoolbook; font-size: 18px; font-weight: bold; width: 100px;" >
                                                                        2015
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border: thin dotted #C1CEC4; background-color: #EDF3F7;">
                                                            <table style="width:100%" cellpadding="1" cellspacing="0">
                                                                <tr>
                                                                    <td style="font-family: Arrial Narrow; font-size: 9px;">
                                                                        Received with thanks from <span style="font-family: Segoe Script; font-weight: bold; font-size: 11px;">Muhammad Zubair Awan   s/o  Abdul Waheed Awan</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-family: Arrial Narrow; font-size: 9px;">
                                                                        On account of <span style="font-family: Segoe Script; font-weight: bold; font-size: 11px;">Booking of 1 Kanal Plot & other due installments including Pending payments</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table cellpadding="0" cellspacing="0">
                                                                            <tr>
                                                                                <td style="font-family: Arrial Narrow; font-size: 9px; width: 80px;">
                                                                                    PO/DD/Cheque #
                                                                                </td>
                                                                                <td style="font-family: Segoe Script; font-weight: bold; font-size: 11px;">
                                                                                    8988289  (MCB)
                                                                                </td>
                                                                                <td style="font-family: Arrial Narrow; font-size: 9px; width: 80px; text-align: right;">
                                                                                    Amounting to
                                                                                </td>
                                                                                <td style="font-family: Segoe Script; font-weight: bold; font-size: 11px; padding-left: 8px;">
                                                                                    Rs.1,320,000/-
                                                                                </td>
                                                                                <td style="font-family: Arrial Narrow; font-size: 9px; width: 80px; text-align: right;">
                                                                                    Dated
                                                                                </td>
                                                                                <td style="font-family: Segoe Script; font-weight: bold; font-size: 11px; padding-left: 8px;">
                                                                                    01-Aug-2016
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-left: thin dotted #C1CEC4; border-bottom: thin dotted #C1CEC4; border-right: thin dotted #C1CEC4;">
                                                            <table style="width:100%" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td style="padding: 3px; width: 90px; font-family: Arrial Narrow; font-size: 9px;">Membership No</td>
                                                                    <td style="padding: 3px; font-family: Segoe Script; font-weight: bold; font-size: 11px;">ROMN2-0001-RO5M</td>
                                                                    <td style="padding: 3px; width: 120px; text-align: right; font-family: Arrial Narrow; font-size: 9px;">Paid Amount</td>
                                                                    <td style="padding: 3px; background-color: #000; color: #fff; width: 150px; font-family: Segoe UI; font-weight: bold; font-size: 11px; text-align: right;">Rs.510,000</td>
                                                                </tr>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 4px;">
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-right: 1px; padding-left: 1px; height: 140px; vertical-align: top;">
                                                <table style="width: 100%;" cellpadding="3" cellspacing="0">
                                                    <tr>
                                                        <td style="border-top: thin dotted #000; border-bottom: thin dotted #000; background-color: #efefef; font-family: Arrial Narrow; font-size: 11px; font-weight: bold; width: 25px;">
                                                            Sr#
                                                        </td>
                                                        <td style="border-top: thin dotted #000; border-bottom: thin dotted #000; background-color: #efefef; font-family: Arrial Narrow; font-size: 11px; font-weight: bold;">
                                                            Paid Against
                                                        </td>
                                                        <td style="border-top: thin dotted #000; border-bottom: thin dotted #000; background-color: #efefef; font-family: Arrial Narrow; font-size: 11px; font-weight: bold;">
                                                            Description
                                                        </td>
                                                        <td style="border-top: thin dotted #000; border-bottom: thin dotted #000; background-color: #efefef; width: 100px; font-family: Arrial Narrow; font-size: 11px; font-weight: bold;">
                                                            Due Amount
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            1
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            Booking
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            ---
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            250,000
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            1
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            Booking
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            ---
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            250,000
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            1
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            Booking
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            ---
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            250,000
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            1
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            Booking
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            ---
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            250,000
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            1
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            Booking
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            ---
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            250,000
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-top: thin solid #000">
                                    <table style="width:100%" cellpadding="3" cellspacing="0">
                                        <tr>
                                            <td>
                                                <table style="width:100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9px;">
                                                            The Sum of Rupees: <span style="font-family: Segoe Print; font-weight: bold; font-size: 11px;">Five hundred Ten Thousands only</span>
                                                        </td>
                                                        <td style="width:200px; text-align: right; font-family: Arrial Narrow; font-size: 11px; font-weight: bold;">
                                                            Rs:250,000
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table style="width:100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="width: 120px;font-family: Arrial Narrow; font-size: 8px;">
                                                            [Receipt 1 of 1]
                                                        </td>
                                                        <td style="font-family: Arrial Narrow; font-size: 8px;">
                                                            <?php echo Yii::$app->user->identity->username; ?> | Multan Office. | <?php echo date("d-M-Y Hi")." Hrs"; ?>
                                                        </td>
                                                        <td style="border-top: thin solid #000; width: 150px; text-align: center; font-family: Arrial Narrow; font-size: 11px;">
                                                            S i g n a t u r e
                                                        </td>
                                                        <td style="width:100px;">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr id="receiptsep1_2">
        <td style="border-bottom: thin dashed #000; font-size: 1px;">&nbsp;
        </td>
    </tr>
    <tr class="receiptsection3">
        <td style="padding: 15px;">
            <table style="width: 100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="border: thin solid #000;">
                        <table style="width: 100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="padding:10px; width: 80px;">
                                                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/icons/logo.gif" width="70" >
                                            </td>
                                            <td>
                                                <table style="width:100%" cellpadding="5" cellspacing="0">
                                                    <tr>
                                                        <td style="text-align: center; font-family: Californian FB; font-size: 24px; font-weight: bold;">
                                                            Capital Smart City
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: rgb(156, 156, 156); color: #fff; padding-bottom: 5px; padding-top: 5px; text-align: center; font-family: Californian FB; font-size: 18px; font-weight: bold;">
                                                            Islamabad
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center; font-family: Arial; font-size: 20px; font-weight: bold;">
                                                            R E C E I P T
                                                        </td>
                                                    </tr>
                                                </table>                                                    
                                            </td>
                                            <td style="vertical-align: top; width: 120px;">
                                                <table style="width:100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="text-align: right; height: 35px;">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">
                                                            <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/uploads/property/projects/1.jpg" width="120" >
                                                        </td>
                                                    </tr>
                                                </table>                                                    
                                            </td>
                                            <td style="vertical-align: top; width: 130px;">
                                                <table style="width:100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="text-align: right;">
                                                            <div style="border-bottom-left-radius: 20px; background-color: #000; color: #fff; padding: 5px; width: 120px; float: right; margin-top: 0px; margin-right: 0px; font-family: Arial Narrow; font-weight: bold; font-size: 14px;">
                                                                Office Copy
                                                            </div>


                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">
                                                            <div class="barcodecontainer" data-value="FDH123234" data-type="datamatrix" data-renderas="css" style="float: right; margin-right: 3px; margin-top: 1px;"></div> <!--This element id should  be passed on to options-->
                                                        </td>
                                                    </tr>
                                                </table>                                                    
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table style="width:100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="padding-left:20px; padding-right: 20px;">
                                                <table style="width:100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td>
                                                            <table style="width:100%" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td style="font-family: Arial Narrow; font-size: 11px; width: 50px;" >
                                                                        Date:
                                                                    </td>
                                                                    <td style="font-family: Arial Narrow; font-size: 12px; font-weight: bold;" >
                                                                        03-Aug-16
                                                                    </td>
                                                                    <td style="font-family: Arial Narrow; font-size: 11px; width: 60px;" >
                                                                        Receipt No.:
                                                                    </td>
                                                                    <td style="font-family: Century Schoolbook; font-size: 18px; font-weight: bold; width: 100px;" >
                                                                        2015
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border: thin dotted #C1CEC4; background-color: #EDF3F7;">
                                                            <table style="width:100%" cellpadding="1" cellspacing="0">
                                                                <tr>
                                                                    <td style="font-family: Arrial Narrow; font-size: 9px;">
                                                                        Received with thanks from <span style="font-family: Segoe Script; font-weight: bold; font-size: 11px;">Muhammad Zubair Awan   s/o  Abdul Waheed Awan</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-family: Arrial Narrow; font-size: 9px;">
                                                                        On account of <span style="font-family: Segoe Script; font-weight: bold; font-size: 11px;">Booking of 1 Kanal Plot & other due installments including Pending payments</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table cellpadding="0" cellspacing="0">
                                                                            <tr>
                                                                                <td style="font-family: Arrial Narrow; font-size: 9px; width: 80px;">
                                                                                    PO/DD/Cheque #
                                                                                </td>
                                                                                <td style="font-family: Segoe Script; font-weight: bold; font-size: 11px;">
                                                                                    8988289  (MCB)
                                                                                </td>
                                                                                <td style="font-family: Arrial Narrow; font-size: 9px; width: 80px; text-align: right;">
                                                                                    Amounting to
                                                                                </td>
                                                                                <td style="font-family: Segoe Script; font-weight: bold; font-size: 11px; padding-left: 8px;">
                                                                                    Rs.1,320,000/-
                                                                                </td>
                                                                                <td style="font-family: Arrial Narrow; font-size: 9px; width: 80px; text-align: right;">
                                                                                    Dated
                                                                                </td>
                                                                                <td style="font-family: Segoe Script; font-weight: bold; font-size: 11px; padding-left: 8px;">
                                                                                    01-Aug-2016
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-left: thin dotted #C1CEC4; border-bottom: thin dotted #C1CEC4; border-right: thin dotted #C1CEC4;">
                                                            <table style="width:100%" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td style="padding: 3px; width: 90px; font-family: Arrial Narrow; font-size: 9px;">Membership No</td>
                                                                    <td style="padding: 3px; font-family: Segoe Script; font-weight: bold; font-size: 11px;">ROMN2-0001-RO5M</td>
                                                                    <td style="padding: 3px; width: 120px; text-align: right; font-family: Arrial Narrow; font-size: 9px;">Paid Amount</td>
                                                                    <td style="padding: 3px; background-color: #000; color: #fff; width: 150px; font-family: Segoe UI; font-weight: bold; font-size: 11px; text-align: right;">Rs.510,000</td>
                                                                </tr>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 4px;">
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-right: 1px; padding-left: 1px; height: 140px; vertical-align: top;">
                                                <table style="width: 100%;" cellpadding="3" cellspacing="0">
                                                    <tr>
                                                        <td style="border-top: thin dotted #000; border-bottom: thin dotted #000; background-color: #efefef; font-family: Arrial Narrow; font-size: 11px; font-weight: bold; width: 25px;">
                                                            Sr#
                                                        </td>
                                                        <td style="border-top: thin dotted #000; border-bottom: thin dotted #000; background-color: #efefef; font-family: Arrial Narrow; font-size: 11px; font-weight: bold;">
                                                            Paid Against
                                                        </td>
                                                        <td style="border-top: thin dotted #000; border-bottom: thin dotted #000; background-color: #efefef; font-family: Arrial Narrow; font-size: 11px; font-weight: bold;">
                                                            Description
                                                        </td>
                                                        <td style="border-top: thin dotted #000; border-bottom: thin dotted #000; background-color: #efefef; width: 100px; font-family: Arrial Narrow; font-size: 11px; font-weight: bold;">
                                                            Due Amount
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            1
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            Booking
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            ---
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            250,000
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            1
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            Booking
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            ---
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            250,000
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            1
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            Booking
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            ---
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            250,000
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            1
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            Booking
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            ---
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            250,000
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            1
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            Booking
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            ---
                                                        </td>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9.5px;">
                                                            250,000
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-top: thin solid #000">
                                    <table style="width:100%" cellpadding="3" cellspacing="0">
                                        <tr>
                                            <td>
                                                <table style="width:100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style=" font-family: Arrial Narrow; font-size: 9px;">
                                                            The Sum of Rupees: <span style="font-family: Segoe Print; font-weight: bold; font-size: 11px;">Five hundred Ten Thousands only</span>
                                                        </td>
                                                        <td style="width:200px; text-align: right; font-family: Arrial Narrow; font-size: 11px; font-weight: bold;">
                                                            Rs:250,000
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table style="width:100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="width: 120px;font-family: Arrial Narrow; font-size: 8px;">
                                                            [Receipt 1 of 1]
                                                        </td>
                                                        <td style="font-family: Arrial Narrow; font-size: 8px;">
                                                            <?php echo Yii::$app->user->identity->username; ?> | Multan Office. | <?php echo date("d-M-Y Hi")." Hrs"; ?>
                                                        </td>
                                                        <td style="border-top: thin solid #000; width: 150px; text-align: center; font-family: Arrial Narrow; font-size: 11px;">
                                                            S i g n a t u r e
                                                        </td>
                                                        <td style="width:100px;">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<script type="text/javascript">

    function generateBarcode() {
        var loaders = $('.barcodecontainer');
        $.each(loaders, function (index, element) {
            var value = $(this).attr('data-value');
            var btype = $(this).attr('data-type');// "datamatrix"; //ean8,ean13,upc,std25,int25,code11,code39,code93,code128,codabar,msi,datamatrix  //$("input[name=btype]:checked").val();
            var renderer = $(this).attr('data-renderas');//"css" //bmp,svg,canvas //$("input[name=renderer]:checked").val();

            var settings = {
                output: renderer,
                bgColor: "#FFFFFF", //$("#bgColor").val(),
                color: "#000000", //$("#color").val(),
                barWidth: 1, //$("#barWidth").val(),
                barHeight: 20, //$("#barHeight").val(),
                moduleSize: 4, //$("#moduleSize").val(),
                posX: 10, //$("#posX").val(),
                posY: 20, //$("#posY").val(),
                addQuietZone: 1 //$("#quietZoneSize").val()
            };
//        if ($("#rectangular").is(':checked') || $("#rectangular").attr('checked')) {
//            value = {code: value, rect: true};
//        }

            $(this).html("").show().barcode(value, btype, settings);
        });
    }

    $(document).ready(function () {
        generateBarcode();

        var pageheight = 14;        //inches
        var printerresolution = <?php echo Yii::$app->user->identity->printerresolution; ?>;

        var loaders = $('.receiptsection1');
        $.each(loaders, function (index, element) {
            var sectionh = parseInt(pageheight) * parseInt(printerresolution);
            //   alert(parseFloat(parseInt(sectionh) / 3) );
            // alert(parseInt($(this).height()));
            if (parseInt(sectionh) / 3 < parseInt($(this).height()) + 30)
            {
                var seperator2 = $(this).attr("data-sep2");
                var section2 = $(this).attr("data-sec2");

                $("#" + seperator2).addClass("hideseperator");
                $("#" + section2).addClass("pagebreakafter");

                //alert("1");
            }

            if (parseFloat(parseInt(sectionh) / 2) < parseInt($(this).height()))
            {
                var seperator1 = $(this).attr("data-sep1");
                //    var seperator2 = $(this).attr("data-sep2");
                var section1 = $(this).attr("data-sec1");
                //  var section2 = $(this).attr("data-sec2");

                $("#" + seperator1).addClass("hideseperator");
                //$("#" + seperator2).addClass("hideseperator");
                $("#" + section1).addClass("pagebreakafter");
                //$("#" + section2).addClass("pagebreakafter");
                //alert($("#receiptcontainer1").height());

                //alert("1");
            }
        });

    });

</script>
