<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */

$this->title = 'Installmentplanmasters';
?>

<div class="installmentplanmaster-search">
    <?php
    $form = ActiveForm::begin([
                'action' => Yii::$app->urlManager->baseUrl . "/index.php?r=finance/installmentplanmaster/index",
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
                    <?php if (array_key_exists("finance/installmentplanmaster/create", $myrights)) {
                        ?>                    <tr>
                            <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                            </td>
                            <td>
                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installmentplanmaster/create" class="ajaxlink">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Add New
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    if (array_key_exists("finance/installmentplanmaster/printsummary", $myrights)) {
                        ?>                    <tr>
                            <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                            </td>
                            <td>
                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installmentplanmaster/printsummary" class="reportlink">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Print Summary
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    if (array_key_exists("finance/installmentplanmaster/pdfsummary", $myrights)) {
                        ?>                    <tr>
                            <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                            </td>
                            <td>
                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installmentplanmaster/pdfsummary">
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
                $form->field($searchModel, 'project_id')->dropDownList(
                        ArrayHelper::map(app\models\application\Projects::find()->all(), 'id', 'project_name'), // Flat array ('id'=>'label')
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
                $form->field($searchModel, 'category_id')->dropDownList(
                        ArrayHelper::map(app\models\application\Sizecat::find()->all(), 'id', 'size'), // Flat array ('id'=>'label')
                        ['prompt' => 'All Plot Sizes']    // options
                )
                ?>
            </td>
        </tr>
        <tr style="">
            <td>&nbsp;
            </td>

            <td>
<?=
$form->field($searchModel, 'plan_land_type')->dropDownList(
        array('1' => 'Residential', '2' => 'Commercial'), ['prompt' => 'All Land Types']    // options
)
?>
            </td>
        </tr>
        <tr style="">
            <td>&nbsp;
            </td>

            <td>
<?=
$form->field($searchModel, 'plan_development_type')->dropDownList(
        array('1' => 'Land', '2' => 'Development', '3' => 'Common'), ['prompt' => 'All Plan Types']    // options
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
