<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\Fmstransdetaildist */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Verify Instrument';
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

                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Project</td>
                        <td style="border-bottom: dotted"><?= $model->project->project_name ?></td>
                        <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Sales Center</td>
                        <td style="border-bottom: dotted"><?= $model->salescenter->name ?></td>
                    </tr>
                </table>
                <br />
                <div class="row">
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Dealer Detail</h6>
                                <div class="widget-toolbar no-border red">
                                    <?= $modelmember->dealers_business_title ?>
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Name</td>
                                            <td style="border-bottom: dotted"><?= $modelmember->name ?></td>
                                            <td rowspan="5" style="width: 100px; padding: 3px;"><img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/uploads/members/pictures/<?php echo $modelmember->image; ?>?<?php echo date('H-i-s'); ?>" height="100"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Group</td>
                                            <td style="border-bottom: dotted"><?= "" ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">CNIC</td>
                                            <td style="border-bottom: dotted"><?= $modelmember->cnic ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Contact No.</td>
                                            <td style="border-bottom: dotted"><?= $modelmember->phone ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Instrument Detail</h6>
                                <div class="widget-toolbar no-border red">
                                    <?= $model->transtypetitle ?>
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Date</td>
                                            <td style="border-bottom: dotted"><?= $model->trans_date ?></td>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Amount</td>
                                            <td style="border-bottom: dotted; font-weight: bold; color: red; text-align: right; font-size: larger;"><?= (is_array($modeldetail) == TRUE ? number_format($modeldetail[0]->cr_amount) : number_format($modeldetail->cr_amount)) ?></td>
                                        </tr>
                                        <?php
                                        if ($model->trans_type == 2) {
                                            ?>
                                            <tr>
                                                <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Bank</td>
                                                <td style="border-bottom: dotted" colspan="3"><?= (is_array($modeldetail) == TRUE ? $modeldetail[0]->bank->bank_title : $modeldetail->bank->bank_title) ?></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Cheque No.</td>
                                                <td style="border-bottom: dotted"><?= (is_array($modeldetail) == TRUE ? $modeldetail[0]->bank_trans_no : $modeldetail->bank_trans_no) ?></td>
                                                <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Cheque Date.</td>
                                                <td style="border-bottom: dotted"><?= (is_array($modeldetail) == TRUE ? $modeldetail[0]->bank_trans_date : $modeldetail->bank_trans_date) ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td style="text-align: right; width: 110px; padding-right: 5px; height: 25px;">Remarks</td>
                                            <td style="border-bottom: dotted" colspan="3" >
                                                <?= $model->remarks ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-signal"></i>
                            Verification
                        </h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-4">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="widget-box widget-color-blue3" id="widget-box-7">
                                        <div class="widget-header widget-header-small">
                                            <h6 class="widget-title smaller">Submission Details</h6>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <table style="width: 100%;" >
                                                    <tr>
                                                        <td style="width: 80px; height: 30px;">
                                                            Date
                                                        </td>
                                                        <td style="border-bottom: dotted;">
                                                            <?php echo $model->deposit_date; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style=" height: 30px;">
                                                            Bank
                                                        </td>
                                                        <td style="border-bottom: dotted;">
                                                            <?php echo ($model->targetbank == null ? "" : $model->targetbank->bank_title); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: top;">
                                                            Remarks
                                                        </td>
                                                        <td style="height: 83px; vertical-align: top;">
                                                            <?php echo $model->depsit_remarks ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                        
                                <div class="col-xs-6">
                                    <div class="widget-box widget-color-blue3" id="widget-box-7">
                                        <div class="widget-header widget-header-small">
                                            <h6 class="widget-title smaller">Verification Details</h6>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <?php
                                                        echo $form->field($model, 'verification_remarks')->textarea()->label('Remarks');
                                                        ?>

                                                    </div>                                                            </div>
                                            </div>
                                        </div>
                                        <div class="widget-toolbox padding-8 clearfix">

                                            <button class="btn btn-xs btn-success pull-right multiplesubmitbuttons" type="submit" name="submit" value="verify">
                                                <span class="bigger-110">Verify</span>

                                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                            </button>
                                        </div>                                                
                                    </div>
                                </div>                                        
                            </div>                    
                        </div>

                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

</div>
