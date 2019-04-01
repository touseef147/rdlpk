<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Secmoduleactions';
?>

<div class="secmoduleactions-search">
    <?php
    $form = ActiveForm::begin([
                'action' => Yii::$app->urlManager->baseUrl . "/index.php?r=security/secmoduleactions/",
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
                    <?php
                    if (array_key_exists("security/secmoduleactions/create", $myrights)) {
                        ?>
                        <tr>
                            <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                            </td>
                            <td>
                                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secmoduleactions/create" class="ajaxlink">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Add New
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    if (array_key_exists("security/secmoduleactions/printsummary", $myrights)) {
                        ?>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td>
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secmoduleactions/printsummary" class="reportlink">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Print Summary
                            </a>
                        </td>
                    </tr>
                        <?php
                    }
                    if (array_key_exists("security/secmoduleactions/pdfsummary", $myrights)) {
                        ?>
                    <tr>
                        <td style="width:10px; height:30px;" class="sibar_links_content_left_col">&nbsp;
                        </td>
                        <td>
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secmoduleactions/pdfsummary">
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
                $form->field($searchModel, 'module_id')->dropDownList(
                        ArrayHelper::map(app\models\application\Secmodules::find()->orderBy('module_title ASC')->all(), 'module_id', 'module_title'), // Flat array ('id'=>'label')
                        [
                    'prompt' => 'Select a Module',
                    'onchange' => ' 
                            $.get( "' . Url::toRoute('/security/secmoduleactions/ddcontroller') . '", { id: $(this).val() } )
                                .done(function( data ) {
                                    $( "#' . Html::getInputId($searchModel, 'controller_id') . '" ).html( data );
                                }
                            );
                        '
                        ]    // options
                )->label('Module')
                ?>
            </td>
        </tr>
        <tr style="">
            <td>&nbsp;
            </td>

            <td>
                <?=
                $form->field($searchModel, 'controller_id')->dropDownList(
                        ArrayHelper::map(app\models\application\Seccontroller::find()->orderBy('controller_name ASC')->where(['module_id' => $searchModel->module_id])->all(), 'controller_id', 'controller_name'), // Flat array ('id'=>'label')
                        [
                    'prompt' => 'Select a Controller',
                        ]    // options
                )->label('Controller')
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
