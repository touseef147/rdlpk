<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\application\Secrolecategory;
use app\models\application\Secroletypes;

/* @var $this yii\web\View */
/* @var $model app\models\application\Secroles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="secroles-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "security", "title" => "Security"],
            ["link" => "security/secroles/index", "title" => "Roles"],
            ["link" => "", "title" => "Update"]
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secroles/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>

                <div class="row">
                    <div class="col-xs-8">
                        <?php
                        echo $form->field($model, 'sec_role_type_id')
                                ->dropDownList(
                                        ArrayHelper::map(Secroletypes::find()->orderBy('role_type_name ASC')->all(), 'role_type_id', 'role_type_name'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select a Role Type']    // options
                        );
                        ?>
                    </div>
                    <div class="col-xs-4">

                        <?php
                        echo $form->field($model, 'sec_role_category_id')
                                ->dropDownList(
                                        ArrayHelper::map(Secrolecategory::find()->all(), 'role_category_id', 'role_category_name'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select a Role Category']    // options
                        );
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8">

                        <?= $form->field($model, 'role_name')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-xs-4">

                        <?= $form->field($model, 'role_so')->textInput() ?>
                    </div>
                </div>

                <?php
                if ($model->isNewRecord == FALSE) {
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="widget-box">
                                <div class="widget-header widget-header-small">
                                    <h6 class="widget-title bigger"><i class="icon-th-large"></i> Rights</h6>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main no-padding">
                                        <div class="tabbable tabs-left">
                                            <ul class="nav nav-tabs" id="myTab3">
                                                <?php
                                                $no = -1;

                                                $modulerows = $modules->getModels();
                                                $crows = $controllers->getModels();
                                                $arows = $actions->getModels();
                                                $rrows = $rights->getModels();
//print_r($trows);
                                                foreach ($modulerows as $row) {
                                                    $no++;
                                                    ?>
                                                    <li class="<?php if ($no == 0) echo "active"; ?>"><a data-toggle="tab" href="#module<?php echo $row->module_id; ?>"> <?php echo $row->module_title ?></a></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                            <div class="tab-content">
                                                <?php
                                                $no = -1;
                                                $serialno = -1;

                                                foreach ($modulerows as $row) {
                                                    $no++;
                                                    ?>
                                                    <div id="<?php echo "module" . $row->module_id ?>" class="tab-pane <?php if ($no == 0) echo "active"; ?>">
                                                        <?php
                                                        foreach ($crows as $crow) {
                                                            if ($crow->module_id == $row->module_id) {
                                                                ?>
                                                                <div class="widget-box ui-sortable-handle" id="widget-box-<?php echo $crow->controller_id; ?>">
                                                                    <div class="widget-header">
                                                                        <h6 class="widget-title"><?php echo $crow->controller_name; ?></h6>
                                                                    </div>

                                                                    <div class="widget-body">
                                                                        <div class="widget-main">
                                                                            <?php
                                                                            $acount = -1;
                                                                            $opened = 0;

                                                                            foreach ($arows as $arow) {
                                                                                if ($arow->controller_id == $crow->controller_id) {
                                                                                    $acount++;
                                                                                    $serialno++;

                                                                                    $found = FALSE;
                                                                                    $defaultvalue = 0;
                                                                                    $checked = "";

                                                                                    foreach ($rrows as $rrow) {
                                                                                        if ($rrow->action_id == $arow->action_id) {
                                                                                            $found = TRUE;
                                                                                            $checked = "checked";
                                                                                            $defaultvalue = $rrow->action_id;
                                                                                        }
                                                                                    }

                                                                                    if ($acount % 3 == 0 && $opened > 0) {
                                                                                        $opened = 0;
                                                                                        echo '</div>';
                                                                                    }

                                                                                    if ($acount % 3 == 0) {
                                                                                        $opened = 1;
                                                                                        echo '<div class="row">';
                                                                                    }
                                                                                    ?>
                                                                                    <div class="col-md-4">
                                                                                        <span style="padding:15px 10px;">
                                                                                            <input type="checkbox" value="<?php echo $defaultvalue; ?>" onclick="javascript: if (this.checked)
                                                                                                                                this.value = '<?php echo $arow->action_id; ?>';
                                                                                                                            else
                                                                                                                                this.value = '0';" name="screen[<?php echo $serialno; ?>]" <?php echo $checked; ?> />
                                                                                            <input type="hidden" value="<?php echo $arow->action_id; ?>" name="screenids[<?php echo $serialno; ?>]" />
                                                                                            <?php echo $arow->action_title . "   "; ?>
                                                                                        </span>
                                                                                    </div>
                                                                                    <?php
                                                                                }
                                                                            }

                                                                            if ($opened != 0)
                                                                                echo '</div>';
                                                                            ?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>                        
                                    </div>
                                    <!--widget-main-->
                                </div>
                                <!--widget-body-->
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
