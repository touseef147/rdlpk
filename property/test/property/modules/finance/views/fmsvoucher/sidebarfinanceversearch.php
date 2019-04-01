<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */

$this->title = 'Fmsvouchers';
?>

<div class="fmsvoucher-search">
    <?php
    $form = ActiveForm::begin([
                'action' => Yii::$app->urlManager->baseUrl . "/index.php?r=finance/fmsvoucher/financeverification",
                'method' => 'GET',
                'class' => 'frmsearch',
                'id' => 'frmsearch',
    ]);
    ?>    <table width="100%" style="margin-top:10px;" class="sidebar_links_title_table">
<!--        <tr>
            <td style="width:10px; height:30px; background-color: white;" class="sibar_links_title_left_col">&nbsp;
            </td>
            <td style="background-color: white;" class="sibar_links_title_right_col">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> Related Pages </span>
            </td>
        </tr>-->
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
                <?=
                $form->field($searchModel, 'voucher_sr_no')->textInput()->label('Instrument No.')
                ?>
            </td>

        </tr>
        <tr style="">
            <td>&nbsp;
            </td>
            <td>
                <?=
                $form->field($searchModel, 'receiptno')->textInput()->label('Receipt No.')
                ?>
            </td>

        </tr>
        <tr style="">
            <td>&nbsp;
            </td>
            <td>
                <?=
                $form->field($searchModel, 'jvno')->textInput()->label('JV. No.')
                ?>
            </td>

        </tr>
        <tr style="">
            <td>&nbsp;
            </td>
            <td>
                <?=
                $form->field($searchModel, 'depositslipno')->textInput()->label('Deposit Slip No.')
                ?>
            </td>

        </tr>
        <tr style="">
            <td>&nbsp;
            </td>

            <td>
                <?=
                $form->field($searchModel, 'project_id')->dropDownList(
                        ArrayHelper::map(\app\models\application\Projectpermissions::myprojects(),"id","project_name"),
                        ['prompt' => 'All Projects']    // options
                )
                ?>
            </td>
        </tr>
        <tr style="">
            <td>&nbsp;
            </td>

            <td>
                <?=
                $form->field($searchModel, 'sales_center_id')->dropDownList(
                        ArrayHelper::map(\app\models\application\Centerspermissions::mycenters(),"id","name"),
                        ['prompt' => 'All Centers']    // options
                )
                ?>
            </td>
        </tr>
        <tr style="">
            <td>&nbsp;
            </td>
            <td>
                <div class="form-group pull-right">
<?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-sidebar-search']) ?>                </div>
            </td>
        </tr>
        <input type="hidden" id="pageno" name="pageno" value="0">
        <input type="hidden" id="pagesize" name="pagesize" value="20">
        <input type="hidden" id="sort" name="sort" value="">
    </table>
<?php ActiveForm::end(); ?></div>
