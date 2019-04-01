<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */

$this->title = 'Propertyapplications';
?>

<div class="propertyapplication-search">
    <?php
    $form = ActiveForm::begin([
                'action' => Yii::$app->urlManager->baseUrl . "/index.php?r=property/application/propertyapplication/index",
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
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td>
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/reports/default/sizewisesales" class="ajaxlink">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Plotwise Summary
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
                $form->field($searchModel, 'property_size')->dropDownList(
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
                $form->field($searchModel, 'property_type')->dropDownList(
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
                $form->field($searchModel, 'property_against')->dropDownList(
                        array('1' => 'Against Land', '2' => 'On Cash', '3' => 'Installments'), ['prompt' => 'Against']    // options
                )
                ?>
            </td>
        </tr>
        <tr style="">
            <td>&nbsp;
            </td>

            <td>
                <?= $form->field($searchModel, 'application_no')->textInput()->label('Form No.') ?>
            </td>
        </tr>
        <tr style="">
            <td>&nbsp;
            </td>
            <td>
                <?=
                $form->field($searchModel, 'application_status')->dropDownList(
                        app\models\application\Propertyapplication::statuslist(), // Flat array ('id'=>'label')
                        ['prompt' => 'Select a Status']    // options
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
