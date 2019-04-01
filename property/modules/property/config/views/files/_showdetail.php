<?php

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\application\Country;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\application\Members */
/* @var $form yii\widgets\ActiveForm */
?>
<?= Html::activeInput('hidden', $model, 'id', ['class' => '']) ?>

<div class="padding-8" style="padding: 8px 8px;">
    <table style="width: 100%;">
        <tr>
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                File No
            </td>
            <td style="border-bottom: dotted">
                <?php echo $model->completecode; ?>
            </td>
        </tr>
        <tr>
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                Dimension
            </td>
            <td style="border-bottom: dotted">
                <?php echo $model->plot_size; ?>
            </td>
        </tr>
        <tr>
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                Size
            </td>
            <td style="border-bottom: dotted">
                <?php echo $model->sizeCat->size; ?>
            </td>
        </tr>
    </table>
</div>
