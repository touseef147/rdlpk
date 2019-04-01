<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\application\Fmsvoucher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fmsvoucher-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "finance", "title" => "Finance"],
            ["link" => "finance/fmsvoucher/centerverification", "title" => "Instruments"],
            ["link" => "", "title" => "Instrument Detail"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= ""//\app\components\Pageheader::widget(["title" => "Instrument Detail", "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>

                <?= ""//Html::errorSummary($model) ?>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-medium">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Instrument Detail</h6>
                                <div class="widget-toolbar">
                                    <?= "Payment Mode: " . $model->amounttypetitle
                                    ?>
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Project</td>
                                            <td style="border-bottom: dotted" colspan="3"><?php echo $model->project->project_name; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Sales Center</td>
                                            <td style="border-bottom: dotted" colspan="3"><?php echo $model->salescenter->name; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Amount</td>
                                            <td style="border-bottom: dotted"><?php echo number_format($model->amount); ?></td>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Date</td>
                                            <td style="border-bottom: dotted"><?php echo $model->showentrydate; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Narration</td>
                                            <td style="border-bottom: dotted" colspan="3"><?php echo $model->narration; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Member Detail</h6>

                                <div class="widget-toolbar">
                                    <div class="red lazycontent" id="dealerledgerbalance" data-url="<?php echo Yii::$app->urlManager->baseUrl . "/index.php?r=members/dealers/ledger/showbalance&id=" . $modelmember->id . "&type=Dealer" ?>"></div>
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <?php $model->member_id = $modelmember->id; ?>
                                    <?= $form->field($model, 'member_id')->hiddenInput()->label(FALSE) ?>
                                    <?=
                                    $this->renderFile(
                                            Yii::getAlias("@app") . '\modules\members\views\members\showrecord.php', [
                                        'model' => $modelmember
                                    ]);
                                    ?>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">

                        <div class="widget-box" id="widget-box-7">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title smaller">Receipts</h6>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main no-padding">
                                    <table id="receipt-list" class="table  table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Receipt No</th>
                                                <th>File/Plot No</th>
                                                <th>Bank</th>
                                                <th>Deposit Slip No.</th>
                                                <th>Deposit Date</th>
                                                <th>Clearance Date</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = -1;
                                            if ($modelreceipts != NULL) {
                                                foreach ($modelreceipts as $row) {
                                                    $count++;
                                                    ?>
                                                    <tr>
                                                        <td align="left">
                                                            <?=
                                                            Html::hiddenInput('Fmsvoucherplotdetail[' . $count . '][voucher_plot_detail_id]', $row->voucher_plot_detail_id, ['id' => 'Fmsvoucherplotdetail_' . $count . '_voucher_plot_detail_id'])
                                                            ?>
                                                            <?= $row->receipt_no ?>
                                                        </td>
                                                        <td align="left"><?= $row->plot->completecode ?></td>
                                                        <td align="left">
                                                            <?=
                                                            Html::dropDownList('Fmsvoucherplotdetail[' . $count . '][target_bank_id]', $row->target_bank_id, ArrayHelper::map(\app\models\application\Fmsbanks::find()->orderBy("bank_title")->all(), 'bank_id', 'bank_title'), [
                                                                'prompt' => '---',
                                                                'id' => 'Fmsvoucherplotdetail' . $count . '_target_bank_id',
                                                            ])
                                                            ?>
                                                        </td>
                                                        <td align="left">
                                                            <?=
                                                            Html::textInput('Fmsvoucherplotdetail[' . $count . '][deposit_slip_no]', $row->deposit_slip_no, ['id' => 'Fmsvoucherplotdetail_' . $count . '_deposit_slip_no'])
                                                            ?>
                                                        </td>
                                                        <td align="left">
                                                            <?=
                                                            Html::textInput('Fmsvoucherplotdetail[' . $count . '][deposit_date]', $row->deposit_date, ['id' => 'Fmsvoucherplotdetail_' . $count . '_deposit_date', 'class' => 'date-picker'])
                                                            ?>
                                                        </td>
                                                        <td align="left">
                                                            <?=
                                                            Html::textInput('Fmsvoucherplotdetail[' . $count . '][clearance_date]', $row->clearance_date, ['id' => 'Fmsvoucherplotdetail_' . $count . '_clearance_date', 'class' => 'date-picker'])
                                                            ?>
                                                        </td>
                                                        <td align="left">
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                                        
                    </div>
                </div>



                <div class="row">
                    <div class="col-xs-12">
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
                                        <div class="col-xs-12">
                                            <div class="widget-box widget-color-blue3" id="widget-box-7">
                                                <div class="widget-header widget-header-small">
                                                    <h6 class="widget-title smaller">Verification Details</h6>
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main no-padding">
                                                        <div class="row">
                                                            <div class="col-xs-12">

                                                                <?php
                                                                echo $form->field($model, 'center_remarks')->textInput()->label('Remarks');
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="widget-toolbox padding-8 clearfix">
                                                        <!--                                                        <button class="btn btn-xs btn-danger pull-left">
                                                                                                                    <i class="ace-icon fa fa-times"></i>
                                                                                                                    <span class="bigger-110">I don't accept</span>
                                                                                                                </button>-->

                                                        <button class="btn btn-xs btn-success pull-right multiplesubmitbuttons" type="submit" name="submit" value="submit">
                                                            <span class="bigger-110">Forward</span>

                                                            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                        </button>
                                                    </div>                                                </div>
                                            </div>                                        
                                        </div>                    
                                    </div>

                                </div><!-- /.widget-main -->
                            </div><!-- /.widget-body -->
                        </div>                    
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (!$model->isNewRecord) {
            echo \app\components\Commentbox::widget([
                'title' => 'Comments',
                'dataurl' => 'finance/fmsvoucher/comments&id=' . $model->voucher_id,
                'submiturl' => 'finance/fmsvoucher/updatecomments',
                'parentval' => $model->voucher_id,
                'allowadd' => 1,
            ]);
        }
        ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>

</div>
<?php
//echo $this->renderFile(Yii::getAlias("@app").'\modules\members\views\members\_find.php', ['model'=> new app\models\application\Members()]);
?>