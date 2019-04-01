<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$serial = $id+1;
?>

<tr>
    <td class="center"><?php
        echo $serial;
        ?>
        <?= Html::hiddenInput('Installmentplandetail[' . $id . '][detail_id]', '0') ?>
    </td>
    <td>
        <?= Html::textInput('Installmentplandetail[' . $id . '][installment_title]', 'Installment No. ' . $serial ) ?>
    </td>

    <td>
        <?= Html::textInput('Installmentplandetail[' . $id . '][installment_amount]', '0') ?>
    </td>
    <td>
        <?= Html::textInput('Installmentplandetail[' . $id . '][gap]', '0') ?>
    </td>
    <td>
        <?php
        echo Html::dropDownList('Installmentplandetail[' . $id . '][gap_type]', null, array('1' => 'Days', '2' => 'Months'), 
                ['prompt' => '---']    // options
        );
        ?>
    </td>
</tr>
