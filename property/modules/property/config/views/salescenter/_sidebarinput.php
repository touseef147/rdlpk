<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Salescenters';
?>

<div class="salescenter-search">
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
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/config/salescenter/index" class="ajaxlink">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Show Summary
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</div>


