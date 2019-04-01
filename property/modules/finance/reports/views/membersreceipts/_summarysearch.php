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
                'action' => Yii::$app->urlManager->baseUrl . "/index.php?r=visits/visitorsreports/salescenters",
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
                            <a href="#" class="ajaxlink">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Sales Centerwise Summary
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td>
                            <a href="#" class="ajaxlink">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Projectwise Summary
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td>
                            <a href="#" class="ajaxlink">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Plot Sizewise Summary
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
                /*echo $form->field($searchModel, 'center')
                        ->dropDownList(
                                ArrayHelper::map(\app\models\application\Salescenter::find()->all(), 'id', 'name'), // Flat array ('id'=>'label')
                                ['prompt' => 'Select a Sales Center']    // options
                );*/
                ?>
            </td>

        </tr>
          <tr style="">
            <td>&nbsp;
            </td>
            <td>
                <?= $form->field($searchModel, 'date')->textInput()->label('From Date') ?>
            </td>
          
        </tr>
        <tr style="">
            <td>&nbsp;
            </td>
            <td>
                <div class="form-group pull-right">
<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
                </div>
            </td>
        </tr>
    </table>
<?php ActiveForm::end(); ?>
</div>
