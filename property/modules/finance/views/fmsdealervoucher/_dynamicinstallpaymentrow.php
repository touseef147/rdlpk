<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>

<tr>
    <td class="center" style="width:40px;">      
        <?php
        //echo $file->id;
            echo Html::hiddenInput('Installpayment[' . $id . '][transaction_source]', $source);
            echo Html::hiddenInput('Installpayment[' . $id . '][plot_id]', $file->id);
        ?>
    </td>
    <td>
        <?php
        if($mode=="entry"){
            echo Html::dropDownList('Installpayment[' . $id . '][id]', $model->id, ArrayHelper::map(app\models\application\Installpayment::find()->where(['plot_id' => $file->id])->andFilterWhere(['or',['=', 'paidamount', 0],['=', 'id',$model->id]])->all(), 'id', 'lab'), // Flat array ('id'=>'label')
                    ['prompt' => '---',
                'onchange' => ' 
                                $.get( "' . Url::toRoute('/finance/fmsdealervoucher/installpaymentdetail') . '", { id: $(this).val() } )
                                    .done(function( data ) {
                                        $("#Installpayment' . $id . 'due_date").html(data[2]);
                                        $("#Installpayment_' . $id . '_due_date").val(data[2]);
                                        $("#Installpayment' . $id . 'dueamount").html(data[3]);
                                        $("#Installpayment_' . $id . '_dueamount").val(data[6]);
                                        $("#Installpayment' . $id . 'paidamount").val(data[3]);


                                        var total=0;   
                                        var pamnt = $(\'.dueamount'.$idx.'\');
                                        $.each(pamnt, function (index, element) {
                                            total += parseFloat(removeCommas($(this).val()));

                                        });
                                        $(\'#lblgrouptotalpayable'.$idx.'\').html(addCommas(total));
                                    }
                                );',
                    ]    // options
            );
        }else{
            echo $model->lab;
        }
        ?>
    </td>
    <td>
        <div id="Installpayment<?php echo $id; ?>category">---</div>
    </td>
    <td>
        <div id="Installpayment<?php echo $id; ?>due_date"><?php echo ($model->due_date == null || $model->due_date == "" ? "---" : $model->showduedate); ?></div>
        <input type="hidden" id="Installpayment_<?php echo $id; ?>_due_date" name="Installpayment[<?php echo $id; ?>][due_date]" value="<?php echo $model->due_date; ?>" >
    </td>
    <td style="text-align:right;">
        <div id="Installpayment<?php echo $id; ?>dueamount"><?php echo ($model->dueamount == null || $model->dueamount == "" ? "---" : number_format($model->dueamount)); ?></div>
        <input type="hidden" class="dueamounts dueamount<?php echo $idx; ?>" id="Installpayment_<?php echo $id; ?>_dueamount" name="Installpayment[<?php echo $id; ?>][dueamount]" value="<?php echo $model->dueamount; ?>" >
    </td>
    <td style="text-align: right;"><?php
    
    if($mode=="entry"){
        echo Html::textInput('Installpayment[' . $id . '][paidamount]',$model->paidamount, [
            'class'=>'paidamounts paidamount'.$idx,
            'onblur'=>'javascript:; '
            . ' 
                var total=0;   
                var pamnt = $(\'.paidamount'.$idx.'\');
        $.each(pamnt, function (index, element) {
            total += parseFloat($(this).val());

        });
        $(\'#lblgrouptotalpaid'.$idx.'\').html(addCommas(total));

                total=0;   
                var pamnt = $(\'.paidamounts\');
        $.each(pamnt, function (index, element) {
            total += parseFloat($(this).val());

        });
        $(\'#runningtotalpaid\').html(addCommas(total));
        '
            ]) ;
        
    }else{
        echo number_format($model->paidamount);
    }
            ?>
            <?php echo  Html::error($model, 'paidamount', ['class' => 'help-block red']);  ?>
    </td>
    <td><?php
    if($mode=="entry"){
        echo Html::textInput('Installpayment[' . $id . '][remarks]', $model->remarks); ;
    }else{
        echo $model->remarks;
    }
    
    
            ?>
            <?php echo  Html::error($model, 'remarks', ['class' => 'help-block red']);  ?>
    </td>
</tr>
