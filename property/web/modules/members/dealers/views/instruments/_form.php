<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\Fmstransdetaildist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fmstransdetaildist-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "members/dealers/default/index", "title" => "Dealers Control Panel"],
            ["link" => "members/dealers/instruments/index", "title" => "Instruments"],
            ["link" => "", "title" => Html::encode($this->title)],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/instruments/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>
                <?= $form->field((is_array($modeldetail) == TRUE ? $modeldetail[0] : $modeldetail), '[0]distribution_id')->hiddenInput()->label(false) ?>

                <div class="row">
                    <div class="col-xs-6">
                        <?php
                        echo $form->field($model, 'project_id')
                                ->dropDownList(
                                        ArrayHelper::map(\app\models\application\Projects::find()->joinWith("permissions")->orderBy("projects.project_name")->where(['project_permissions.user_id' => Yii::$app->user->identity->id])->all(), 'id', 'project_name'), ['prompt' => 'Select Project']  // options
                        );
                        ?>

                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $form->field($model, 'sales_center_id')
                                ->dropDownList(
                                        ArrayHelper::map(\app\models\application\Salescenter::find()->joinWith("permissions")->orderBy("sales_center.name")->where(['centers_permissions.user_id' => Yii::$app->user->identity->id])->all(), 'id', 'name'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select Center']  // options
                        );
                        ?>

                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Member Detail</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <?php
                                    if ($modelmember->id == 0) {
                                        ?>
                                        <div 
                                            id="memberdetail"
                                            class="subpage_wizard" 
                                            data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/findrecord&titles=false&target=showdetail&membertype=2"
                                            data-targetdiv="memberdetail" 
                                            data-listcontainer="memberdetail" 
                                            data-allowaction="no" 
                                            data-compurl1=""
                                            data-listurl=""
                                            > 
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="lazycontent"  data-url="<?php echo Yii::$app->urlManager->baseUrl . "/index.php?r=members/members/showdetail&id=" . $modelmember->id ?>">
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-medium">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Instrument Detail</h6>
                                <div class="widget-toolbar">
                                    <?=
                                    $form->field($model, 'trans_type')->dropDownList(['2' => 'Cheque', '1' => 'Cash'], ['onchange' => ''
                                        . 'if($(this).val()==1) $("#bank_row").hide(); else $("#bank_row").show(); '
                                        . ''])->label(false)
                                    ?>
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <?= $form->field((is_array($modeldetail) == TRUE ? $modeldetail[0] : $modeldetail), '[0]dr_amount')->textInput()->label('Amount') ?>

                                        </div>
                                        <div class="col-xs-4">
                                            <?= ""//$form->field($$modeldetail, 'remarks')->textInput()  ?>
                                        </div>
                                        <div class="col-xs-4">
                                            <?= $form->field($model, 'trans_date')->textInput(['class' => 'date-picker']) ?>

                                        </div>
                                    </div>
                                    <div class="row" id="bank_row">
                                        <div class="col-xs-4">
                                            <?php
                                            echo $form->field((is_array($modeldetail) == TRUE ? $modeldetail[0] : $modeldetail), '[0]bank_id')
                                                    ->dropDownList(
                                                            ArrayHelper::map(\app\models\application\Fmsbanks::find()->orderBy("bank_title")->all(), 'bank_id', 'bank_title'), // Flat array ('id'=>'label')
                                                            ['prompt' => 'Select Bank']  // options
                                            );
                                            ?>

                                        </div>
                                        <div class="col-xs-4">
                                            <?= $form->field((is_array($modeldetail) == TRUE ? $modeldetail[0] : $modeldetail), '[0]bank_trans_date')->textInput(['class' => 'date-picker']) ?>

                                        </div>
                                        <div class="col-xs-4">
                                            <?= $form->field((is_array($modeldetail) == TRUE ? $modeldetail[0] : $modeldetail), '[0]bank_trans_no')->textInput(['maxlength' => true]) ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?= $form->field($model, 'remarks')->textInput(['maxlength' => true, 'style'=>'width:100%']) ?>
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
