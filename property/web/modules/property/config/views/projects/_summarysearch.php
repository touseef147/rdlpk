<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Projects';
?>

<div class="projects-search">
    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->urlManager->baseUrl."/index.php?r=property/config/projects/",
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
                        <?php
                        if (array_key_exists("property/config/projects/create", $myrights)) {
                            ?>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td>
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/projects/create" class="ajaxlink">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Add New
                                </a>
                        </td>
                    </tr>
                            <?php
                        }
                        ?>
                        <?php
                        if (array_key_exists("property/config/projects/printsummary", $myrights)) {
                            ?>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td>
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/projects/printsummary" class="reportlink">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Print Summary
                                </a>
                        </td>
                    </tr>
                            <?php
                        }
                        ?>
                        <?php
                        if (array_key_exists("property/config/projects/pdfsummary", $myrights)) {
                            ?>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td>
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/projects/pdfsummary">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Print Summary (pdf)
                                </a>
                        </td>
                    </tr>
                            <?php
                        }
                        ?>
                </table>
            </td>
        </tr>
        <input type="hidden" id="pageno" name="pageno" value="0">
        <input type="hidden" id="pagesize" name="pagesize" value="20">
        <input type="hidden" id="sort" name="sort" value="">
    </table>
  <?php ActiveForm::end(); ?>    
</div>
