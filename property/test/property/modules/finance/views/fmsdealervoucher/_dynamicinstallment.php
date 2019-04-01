<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$msid=(isset($receipt) && $receipt != NULL ? $receipt->membership_id : NULL);
$plotid=(isset($receipt) && $receipt != NULL ? $receipt->plot_id : NULL);
$modeldd=app\models\application\Propertymemberships::find()->innerJoinWith('plot')->innerJoinWith('plot.application')->where(['property_application.dealer_id' => $memberid])->andFilterWhere(['or',['=','property_memberships.ms_id',$msid]])->orderby('ms_no ASC')->all();

if($modeldd==null || count($modeldd)==0){
    ?>
<div class="widget-box transparent ui-sortable-handle" id="widget-box-12">
    <div class="widget-header">
        <h4 class="widget-title lighter">Installment</h4>
    </div>
    <div class="widget-body padding-18 red center">
        No record found.
    </div>
</div>
<?php
exit();
}

$serial = $id + 1;
$serial2 = $id2 + 1;

if ($serial > 1) {
    ?>
    <div class="hr"></div>
    <?php
}
?>

<div class="widget-box transparent ui-sortable-handle" id="widget-box-12">
    <div class="widget-header">
            <?php
            
            if($msid == NULL || $mode== "entry"){
                ?>
            <input type="checkbox" id="Fmsvoucherplotdetail_<?php echo $id2; ?>_is_selected" name="Fmsvoucherplotdetail[<?php echo $id2; ?>][is_selected]" checked="checked" value="1" onclick="if(this.checked) this.value = 1; else this.value =0;">&nbsp;
            <?php
            }
            ?>
        <h4 class="widget-title lighter">Installment</h4>

        <div class="widget-toolbar no-border">
            <?php
            if($msid == NULL || $mode== "entry"){
                echo "Membership No.";
                echo Html::dropDownList('Propertymemberships[' . $id2 . '][ms_id]', $msid, ArrayHelper::map($modeldd, 'ms_id', 'completecode'), // Flat array ('id'=>'label')
                        ['prompt' => '---',
                            'value' => (isset($receipt) && $receipt != NULL ? $receipt->membership_id : ""),
                    'onchange' => ' 
                                $.get( "' . Url::toRoute('/finance/fmsdealervoucher/dynamicinstformcontent') . '", { id: $(this).val(), index: ' . $id . ', mode: "' . $mode . '" } )
                                    .done(function( data ) {
                                        $( "#instcontent' . $id2 . '" ).html( data );
                                    }
                                );
                                $.get( "' . Url::toRoute('/property/membership/memberships/filedetails') . '", { id: $(this).val() } )
                                    .done(function( data ) {
                                        $( "#Propertymemberships_' . $id2 . '_plot_id" ).val( data[0] );
                                        $( "#Fmsvoucherplotdetail_' . $id2 . '_plot_id" ).val( data[0] );
                                    }
                                );
                                
                                $( "#Fmsvoucherplotdetail_' . $id2 . '_membership_id" ).val( $(this).val() );
                                ',
                        ]    // options
                );
            } else{
                echo Html::hiddenInput('Propertymemberships[' . $id2 . '][ms_id]', $msid); 
                ?>
                <a href="#">
                    Print
                </a>
            <?php
            }
            
            echo Html::hiddenInput('Propertymemberships[' . $id2 . '][plot_id]', $plotid, ['id' => 'Propertymemberships_' . $id2 . '_plot_id']); 
            echo Html::hiddenInput('Fmsvoucherplotdetail[' . $id2 . '][plot_id]', $plotid, ['id' => 'Fmsvoucherplotdetail_' . $id2 . '_plot_id']); 
            echo Html::hiddenInput('Fmsvoucherplotdetail[' . $id2 . '][membership_id]', $msid, ['id' => 'Fmsvoucherplotdetail_' . $id2 . '_membership_id']); 
            ?>
        </div>
    </div>

    <div class="widget-body">
        <div id="instcontent<?php echo $id2; ?>" class="widget-main padding-12">
            <?php
            if (isset($receipt) && $receipt != NULL) {
                echo $this->render('_dynamicinstformcontent', [
                'idx' => $id2,
                'id' => $id,
                'model' => app\models\application\Propertymemberships::find()->where(['ms_id'=>$receipt->membership_id])->one(),
                'receipt' => $receipt,
                'receiptdetail' => $receiptdetail,
                'records' => $records,
                'mode' => $mode,
                ]);
            }
            ?>
        </div>
    </div>
</div>