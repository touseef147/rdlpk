<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "security", "title" => "Security Control Panel"],
            ["link" => "security/user", "title" => "Users"],
            ["link" => "", "title" => "Update User Information"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/user/sidebarinput">
                 <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput', 'enctype' => 'multipart/form-data']]);?>
               
                <div class="row">
                    <div class="col-xs-6">
                        <?= $form->field($model, 'person_name')->textInput() ?>
                    </div>
                    <div class="col-xs-6">
                        <?= $form->field($model, 'sodowo')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <?= $form->field($model, 'cnic')->textInput() ?>
                    </div>
                    <div class="col-xs-4">
                        <?= $form->field($model, 'mobile')->textInput() ?>
                    </div>
                    <div class="col-xs-4">
                        <?= $form->field($model, 'email')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <?= $form->field($model, 'address')->textInput() ?>
                    </div>
                    <div class="col-xs-3">
                        <?php
                        echo $form->field($model, 'role_id')
                                ->dropDownList(
                                        ArrayHelper::map(\app\models\application\Secroles::find()->all(), 'role_id', 'role_name'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select a Role']    // options
                        );
                        ?>
                    </div>
                    <div class="col-xs-3">
                        <?php
                        echo $form->field($model, 'role_type')
                                ->dropDownList(
                                        array('1' => 'Admin Account', '2' => 'User Account'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select Account Type']    // options
                        );
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <?= $form->field($model, 'state')->textInput() ?>
                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'zip')->textInput() ?>
                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'country')->textInput() ?>
                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'city')->textInput() ?>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Permissions: Projects</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row">
                                        <?php
                                        $serialno = -1;
                                        $cols = 0;
//$prows = $modelpcateg->getModels();

                                        foreach ($modelprojects as $arow) {
                                            $serialno++;
                                            $checked = "";
                                            $value = 0;

                                            if ($selectedproj != null) {
                                                foreach ($selectedproj as $sp) {
                                                    if ($arow->id == $sp->project_id) {
                                                        $value = $sp->project_id;
                                                        $checked = 'checked="checked"';
                                                    }
                                                }
                                            }
                                            ?>
                                            <div class="col-xs-6">
                                                <input type="checkbox" <?php echo $checked; ?> value="<?php echo $value; ?>" onclick="javascript: if (this.checked)
                                                                this.value = '<?php echo $arow->id; ?>';
                                                            else
                                                                this.value = '0';" name="project[<?php echo $serialno; ?>]" />
                                                <input type="hidden" value="<?php echo $arow->id; ?>" name="projectids[<?php echo $serialno; ?>]" />
                                                <?php echo $arow->project_name . "   "; ?>

                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Permissions: Sales Centers</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row">
                                        <?php
                                        $serialno = -1;
                                        $cols = 0;
//$prows = $modelpcateg->getModels();

                                        foreach ($modelcenters as $arow) {
                                            $serialno++;
                                            $checked = "";
                                            $value = 0;

                                            if ($selectedcenter) {
                                                foreach ($selectedcenter as $sp) {
                                                    if ($arow->id == $sp->center_id) {
                                                        $value = $sp->center_id;
                                                        $checked = 'checked="checked"';
                                                    }
                                                }
                                            }
                                            ?>
                                            <div class="col-xs-6">
                                                <input type="checkbox" <?php echo $checked; ?> value="<?php echo $value; ?>" onclick="javascript: if (this.checked)
                                                                this.value = '<?php echo $arow->id; ?>';
                                                            else
                                                                this.value = '0';" name="center[<?php echo $serialno; ?>]" />
                                                <input type="hidden" value="<?php echo $arow->id; ?>" name="centerids[<?php echo $serialno; ?>]" />
                                                <?php echo $arow->name . "   "; ?>

                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Printing</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row">
                                        <?= $form->field($model, 'printer_rosolution')->textInput() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
