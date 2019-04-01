<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */

$this->title = 'Visitors';
?>

<div class="dailyvisitors-search">
    <?php
    $form = ActiveForm::begin([
                'action' => Yii::$app->urlManager->baseUrl . "/index.php?r=visits/visitorsreports/followup/",
                'method' => 'GET',
                'class' => 'frmsearch',
                'id' => 'frmsearch',
    ]);
    ?>
    <table width="100%" style="margin-top:10px;" class="sidebar_links_title_table">
        <tr>
            <td style="width:10px; height:30px; background-color: white;" class="sibar_links_title_left_col">&nbsp;
            </td>
            <td style="background-color: white;" class="sibar_links_title_right_col">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text bolder"> Search </span>
            </td>
        </tr>
        <tr style="">
            <td>&nbsp;
            </td>
            <td>
                <div class="form-group">
                    <?php
                    echo $form->field($searchModel, 'center')
                            ->dropDownList(
                                    ArrayHelper::map(\app\models\application\Salescenter::find()->joinWith("permissions")->orderBy("sales_center.name")->where(['centers_permissions.user_id' => $_SESSION["user_array"]["id"]])->all(), 'id', 'name'), // Flat array ('id'=>'label')
                                    ['prompt' => 'Select Center']  // options
                    )->label("Sales Center");
                    ?>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:10px; height:30px; background-color: white;" class="sibar_links_title_left_col">&nbsp;
            </td>
            <td style="background-color: white;" class="sibar_links_title_right_col">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text bolder"> Search (Date Criteria) </span>
            </td>
        </tr>
        <tr style="">
            <td>&nbsp;
            </td>
            <td>
                <div class="form-group">
                    <?= $form->field($searchModel, 'fromdate')->textInput(['class' => 'date-picker'])->label('From') ?>
                </div>
            </td>
        </tr>
        <tr style="">
            <td>&nbsp;
            </td>
            <td>
                <div class="form-group">
                    <?= $form->field($searchModel, 'todate')->textInput(['class' => 'date-picker'])->label('Upto') ?>
                </div>
            </td>
        </tr>
        <tr style="">
            <td>&nbsp;
            </td>
            <td>
                <div class="form-group pull-right">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-sidebar-search']) ?>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:10px; height:30px; background-color: white;" class="sibar_links_title_left_col">&nbsp;
            </td>
            <td style="background-color: white;" class="sibar_links_title_right_col">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text bolder"> Related Pages </span>
            </td>
        </tr>
        <tr style="">
            <td>&nbsp;
            </td>
            <td>
                <table>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td>
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/overall/" class="ajaxlink">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Overall Reports
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td>
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/default/" class="ajaxlink">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Visitors Reports
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td>
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/booking/" class="ajaxlink">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Interest/Booking Reports
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td>
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/followup/" class="ajaxlink">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Followup Reports
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td>
                            <strong class="gray lighter">PROGRESS REPORTS</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td style="padding-left: 15px;">
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/daily/" class="ajaxlink">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Daily
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td style="padding-left: 15px;">
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/monthly/" class="ajaxlink">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Monthly
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td style="padding-left: 15px;">
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/annual/" class="ajaxlink">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Annual
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <input type="hidden" id="page" name="page" value="">
        <input type="hidden" id="pageno" name="pageno" value="0">
        <input type="hidden" id="pagesize" name="pagesize" value="20">
        <input type="hidden" id="sort" name="sort" value="">
    </table>
    <?php ActiveForm::end(); ?>
</div>
