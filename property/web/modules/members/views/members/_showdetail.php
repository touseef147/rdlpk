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
                Name
            </td>
            <td style="border-bottom: dotted">
                <?php echo $model->name; ?>
            </td>
        </tr>
        <tr>
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                Father Name
            </td>
            <td style="border-bottom: dotted">
                <?php echo $model->sodowo; ?>
            </td>
        </tr>
        <tr>
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                CNIC
            </td>
            <td style="border-bottom: dotted">
                <?php echo $model->cnic; ?>
            </td>
        </tr>
    </table>
</div>
