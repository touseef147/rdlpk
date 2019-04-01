<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

//$serial = $id+1;
?>

<td class="center">
    <input type="hidden" name="Fmsvoucherplotdetail[<?php echo $id; ?>][voucher_plot_detail_id]" id="Fmsvoucherplotdetail_<?php echo $id; ?>_voucher_plot_detail_id" value="0" />
    <input type="hidden" name="Fmsvoucherplotdetail[<?php echo $id; ?>][transaction_source]" id="Fmsvoucherplotdetail_<?php echo $id; ?>_transaction_source" value="2" />
    <input type="hidden" name="Fmsvoucherplotdetail[<?php echo $id; ?>][plot_id]" id="Fmsvoucherplotdetail_<?php echo $id; ?>_plot_id" value="<?php echo $model->plot_id; ?>" />
    <input type="hidden" name="Fmsvoucherplotdetail[<?php echo $id; ?>][is_selected]" id="Fmsvoucherplotdetail_<?php echo $id; ?>_is_selected" value="1" />
</td>
<td>
    <?php echo $model->ms_no; ?>
</td>

<td>
    <input type="text" name="Fmsvoucherplotdetail[<?php echo $id; ?>][receipt_no]" id="Fmsvoucherplotdetail_<?php echo $id; ?>_receipt_no" />
</td>
<td>
    <input type="text" name="Fmsvoucherplotdetail[<?php echo $id; ?>][narration]" id="Fmsvoucherplotdetail_<?php echo $id; ?>_narration" />
</td>
<td>
    <?php
    $installments = app\models\application\Installpayment::find()->where(['plot_id' => $model->plot_id])->all();

    $msamount = 0;

    foreach ($installments as $inst) {
        if (date("y-m-d", strtotime($inst->due_date)) < date("y-m-d")) {
            if (floatval($inst->dueamount) > floatval($inst->paidamount)) {
                $msamount += $inst->dueamount;
                //$totalpayableamount += $inst->dueamount;
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
