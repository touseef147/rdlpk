<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\Installmentplanmaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="installmentplanmaster-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "finance/fmsvoucher/index", "title" => "Instruments"],
            ["link" => "", "title" => "Update Receipts"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= ""//\app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/updateinstrument&id=<?php echo $model->voucher_id; ?>" class="ajaxlink pull-right">Edit Instrument</a>
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installmentplanmaster/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>
                <?= $form->field($model, 'voucher_id')->hiddenInput()->label(FALSE) ?>
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
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <?php
                                    if ($model->member_id != NULL && $model->member_id != 0) {
                                        echo $this->renderFile(
                                                Yii::getAlias("@app") . '\modules\members\views\members\showrecord.php', [
                                            'model' => app\models\application\Members::find()->where(['id' => $model->member_id])->one()
                                        ]);
                                    } else {
                                        echo $model->person_name;
                                    }
                                    ?>
                                    <?= $form->field($model, 'member_id')->hiddenInput()->label(FALSE) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                //if ($model->plan_id != 0) {
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="widget-box ui-sortable-handle" id="widget-box-1">
                            <div class="widget-header widget-header-large">
                                <h4 class="widget-title">Receipts</h4>
                                <div class="widget-toolbar"> <a class="add_dynamic_row" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/voucherplotdetail/dynamicmssearchrow" data-rowcount="drcount" data-desttable="dynamic_list" href="#">Add</a> </div>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main no-padding">
                                    <table id="dynamic_list" class="table  table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="center" style="width:30px;"></th>
                                                <th style="width: 150px;">MS No.</th>
                                                <th style="width: 200px;">Receipt No.</th>
                                                <th>Remarks</th>
                                                <th style="width: 100px;">Due Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = -1;
                                            $totalpayableamount = 0;

                                            foreach ($modelreceipts as $row) {
                                                $count++;
                                                ?>
                                                <tr>
                                                    <td class="center"><?php
                                                        echo $count + 1;
                                                        ?>
                                                        <input type="hidden" name="Fmsvoucherplotdetail[<?php echo $count; ?>][voucher_plot_detail_id]" id="Fmsvoucherplotdetail_<?php echo $count; ?>_voucher_plot_detail_id" value="<?php echo $row->voucher_plot_detail_id; ?>" />
                                                        <input type="hidden" name="Fmsvoucherplotdetail[<?php echo $count; ?>][transaction_source]" id="Fmsvoucherplotdetail_<?php echo $count; ?>_transaction_source" value="2" />
                                                        <input type="hidden" name="Fmsvoucherplotdetail[<?php echo $count; ?>][plot_id]" id="Fmsvoucherplotdetail_<?php echo $count; ?>_plot_id" value="<?php echo $row->plot_id; ?>" />
                                                        <input type="hidden" name="Fmsvoucherplotdetail[<?php echo $count; ?>][is_selected]" id="Fmsvoucherplotdetail_<?php echo $count; ?>_is_selected" value="1" />
                                                    </td>
                                                    <td>
                                                        <?php echo $row->plot->currentmembership->ms_no; ?>
                                                    </td>

                                                    <td>
                                                        <?= $form->field($row, 'receipt_no')->textInput(['name' => 'Fmsvoucherplotdetail[' . $count . '][receipt_no]', 'class' => 'col-xs-12'])->label(false) ?>
                                                    </td>
                                                    <td>
                                                        <?= $form->field($row, 'narration')->textInput(['name' => 'Fmsvoucherplotdetail[' . $count . '][narration]'])->label(false) ?>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <?php
                                                        $installments = app\models\application\Installpayment::find()->where(['plot_id' => $row->plot_id])->all();

                                                        $msamount = 0;

                                                        foreach ($installments as $inst) {
                                                            if (date("y-m-d", strtotime($inst->due_date)) < date("y-m-d")) {
                                                                if (floatval($inst->dueamount) > floatval($inst->paidamount)) {
                                                                    $msamount += $inst->dueamount;
                                                                    $totalpayableamount += $inst->dueamount;
                                                                }
                                                            }
                                                        }

                                                        if ($msamount > 0)
                                                            echo number_format($msamount);
//                                                        echo $form->field($row, 'gap_type')
//                                                                ->dropDownList(
//                                                                        array('1' => 'Days', '2' => 'Months'), ['prompt' => '---',
//                                                                    'name' => 'Fmsvoucherplotdetail[' . $count . '][gap_type]'
//                                                                        ]    // options
//                                                                )->label(false);
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }


                                            $modelms = app\models\application\Propertymemberships::find()->where(['member_id' => $model->member_id])->all();

                                            foreach ($modelms as $row) {
                                                $found = FALSE;
                                                foreach ($modelreceipts as $rec) {
                                                    if ($rec->plot_id == $row->plot_id) {
                                                        $found = true;
                                                    }
                                                }

                                                if ($found == false) {
                                                    $count++;
                                                    ?>
                                                    <tr>
                                                        <td class="center">
                                                            <input type="hidden" name="Fmsvoucherplotdetail[<?php echo $count; ?>][voucher_plot_detail_id]" id="Fmsvoucherplotdetail_<?php echo $count; ?>_voucher_plot_detail_id" value="0" />
                                                            <input type="hidden" name="Fmsvoucherplotdetail[<?php echo $count; ?>][transaction_source]" id="Fmsvoucherplotdetail_<?php echo $count; ?>_transaction_source" value="2" />
                                                            <input type="hidden" name="Fmsvoucherplotdetail[<?php echo $count; ?>][plot_id]" id="Fmsvoucherplotdetail_<?php echo $count; ?>_plot_id" value="<?php echo $row->plot_id; ?>" />
                                                            <input type="checkbox" name="Fmsvoucherplotdetail[<?php echo $count; ?>][is_selected]" id="Fmsvoucherplotdetail_<?php echo $count; ?>_is_selected" value="0" onclick="if (this.checked)
                                                                        this.value = 1;
                                                                    else
                                                                        this.value = 0;" />
                                                                   <?php
//                                                        echo $count + 1;
                                                                   //echo $form->field($row, 'voucher_plot_detail_id')->hiddenInput(['name' => 'Fmsvoucherplotdetail[' . $count . '][voucher_plot_detail_id]'])->label(false);
                                                                   //echo $form->field($row, 'transaction_source')->hiddenInput(['name' => 'Fmsvoucherplotdetail[' . $count . '][transaction_source]'])->label(false);
                                                                   ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row->ms_no; ?>
                                                            <?= ""//$form->field($row, 'serial_no')->textInput(['name' => 'Fmsvoucherplotdetail[' . $count . '][serial_no]', 'class' => 'col-xs-12'])->label(false) ?>
                                                        </td>

                                                        <td>
                                                            <input type="text" name="Fmsvoucherplotdetail[<?php echo $count; ?>][receipt_no]" id="Fmsvoucherplotdetail_<?php echo $count; ?>_receipt_no" />
                                                            <?= ""//$form->field($row, 'serial_no')->textInput(['name' => 'Fmsvoucherplotdetail[' . $count . '][serial_no]'])->label(false) ?>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="Fmsvoucherplotdetail[<?php echo $count; ?>][narration]" id="Fmsvoucherplotdetail_<?php echo $count; ?>_narration" />
        <!--                                                        <input type="text" name="txt" id="txt" />-->
                                                            <?= ""//$form->field($row, 'gap')->textInput(['name' => 'Fmsvoucherplotdetail[' . $count . '][gap]'])->label(false) ?>
                                                        </td>
                                                        <td style="text-align: right;">
                                                            <?php
                                                            $installments = app\models\application\Installpayment::find()->where(['plot_id' => $row->plot_id])->all();

                                                            $msamount = 0;

                                                            foreach ($installments as $inst) {
                                                                if (date("y-m-d", strtotime($inst->due_date)) < date("y-m-d")) {
                                                                    if (floatval($inst->dueamount) > floatval($inst->paidamount)) {
                                                                        $msamount += $inst->dueamount;
                                                                        $totalpayableamount += $inst->dueamount;
                                                                    }
                                                                }
                                                            }

                                                            if ($msamount > 0)
                                                                echo number_format($msamount);
//                                                        echo $form->field($row, 'gap_type')
//                                                                ->dropDownList(
//                                                                        array('1' => 'Days', '2' => 'Months'), ['prompt' => '---',
//                                                                    'name' => 'Fmsvoucherplotdetail[' . $count . '][gap_type]'
//                                                                        ]    // options
//                                                                )->label(false);
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <tr class="footerrow">
                                                <td class="center"><?php ?>
                                                </td>
                                                <td colspan="3" style="text-align: right">
                                                    <strong>Total:</strong>
                                                </td>
                                                <td style="text-align: right; font-size: large; color: red; font-weight: bold;">
                                                    <?php
                                                    if ($totalpayableamount > 0)
                                                        echo number_format($totalpayableamount);
                                                    ?>
                                                </td>
                                            </tr>
                                        <input type="hidden" value="<?php echo $count; ?>" id="drcount" name="drcount" />
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                //}
                ?>
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