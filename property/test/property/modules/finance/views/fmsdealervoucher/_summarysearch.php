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
                'action' => Yii::$app->urlManager->baseUrl . "/index.php?r=finance/fmsdealervoucher/index",
                'method' => 'GET',
                'class' => 'frmsearch',
                'id' => 'frmsearch',
    ]);
    ?>    <table width="100%" style="margin-top:10px;" class="sidebar_links_title_table">
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
                    <?php if (array_key_exists("finance/fmsdealervoucher/create", $myrights)) {
                        ?>                    <tr>
                            <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                            </td>
                            <td>
                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/findmember" class="ajaxlink">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Add New
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    if (array_key_exists("finance/fmsdealervoucher/printsummary", $myrights)) {
                        ?>                    <tr>
                            <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                            </td>
                            <td>
                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/printsummary" class="reportlink">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Print Summary
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    if (array_key_exists("finance/fmsdealervoucher/pdfsummary", $myrights)) {
                        ?>                    <tr>
                            <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                            </td>
                            <td>
                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/pdfsummary">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Print Summary (pdf)
                                </a>
                            </td>
                        </tr>
                    <?php }
                    ?>                </table>
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
                <?=
                $form->field($searchModel, 'formno')->textInput()->label('Form No.')
                ?>
            </td>

        </tr>
        <tr style="">
            <td>&nbsp;
            </td>
            <td>
                <?=
                $form->field($searchModel, 'msno')->textInput()->label('Ms. No.')
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
                <?=
                $form->field($searchModel, 'member_id')->dropDownList(
                yii\helpers\ArrayHelper::map(app\models\application\Members::find()->where(['is_dealer'=>1])->all(),'id','dealers_business_title'), // Flat array ('id'=>'label')
                        ['prompt' => 'Select a Dealer']    // options
                   )->label("Dealer");
                ?>
            </td>
        </tr>
        <tr style="">
            <td>&nbsp;
            </td>

            <td>
                <?=
                $form->field($searchModel, 'entry_status')->dropDownList(
                \app\models\application\Fmsvoucher::statuslist(),
                        ['prompt' => 'All Records']    // options
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
