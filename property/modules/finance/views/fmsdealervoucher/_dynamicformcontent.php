<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

//$serial = $id + 1;
//print_r($model);
?>

<?= Html::hiddenInput('Fmsvoucherplotdetail[' . $idx . '][transaction_source]', 1) ?>

<table style="width: 100%;">
    <tr>
        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
            JV No.
        </td>
        <td style="<?php echo ($mode == "entry" ? "" : "border-bottom: dotted" );  ?>">
            <?php
            $tempvalid = (isset($receipt) && $receipt != NULL ? $receipt->voucher_plot_detail_id : NULL);
            $tempval = (isset($receipt) && $receipt != NULL ? $receipt->jv_no : NULL);
            
            echo Html::hiddenInput('Fmsvoucherplotdetail[' . $idx . '][voucher_plot_detail_id]', $tempvalid);
            
            if($mode == "entry"){
                echo Html::textInput('Fmsvoucherplotdetail[' . $idx . '][jv_no]', $tempval,['style'=> 'background-color:rgb(248, 248, 156);']);
            }else{
                echo $tempval;
            }
            echo (isset($receipt) && $receipt != NULL ? Html::error($receipt, 'jv_no', ['class' => 'help-block']) : NULL); 

            ?>
        </td>
        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">            
            Remarks
        </td>
        <td colspan="5" style="<?php echo ($mode == "entry" ? "" : "border-bottom: dotted" );  ?>">
            <?php
            $tempval = (isset($receipt) && $receipt != NULL ? $receipt->narration : NULL);

            if($mode == "entry"){
                echo Html::textInput('Fmsvoucherplotdetail[' . $idx . '][narration]', $tempval);
            } else{
                echo $tempval;
            }
            
            echo (isset($receipt) && $receipt != NULL ? Html::error($receipt, 'narration', ['class' => 'help-block']) : NULL); 
            ?>
        </td>
    </tr>
    <tr>
        <td >&nbsp;</td>
        <td colspan="7"></td>
    </tr>
    <tr>
        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Form No.</td>
        <td style="border-bottom: dotted"><?= $model->application_no ?></td>
        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Date</td>
        <td style="border-bottom: dotted"><?= date("d-m-Y", strtotime($model->application_date)) ?></td>
        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Size</td>
        <td style="border-bottom: dotted"><?= $model->plotsize->size ?></td>
        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Type</td>
        <td style="border-bottom: dotted"><?= $model->propertytypetitle ?></td>
    </tr>
    <tr>
        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Project</td>
        <td colspan="3" style="border-bottom: dotted"><?= $model->project->project_name ?></td>
        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Sales Center</td>
        <td colspan="3" style="border-bottom: dotted"><?= $model->salecenter->name ?></td>
    </tr>
    <tr>
        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Member</td>
        <td colspan="7" style="border-bottom: dotted"><?= ($model->member == NULL ? "" : $model->member->name) ?></td>
    </tr>
    <tr>
        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Dealer</td>
        <td colspan="7" style="border-bottom: dotted"><?= ($model->dealer == NULL ? "" : $model->dealer->name) ?></td>
    </tr>
</table>
<br />
<div class="widget-box widget-color-dark ui-sortable-handle" id="widget-box-7">
    <div class="widget-header widget-header-small">
        <h6 class="widget-title smaller">Book amount from Dealers credit balance</h6>
<?php
if($mode=="entry"){
    ?>
        <div class="widget-toolbar">
            <a class="white add_dynamic_row" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsdealervoucher/dynamicinstallpaymentrow&mode=<?php echo $mode; ?>" data-tag="<?php echo $model->application_id; ?>" data-source="1" data-rowcount="drinstpaymentcount" data-gtotalidx="<?php echo $idx; ?>" data-desttable="formno<?php echo $idx; ?>" href="#">Add</a>
        </div>
        <?php
}
?>
    </div>

    <div class="widget-body">
        <div class="widget-main no-padding">
            <table id="formno<?php echo $idx; ?>" class="table  table-bordered table-hover">
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
                    if (isset($receiptdetail) && $receiptdetail != null) {
                        foreach ($receiptdetail as $detail) {
                            if ($detail->plot_id == $receipt->plot_id) {
                                echo $this->render('_dynamicinstallpaymentrow', [
                                    'idx' => $idx,
                                    'id' => $id,
                                    'source' => 1,
                                    'file' => \app\models\application\Plots::find()->where(['id'=>$receipt->plot_id])->one(),
                                    'model' => $detail,
                                    'recposted' => 1,
                                    'mode' => $mode,
                                ]);
                                $id+=1;
                            }
                        }
                    }
                    ?>
                    <tr class="footer">
                        <th class="center" style="width:40px;">      </th>
                        <th>Totals</th>
                        <th></th>
                        <th></th>
                        <th><div style="text-align: right;" id="lblgrouptotalpayable<?php echo $idx; ?>">
                    <?php
                    $dueamount=0;
                    
                    if (isset($receiptdetail) && $receiptdetail != null) {
                        foreach ($receiptdetail as $detail) {
                            if ($detail->plot_id == $receipt->plot_id) {
                                $dueamount += floatval($detail["dueamount"]);
                            }
                        }
                    }
                    
                    echo number_format($dueamount);
                            ?>
                            </div></th>
                        <th><div style="text-align: right;" id="lblgrouptotalpaid<?php echo $idx; ?>">
                    <?php
                    $paidamount=0;
                    
                    if (isset($receiptdetail) && $receiptdetail != null) {
                        foreach ($receiptdetail as $detail) {
                            if ($detail->plot_id == $receipt->plot_id) {
                                $paidamount += floatval($detail["paidamount"]);
                            }
                        }
                    }
                    
                    echo number_format($paidamount);
                            ?>
                            </div></th>
                        <th></th>
                    </tr>
                </tbody>                
            </table>
        </div>
    </div>
</div>