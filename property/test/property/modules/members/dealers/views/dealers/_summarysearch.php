<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'Dealers';
?>

<div class="members-search">
    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->urlManager->baseUrl."/index.php?r=members/dealers/dealers/index",
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
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/reports/default/overallsales" class="ajaxlink">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Dealerwise Summary
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
                <?= $form->field($searchModel, 'name')->textInput()->label('Member Name') ?>
                <?= $form->field($searchModel, 'cnic')->textInput() ?>
               <?php
                    echo $form->field($searchModel, 'status')
                   ->dropDownList(
                   array('1' => 'Active', '0' => 'Inactive'), // Flat array ('id'=>'label')
                   ['prompt' => 'Select Type']    // options
                   )->label(false);
                                                            ?>
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
        <input type="hidden" id="pageno" name="pageno" value="0">
        <input type="hidden" id="pagesize" name="pagesize" value="20">
        <input type="hidden" id="sort" name="sort" value="">
    </table>
  <?php ActiveForm::end(); ?>  
</div>
