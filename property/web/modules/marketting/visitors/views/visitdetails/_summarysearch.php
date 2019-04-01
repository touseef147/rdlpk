<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Visitdetails';
?>

<div class="visitdetails-search">
    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->urlManager->baseUrl."/index.php?r=visits/visitdetails/",
        'method' => 'GET',
        'class' => 'frmsearch',
        'id' => 'frmsearch',
    ]); ?>
    <table width="100%" style="margin-top:10px;" class="sidebar_links_title_table">
        <tr>
            <td style="width:10px; height:30px; background-color: white;" class="sibar_links_title_left_col">&nbsp;
            </td>
            <td style="background-color: white;" class="sibar_links_title_right_col">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> Related Pages </span>
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
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitdetails/create" class="ajaxlink">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Add New
                                </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td>
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitdetails/printsummary" class="reportlink">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Print Summary
                                </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td>
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitdetails/pdfsummary">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Print Summary (pdf)
                                </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width:10px; height:30px; background-color: white;" class="sibar_links_title_left_col">&nbsp;
            </td>
            <td style="background-color: white;" class="sibar_links_title_right_col">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> Search </span>
            </td>
        </tr>
        <tr style="">
            <td>&nbsp;
            </td>
          
             <td>
                <?php
                echo $form->field($searchModel, 'followup_status')
                        ->dropDownList(
                                array('0'=>'Pending', '1'=>'Completed', '2' => 'Cancelled', '1' => 'Closed', '3' => 'Will Visit/Call Again'), // Flat array ('id'=>'label')
                                ['prompt' => 'Select Status']    // options
                );
                ?>
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
                <span class="menu-text"> Search (Date Criteria) </span>
            </td>
        </tr>
        <tr style="">
            <td><input type="radio" class="datacriteria" name="VisitdetailssSearch[datecriteria]" value="1" <?= ($searchModel->datecriteria == 1 ? 'checked="checked"' : '') ?>>
            </td>
            <td>
                &nbsp;Overall
            </td>
          
        </tr>
        <tr style="">
            <td><input type="radio" class="datacriteria" name="VisitdetailssSearch[datecriteria]" value="2" <?= ($searchModel->datecriteria == 2 || $searchModel->datecriteria == null ? 'checked="checked"' : '') ?> >
            </td>
            <td>
                &nbsp;Today
            </td>
          
        </tr>
        <tr style="">
            <td><input type="radio" class="datacriteria" name="VisitdetailssSearch[datecriteria]" value="3" <?= ($searchModel->datecriteria == 3 ? 'checked="checked"' : '') ?>>
            </td>
            <td>
                &nbsp;Date Range
            </td>
          
        </tr>
        <tr style="" class="daterange">
            <td>&nbsp;
            </td>
            <td>
                <?= $form->field($searchModel, 'fromdate')->textInput(['class'=>'date-picker'])->label('From Date') ?>
            </td>
          
        </tr>
        <tr style="" class="daterange">
            <td>&nbsp;
            </td>
          
             <td>
                <?= $form->field($searchModel, 'todate')->textInput(['class'=>'date-picker'])->label('To Date') ?>
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
        <input type="hidden" id="pageno" name="pageno" value="0">
        <input type="hidden" id="pagesize" name="pagesize" value="20">
        <input type="hidden" id="sort" name="sort" value="">
    </table>
    <?php ActiveForm::end(); ?>
</div>
