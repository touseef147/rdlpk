<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>

<tr>
    <td>
    </td>
    <td align="left">
        <?=
        Html::hiddenInput('Installpayment[' . $id . '][voucher_plot_detail_id]', $voucher_detail_id);
        ?>
        <?php
        echo Html::dropDownList('Installpayment[' . $id . '][id]', 0, ArrayHelper::map(app\models\application\Installpayment::find()->where(['plot_id' => $plotid])->andFilterWhere(['or', ['=', 'paidamount', 0], ['=', 'id', $plotid]])->all(), 'id', 'lab'), // Flat array ('id'=>'label')
                ['prompt' => '---',
            'onchange' => ' 
                                $.get( "' . Url::toRoute('/finance/fmsvoucher/installpaymentdetail') . '", { id: $(this).val() } )
                                    .done(function( data ) {
                                        $("#Installpayment' . $id . 'due_date").html(data[2]);
                                        $("#Installpayment_' . $id . '_due_date").val(data[2]);
                                        $("#Installpayment' . $id . 'dueamount").html(data[3]);
                                        $("#Installpayment_' . $id . '_dueamount").val(data[6]);
                                        $("#Installpayment' . $id . 'paidamount").val(data[3]);


                                        var total=0;   
                                        var pamnt = $(\'.dueamount' . $voucher_detail_id . '\');
                                        $.each(pamnt, function (index, element) {
                                            total += parseFloat($(this).val());

                                        });
                                        $(\'#lblgrouptotalpayable' . $voucher_detail_id . '\').html(addCommas(total));
                                    }
                                );',
                ]    // options
        );
        ?>
    </td>
    <td align="left">
        <div id="Installpayment<?php echo $id; ?>category">---</div>
    </td>
    <td align="right">
        <div id="Installpayment<?php echo $id; ?>due_date">---</div>
        <input type="hidden" id="Installpayment_<?php echo $id; ?>_due_date" name="Installpayment[<?php echo $id; ?>][due_date]" >
    </td>
    <td align="left">
        <div id="Installpayment<?php echo $id; ?>dueamount">---</div>
        <input type="hidden" class="dueamounts dueamount<?php echo $voucher_detail_id; ?>" id="Installpayment_<?php echo $id; ?>_dueamount" name="Installpayment[<?php echo $id; ?>][dueamount]" >
    </td>
    <td class="center">
        <?php
        echo Html::textInput('Installpayment[' . $id . '][paidamount]', 0, [
            'class' => 'paidamounts paidamount' . $voucher_detail_id,
            'onblur' => 'javascript:; '
            . ' 
                var total=0;   
                var pamnt = $(\'.paidamount' . $voucher_detail_id . '\');
        $.each(pamnt, function (index, element) {
            total += parseFloat($(this).val());

        });
        $(\'#lblgrouptotalpaid' . $voucher_detail_id . '\').html(addCommas(total));

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
        echo Html::textInput('Installpayment[' . $id . '][remarks]', "");
        
        ?>
    </td>
</tr>
