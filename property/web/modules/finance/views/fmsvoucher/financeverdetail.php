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
            ["link" => "finance/fmsvoucher/financeverification", "title" => "Instruments"],
            ["link" => "", "title" => "Instrument Detail"],
        ],
    ])
    ?>

    <div class="page-content">
        <span class="pull-right bolder bigger-110 " style="margin-top: 10px;">Payment Mode: <span class="red"><?php echo $model->amounttypetitle; ?></span></span>

        <?= \app\components\Pageheader::widget(["title" => ($model->amount_type == 5 ? "Fund Transfer Detail" : "Instrument Detail"), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>

                <?= ""//Html::errorSummary($model) ?>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-medium">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> <?php echo ($model->amount_type == 5 ? "Fund Transfer Detail" : "Instrument Detail") ?></h6>
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
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> <?php echo ($model->amount_type == 5 ? "Dealer" : "Member"); ?> Detail</h6>

                                <!--                                <div class="widget-toolbar">
                                                                    <div class="red lazycontent" id="dealerledgerbalance" data-url="<?php echo Yii::$app->urlManager->baseUrl . "/index.php?r=members/dealers/ledger/showbalance&id=" . $modelmember->id . "&type=Dealer" ?>"></div>
                                                                </div>-->
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <?php $model->member_id = $modelmember->id; ?>
                                    <?= $form->field($model, 'member_id')->hiddenInput()->label(FALSE) ?>
                                    <?=
                                    $this->renderFile(
                                            Yii::getAlias("@app") . '/modules/members/views/members/showrecord.php', [
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
                                                    <h6 class="widget-title smaller">Sales Center Verification</h6>
                                                    <div class="widget-toolbar no-border">
                                                        Verification Date: <strong><?php echo $model->forwarddate; ?></strong>
                                                    </div>
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main no-padding">
                                                        <?php
                                                        if ($model->amount_type == 5) {
                                                            ?>
                                                            <div class="widget-body padding-18 red center">
                                                                Not Applicable.
                                                            </div>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <table id="simple-table" class="table  table-bordered table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Receipt/JV No.</th>
                                                                        <th>Bank</th>
                                                                        <th>Deposit Slip No.</th>
                                                                        <th>Deposit Date</th>
                                                                        <th>Clearance Date</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    if ($modelreceipts != NULL) {
                                                                        foreach ($modelreceipts as $row) {
                                                                            ?>
                                                                            <tr>
                                                                                <td class="center"><?php echo $row->receipt_no; ?></td>
                                                                                <td align="left"><?php echo ($row->targetbank == null ? "" : $row->targetbank->bank_title); ?></td>

                                                                                <td align="left"><?php echo $row->deposit_slip_no; ?></td>
                                                                                <td align="left"><?php echo $row->deposit_date; ?></td>
                                                                                <td align="left"><?php echo $row->clearance_date; ?></td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="widget-toolbox padding-8 clearfix">
                                                            <table style="width: 100%;" >
                                                                <tr>
                                                                    <td style="vertical-align: top; width: 80px;">
                                                                        Remarks
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $model->center_remarks ?>
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
                                                    <h6 class="widget-title smaller">Finance Verification</h6>
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        <?php
                                                        echo $form->field($model, 'verification_remarks')->textarea()->label('Remarks');
                                                        ?>
                                                    </div>
                                                    <div class="widget-toolbox padding-8 clearfix">
                                                        <!--                                                        <button class="btn btn-xs btn-danger pull-left">
                                                                                                                    <i class="ace-icon fa fa-times"></i>
                                                                                                                    <span class="bigger-110">I don't accept</span>
                                                                                                                </button>-->

                                                        <button class="btn btn-xs btn-success pull-right multiplesubmitbuttons" type="submit" name="submit" value="submit">
                                                            <span class="bigger-110">Verify</span>

                                                            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                        </button>
                                                    </div>                                                
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>                    
                                </div>

                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div>                    
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-small">
                            <h6 class="widget-title"><i class="icon-th-large"></i> <?php echo ($model->amount_type == 5 ? "Fund Transfer Detail" : "Instrument Detail") ?></h6>

                            <!--                                <div class="widget-toolbar">
                                                                <a href="#">
                                                                    Print All
                                                                </a>
                                                            </div>-->
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
                                            if ($row->transaction_source == 1) {
                                                echo $this->render('_dynamicform', [
                                                    'id' => $records,
                                                    'id2' => $receiptno,
                                                    'memberid' => $model->member_id,
                                                    'receipt' => $row,
                                                    'receiptdetail' => $modelreceiptdetail,
                                                    'records' => $records,
                                                    'mode' => 'view',
                                                    'print' => 'no',
                                                ]);
                                                $receiptno+=1;
                                            } else if ($row->transaction_source == 2) {
                                                echo $this->render('_dynamicinstallment', [
                                                    'id' => $records,
                                                    'id2' => $receiptno,
                                                    'memberid' => $model->member_id,
                                                    'receipt' => $row,
                                                    'receiptdetail' => $modelreceiptdetail,
                                                    'records' => $records,
                                                    'mode' => 'view',
                                                    'print' => 'no',
                                                ]);
                                                $receiptinstno+=1;
                                            } else {
                                                echo $this->render('_dynamictransfer', [
                                                    'id' => $records,
                                                    'id2' => $receiptno,
                                                    'memberid' => $model->member_id,
                                                    'receipt' => $row,
                                                    'receiptdetail' => $modelreceiptdetail,
                                                    'records' => $records,
                                                    'mode' => 'view',
                                                    'print' => 'no',
                                                ]);
                                                $receipttransno+=1;
                                            }
//                                            echo $this->render('_dynamicform', [
//                                                'id' => $records,
//                                                'id2' => $receiptno,
//                                                'memberid' => $model->member_id,
//                                                'receipt' => $row,
//                                                'receiptdetail' => $modelreceiptdetail,
//                                                'records' => $records,
//                                                'mode' => 'view',
//                                                'print' => 'no',
//                                                'amounttype' => $model->amount_type,
//                                            ]);
//                                            $receiptno+=1;

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
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

</div>
<?php
//echo $this->renderFile(Yii::getAlias("@app").'\modules\members\views\members\_find.php', ['model'=> new app\models\application\Members()]);
?>