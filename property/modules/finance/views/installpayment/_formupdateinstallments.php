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

                <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->baseUrl . '/index.php?r=finance/fmsvoucher/' . ($model->isNewRecord ? 'create' : 'update&id=' . $model->voucher_id), 'options' => ['class' => 'frminput']]); ?>

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

                <div class="row">
                    <div class="col-xs-12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title"><i class="icon-th-large"></i> Receipt Detail</h6>

                                <div class="widget-toolbar">
                                    <div class="widget-menu">
                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/voucherplotdetail/updatereceipts&voucherid=<?php echo $model->voucher_id; ?>" class="ajaxlink">
                                            Add
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div id="voucher_detail">
                                        <?php
                                        $records = 0;
                                        $receiptno = 0;
                                        $receiptinstno = 0;
                                        $receipttransno = 0;
                                        $totalamount = 0;

                                        if ($modelreceipts != NULL) {
                                            foreach ($modelreceipts as $row) {
                                                ?>



                                                <div class="widget-box transparent ui-sortable-handle" id="widget-box-12">
                                                    <div class="widget-header">
                                                        <h4 class="widget-title lighter">
                                                            Receipt #: <span class="red bolder"><?php echo $row->receipt_no; ?></span>
                                                        </h4>
                                                    </div>

                                                    <div class="widget-body">
                                                        <div id="instcontent<?php echo $receiptno ?>" class="widget-main padding-12">

                                                            <input name="Fmsvoucherplotdetail[<?php echo $receiptno ?>][transaction_source]" value="2" type="hidden">
                                                            <table style="width: 100%;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">            
                                                                            Remarks
                                                                        </td>
                                                                        <td colspan="7" style="border-bottom: dotted">
                                                                            <?php echo $row->narration; ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;</td>
                                                                        <td colspan="7"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">MS. No.</td>
                                                                        <td style="border-bottom: dotted"><?= ($row->membership == NULL ? " " : $row->membership->ms_no) ?></td>
                                                                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Date</td>
                                                                        <td style="border-bottom: dotted; width: 100px;"><?= ($row->application == NULL ? " " : $row->application->application_date) ?></td>
                                                                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Size</td>
                                                                        <td style="border-bottom: dotted; width: 100px;"><?= ($row->plot == NULL ? " " : $row->plot->sizeCat->code) ?></td>
                                                                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Type</td>
                                                                        <td style="border-bottom: dotted;  width: 100px;"><?= ($row->plot == NULL ? " " : $row->plot->comrestitle) ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Project</td>
                                                                        <td colspan="3" style="border-bottom: dotted"><?= ($row->application == NULL ? " " : $row->application->project->project_name) ?></td>
                                                                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Sales Center</td>
                                                                        <td colspan="3" style="border-bottom: dotted"><?= ""//($row->application == NULL || $row->application->salescenter == NULL ? " " : $row->application->salescenter->name) ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Dealer</td>
                                                                        <td colspan="7" style="border-bottom: dotted"><?= ""//($row->application == NULL ? " " : $row->application->dealer->name) ?></td>
                                                                    </tr>
                                                                </tbody></table>
                                                            <br>
                                                            <div class="widget-box widget-color-dark ui-sortable-handle" id="widget-box-7">
                                                                <div class="widget-header widget-header-small">
                                                                    <h6 class="widget-title smaller">Distribute Amount</h6>
                                                                    <div class="widget-toolbar">
                                                                        <a class="white add_dynamic_row" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/dynamicinstallpaymentrow&voucherdetialid=<?php echo $row->voucher_plot_detail_id; ?>&plotid=<?php echo $row->plot_id; ?>" data-rowcount="drcount" data-desttable="instformno<?php echo $receiptno ?>" data-tag='<?php echo $row->voucher_plot_detail_id ?>' href="#">Add</a> 
                                                                    </div>
                                                                </div>

                                                                <div class="widget-body">
                                                                    <div class="widget-main no-padding">
                                                                        <table id="instformno<?php echo $receiptno ?>" class="table  table-bordered table-hover">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="center" style="width:40px;">      </th>
                                                                                    <th>Title</th>
                                                                                    <th>Category</th>
                                                                                    <th>Due Date</th>
                                                                                    <th>Payable Amount</th>
                                                                                    <th>Paid Amount</th>
                                                                                    <th>Remarks</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                $dueamount =0;
                                                                                $paid =0;
                                                                                
                                                                                foreach ($modelreceiptdetail as $detail) {
                                                                                    if ($detail->voucher_plot_detail_id == $row->voucher_plot_detail_id) {
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td>
                                                                                            </td>
                                                                                            <td align="left">
                                                                                                <?=
                                                                                                Html::hiddenInput('Installpayment[' . $records . '][voucher_plot_detail_id]', $detail->voucher_plot_detail_id);
                                                                                                ?>
                                                                                                <?php
                                                                                                echo Html::dropDownList('Installpayment[' . $records . '][id]', $detail->id, ArrayHelper::map(app\models\application\Installpayment::find()->where(['plot_id' => $row->plot_id])->andFilterWhere(['or', ['=', 'paidamount', 0], ['=', 'id', $detail->id]])->all(), 'id', 'lab'), // Flat array ('id'=>'label')
                                                                                                        ['prompt' => '---',
                                                                                                    'onchange' => ' 
                                $.get( "' . Url::toRoute('/finance/fmsvoucher/installpaymentdetail') . '", { id: $(this).val() } )
                                    .done(function( data ) {
                                        $("#Installpayment' . $records . 'due_date").html(data[2]);
                                        $("#Installpayment_' . $records . '_due_date").val(data[2]);
                                        $("#Installpayment' . $records . 'dueamount").html(data[3]);
                                        $("#Installpayment_' . $records . '_dueamount").val(data[6]);
                                        $("#Installpayment' . $records . 'paidamount").val(data[3]);


                                        var total=0;   
                                        var pamnt = $(\'.dueamount' . $detail->voucher_plot_detail_id . '\');
                                        $.each(pamnt, function (index, element) {
                                            total += parseFloat($(this).val());

                                        });
                                        $(\'#lblgrouptotalpayable' . $detail->voucher_plot_detail_id . '\').html(addCommas(total));
                                    }
                                );',
                                                                                                        ]    // options
                                                                                                );
                                                                                                ?>
                                                                                            </td>
                                                                                            <td align="left">
                                                                                                <div id="Installpayment<?php echo $records; ?>category">---</div>
                                                                                            </td>
                                                                                            <td align="right">
                                                                                                <div id="Installpayment<?php echo $records; ?>due_date"><?php echo  date("d-m-Y", strtotime($detail->due_date)); ?></div>
                                                                                                <input type="hidden" id="Installpayment_<?php echo $records; ?>_due_date" name="Installpayment[<?php echo $records; ?>][due_date]" value="<?php echo $detail->due_date; ?>" >
                                                                                            </td>
                                                                                            <td align="left">
                                                                                                <div id="Installpayment<?php echo $records; ?>dueamount" class="pull-right"><?php echo number_format($detail->dueamount); ?></div>
                                                                                                <input type="hidden" class="dueamounts dueamount<?php echo $detail->voucher_plot_detail_id; ?>" id="Installpayment_<?php echo $records; ?>_dueamount" name="Installpayment[<?php echo $records; ?>][dueamount]" value="<?php echo $detail->dueamount; ?>" >
                                                                                            </td>
                                                                                            <td class="center">
                                                                                                <?php
                                                                                                echo Html::textInput('Installpayment[' . $records . '][paidamount]', $detail->paidamount, [
                                                                                                    'class' => 'paidamounts paidamount' . $detail->voucher_plot_detail_id,
                                                                                                    'onblur' => 'javascript:; '
                                                                                                    . ' 
                var total=0;   
                var pamnt = $(\'.paidamount' . $detail->voucher_plot_detail_id . '\');
        $.each(pamnt, function (index, element) {
            total += parseFloat($(this).val());

        });
        $(\'#lblgrouptotalpaid' . $detail->voucher_plot_detail_id . '\').html(addCommas(total));

                total=0;   
                var pamnt = $(\'.paidamounts\');
        $.each(pamnt, function (index, element) {
            total += parseFloat($(this).val());

        });
        $(\'#runningtotalpaid\').html(addCommas(total));
        '
                                                                                                ]);
                                                                                                ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php
                                                                                                echo Html::textInput('Installpayment[' . $records . '][remarks]', $detail->remarks);
                                                                                                ?>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <?php
                                                                                        $records+=1;
                                                                                        $dueamount += $detail->dueamount;
                                                                                        $paid += $detail->paidamount;
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <tr class="footer">
                                                                                    <th class="center" style="width:40px;">      </th>
                                                                                    <th>Totals</th>
                                                                                    <th></th>
                                                                                    <th></th>
                                                                                    <th>
                                                                                        <div style="text-align: right;" id="lblgrouptotalpayable<?php echo $row->voucher_plot_detail_id; ?>">
                                                                                            <?php echo number_format($dueamount); ?>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th>
                                                                                        <div style="text-align: right;" id="lblgrouptotalpaid<?php echo $row->voucher_plot_detail_id; ?>">
                                                                                            <?php echo number_format($paid); ?>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th></th>
                                                                                </tr>
                                                                            </tbody>                
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>        
                                                        </div>
                                                    </div>
                                                </div>






                                                <?php
                                                if ($row->transaction_source == 1) {
//                                                    echo $this->render('_dynamicform', [
//                                                        'id' => $records,
//                                                        'id2' => $receiptno,
//                                                        'memberid' => $model->member_id,
//                                                        'receipt' => $row,
//                                                        'receiptdetail' => $modelreceiptdetail,
//                                                        'records' => $records,
//                                                        'mode' => 'entry',
//                                                        'print' => 'no',
//                                                    ]);
                                                    $receiptno+=1;
                                                } else if ($row->transaction_source == 2) {
//                                                    echo $this->render('_dynamicinstallment', [
//                                                        'id' => $records,
//                                                        'id2' => $receiptno,
//                                                        'memberid' => $model->member_id,
//                                                        'receipt' => $row,
//                                                        'receiptdetail' => $modelreceiptdetail,
//                                                        'records' => $records,
//                                                        'mode' => 'entry',
//                                                        'print' => 'no',
//                                                    ]);
                                                    $receiptinstno+=1;
                                                } else {
//                                                    echo $this->render('_dynamictransfer', [
//                                                        'id' => $records,
//                                                        'id2' => $receiptno,
//                                                        'memberid' => $model->member_id,
//                                                        'receipt' => $row,
//                                                        'receiptdetail' => $modelreceiptdetail,
//                                                        'records' => $records,
//                                                        'mode' => 'entry',
//                                                        'print' => 'no',
//                                                    ]);
                                                    $receipttransno+=1;
                                                }

                                                foreach ($modelreceiptdetail as $detail) {
                                                    if ($detail->plot_id == $row->plot_id) {
                                                        $records+=1;
                                                        $totalamount += $detail->paidamount;
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                    <input type="hidden" value="-1" id="drcount" name="drcount" />
                                    <input type="hidden" value="<?php echo intval($receiptno) - 1 ?>" id="drcountform" name="drcountform" />
                                    <input type="hidden" value="<?php echo intval($receiptinstno) - 1 ?>" id="drcountinstallment" name="drcountinstallment" />
                                    <input type="hidden" value="<?php echo intval($receipttransno) - 1 ?>" id="drcounttransfer" name="drcounttransfer" />
                                    <input type="hidden" value="<?php echo intval($records) - 1; ?>" id="drinstpaymentcount" name="drinstpaymentcount" />
                                </div>
                                <div class="widget-toolbox padding-8 clearfix">
                                    <div class="pull-left">
                                        <strong>Total Amount:</strong>  <span id="runningtotalpaid">
                                            <?php
                                            if (count($modelreceiptdetail) > 0) {
                                                echo number_format($totalamount);
//                                                echo number_format(array_sum(array_map(function($item) {
//                                                                    return $item['paidamount'];
//                                                                }, $modelreceiptdetail))); //array_sum(array_column($installpayments,'paidamount'));
                                            }
                                            ?>
                                        </span>
                                    </div>
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
                <br />
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group pull-right">
                            <?= Html::submitInput($model->isNewRecord ? 'Create' : 'Update', ['name' => 'submit', 'class' => $model->isNewRecord ? 'btn btn-success multiplesubmitbuttons' : 'btn btn-primary btn-round multiplesubmitbuttons']) ?>&nbsp;&nbsp;&nbsp;
                            <?= Html::submitInput('Submit', ['name' => 'submit', 'class' => 'btn btn-danger btn-round multiplesubmitbuttons']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
<?php
//echo $this->renderFile(Yii::getAlias("@app").'\modules\members\views\members\_find.php', ['model'=> new app\models\application\Members()]);
?>