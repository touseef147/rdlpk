<?php

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\application\Country;
use yii\helpers\Html;

$myoptions = array();

if (isset($options) && $options != null)
    $myoptions = $options;

if (!isset($myoptions['layout']) || $myoptions['layout'] == NULL) {
    $myoptions['layout'] = "vertical";
}
if (!isset($myoptions['size']) || $myoptions['size'] == NULL) {
    $myoptions['size'] = "small";
}
if (!isset($myoptions['title']) || $myoptions['title'] == NULL) {
    $myoptions['title'] = "";
}

if ($myoptions["title"] != "") {
    ?>

    <div class="padding-8" style="padding: 8px 8px;">
        <h3 class="row header smaller lighter blue">
            <span class="col-sm-7">
                <i class="ace-icon fa fa-th-large"></i>
                <?php echo $myoptions["title"]; ?>
            </span><!-- /.col -->

        </h3>
        <?php
    }
    ?>

    <table style="width: 100%;">
        <tr>
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                Name
            </td>
            <td style="border-bottom: dotted">
                <?php echo $model->name; ?>
            </td>
        </tr>
        <tr>
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                <?php echo $model->relationname ?>
            </td>
            <td style="border-bottom: dotted">
                <?php echo $model->sodowo; ?>
            </td>
        </tr>
        <tr>
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                CNIC
            </td>
            <td style="border-bottom: dotted">
                <?php echo $model->cnic; ?>
            </td>
        </tr>
    </table>

    <?php
    if ($myoptions["title"] != "") {
        ?>
    </div>
    <?php
}
?>