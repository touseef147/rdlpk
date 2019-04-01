<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\Fmsvoucher */

$this->title = 'Update Instrument';
?>
<div class="fmsvoucher-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "finance", "title" => "Finance"],
            ["link" => "finance/fmsvoucher", "title" => "Instruments"],
            ["link" => "", "title" => Html::encode($this->title)],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/sidebarinput">

                <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->baseUrl . '/index.php?r=finance/fmsvoucher/' . ($model->isNewRecord ? 'createinstrument' : 'updateinstrument&id=' . $model->voucher_id), 'options' => ['class' => 'frminput']]); ?>

                <?= ""//Html::errorSummary($model)  ?>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Member Detail</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <?= $form->field($model, 'member_id')->hiddenInput()->label(FALSE) ?>
                                    <?= $form->field($model, 'person_name')->hiddenInput()->label(FALSE) ?>
                                    <?php
                                    if($model->member_id != null && $model->member_id != 0)
                                    {
                                    ?>
                                    <?=
                                    $this->renderFile(
                                            Yii::getAlias("@app") . '/modules/members/views/members/showrecord.php', [
                                        'model' => \app\models\application\Members::find()->where(['id' => $model->member_id])->one()
                                    ]);
                                    ?>                                    
                                    <?php
                                    } else{
                                        echo $model->person_name;
                                     ?>
                                    
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
                                    $form->field($model, 'amount_type')->dropDownList(['2' => 'Cheque', '1' => 'Cash', '3' => 'PO', '4' => 'Online Deposit'], ['onchange' => ''
                                        . 'if($(this).val()==1) $("#bank_row").hide(); else $("#bank_row").show(); '
                                        . 'if($(this).val()==2) { $(".transdate label").text("Cheque Date"); $(".transno label").text("Cheque No."); } '
                                        . 'if($(this).val()==3) { $(".transdate label").text("PO. Date"); $(".transno label").text("PO. No."); } '
                                        . ''])->label(false)
                                    ?>
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <?php
                                            echo $form->field($model, 'project_id')
                                                    ->dropDownList(
                                                            ArrayHelper::map(\app\models\application\Projects::find()->joinWith("permissions")->orderBy("projects.project_name")->where(['project_permissions.user_id' => Yii::$app->user->identity->id])->all(), 'id', 'project_name'), // Flat array ('id'=>'label')
                                                            [
                                                        'prompt' => 'Select Project',
                                                            ]    // options
                                            );
                                            ?>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <?php
                                            echo $form->field($model, 'sales_center_id')
                                                    ->dropDownList(
                                                            ArrayHelper::map(\app\models\application\Salescenter::find()->joinWith("permissions")->orderBy("sales_center.name")->where(['centers_permissions.user_id' => Yii::$app->user->identity->id])->all(), 'id', 'name'), // Flat array ('id'=>'label')
                                                            ['prompt' => 'Select Center']  // options
                                            );
                                            ?>

                                        </div>
                                        <div class="col-xs-4">
                                            <?= $form->field($model, 'entry_date')->textInput(['class' => 'date-picker']) ?>

                                        </div>
                                    </div>
                                    <div class="row <?php if ($model->amount_type != 2) echo "hidecontent"; ?>" id="bank_row">
                                        <div class="col-xs-4">
                                            <?php
                                            echo $form->field($model, 'bank_id')
                                                    ->dropDownList(
                                                            ArrayHelper::map(\app\models\application\Fmsbanks::find()->orderBy("bank_title")->all(), 'bank_id', 'bank_title'), // Flat array ('id'=>'label')
                                                            ['prompt' => 'Select Bank']  // options
                                            );
                                            ?>

                                        </div>
                                        <div class="col-xs-4 transdate">
                                            <?= $form->field($model, 'transaction_date')->textInput(['class' => 'date-picker']) ?>

                                        </div>
                                        <div class="col-xs-4 transno">
                                            <?= $form->field($model, 'voucher_sr_no')->textInput(['maxlength' => true]) ?>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4 amountfield <?php if ($model->amount_type == 5) echo "hidecontent"; ?>">
                                            <?= $form->field($model, 'amount')->textInput()->label('Instrument Amount') ?>

                                        </div>
                                        <div class="narrationfield <?php
                                            if ($model->amount_type == 5)
                                                echo "col-xs-12";
                                            else
                                                echo "col-xs-8";
                                            ?>">
                                                 <?= $form->field($model, 'narration')->textInput() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group pull-right">
                            <?= Html::submitInput($model->isNewRecord ? 'Create' : 'Update', ['name' => 'submit', 'class' => $model->isNewRecord ? 'btn btn-success multiplesubmitbuttons' : 'btn btn-primary btn-round multiplesubmitbuttons']) ?>&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
