<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$appid = (isset($receipt) && $receipt != NULL ? $receipt->application_id : NULL);
$plotid = (isset($receipt) && $receipt != NULL ? $receipt->plot_id : NULL);
$searchcolumn = (isset($amounttype) && $amounttype != NULL && $amounttype != 5 ? "member_id" : "dealer_id");
$modeldd = app\models\application\Propertyapplication::find()->where([$searchcolumn => $memberid])->andFilterWhere(['or', ['=', 'receipt_entered', '0'], ['=', 'application_id', $appid]])->all();

if ($modeldd == null || count($modeldd) == 0) {
    ?>
    <div class="widget-box transparent ui-sortable-handle" id="widget-box-12">
        <div class="widget-header">
            <h4 class="widget-title lighter">Registration Form</h4>
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
        <h4 class="widget-title lighter">
            <?php
            
            if($appid == NULL || $mode== "entry"){
                ?>
            <input type="checkbox" id="Fmsvoucherplotdetail_<?php echo $id2; ?>_is_selected" name="Fmsvoucherplotdetail[<?php echo $id2; ?>][is_selected]" checked="checked" value="1" onclick="if(this.checked) this.value = 1; else this.value =0;">&nbsp;
            <?php
            }
            ?>
            Application Form
        </h4>

        <div class="widget-toolbar no-border">
            <?php
            if ($appid == NULL || $mode == "entry") {
                echo "Form No.";
                echo Html::dropDownList('Fmsvoucherplotdetail[' . $id2 . '][application_id]', $appid, ArrayHelper::map($modeldd, 'application_id', 'application_no'), // Flat array ('id'=>'label')
                        ['prompt' => '---',
                    'value' => (isset($receipt) && $receipt != NULL ? $receipt->application_id : ""),
                    'onchange' => ' 
                                $.get( "' . Url::toRoute('/finance/fmsvoucher/dynamicformcontent') . '", { id: $(this).val(), index: ' . $id . ', mode: "' . $mode . '" } )
                                    .done(function( data ) {
                                        $( "#formcontent' . $id2 . '" ).html( data );
                                    }
                                );
                                $.get( "' . Url::toRoute('/property/application/propertyapplication/filedetails') . '", { id: $(this).val() } )
                                    .done(function( data ) {
                                        $( "#Fmsvoucherplotdetail_' . $id2 . '_plot_id" ).val( data[0] );
                                    }
                                );
                                ',
                        ]    // options
                );
            } else {
                echo Html::hiddenInput('Fmsvoucherplotdetail[' . $id2 . '][application_id]', $appid);

                if (isset($print) && $print == "yes") {
                    ?>
                    <a href="#">
                        Print
                    </a>
                    <?php
                }
            }

            echo Html::hiddenInput('Fmsvoucherplotdetail[' . $id2 . '][plot_id]', $plotid, ['id' => 'Fmsvoucherplotdetail_' . $id2 . '_plot_id']);
            ?>
        </div>
    </div>

    <div class="widget-body">
        <div id="formcontent<?php echo $id2; ?>" class="widget-main padding-12">
            <?php
            if (isset($receipt) && $receipt != NULL) {
                echo $this->render('_dynamicformcontent', [
                    'idx' => $id2,
                    'id' => $id,
                    'model' => app\models\application\Propertyapplication::find()->where(['application_id' => $receipt->plot->application_id])->one(),
                    'receipt' => $receipt,
                    'receiptdetail' => $receiptdetail,
                    'records' => $records,
                    'mode' => $mode,
                    'searchcolumn' => $searchcolumn,
                ]);
            }
            ?>
        </div>
    </div>
</div>