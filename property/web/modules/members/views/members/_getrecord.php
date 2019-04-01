<?php

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\application\Country;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\application\Members */
/* @var $form yii\widgets\ActiveForm */
?>
<?= Html::activeInput('hidden', $modelnominee, 'id', ['class' => '']) ?>
<?= Html::activeInput('hidden', $modelnominee, 'parent_id', ['class' => '']) ?>
<?= ""//Html::input('hidden', 'Nominee[id]', $modelnominee->id, ['class' => '']) ?>

<div class="padding-8" style="padding: 8px 8px;">
    <h3 class="row header smaller lighter blue">
        <span class="col-sm-7">
            <i class="ace-icon fa fa-th-large"></i>
            Member Details
        </span><!-- /.col -->

    </h3>

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

    <h3 class="row header smaller lighter blue">
        <span class="col-sm-7">
            <i class="ace-icon fa fa-th-large"></i>
            Nominee Details
        </span><!-- /.col -->

    </h3>

    <table style="width: 100%;">
        <tr>
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                Name
            </td>
            <td style="border-bottom: dotted">
                <?php echo $modelnominee->name; ?>
            </td>
        </tr>
        <tr>
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                Father Name
            </td>
            <td style="border-bottom: dotted">
                <?php echo $modelnominee->sodowo; ?>
            </td>
        </tr>
        <tr>
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                CNIC
            </td>
            <td style="border-bottom: dotted">
                <?php echo $modelnominee->cnic; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="form-group pull-right" style="padding-top: 10px;">
                    <button type="button" class="btn btn-primary btn-white btn-round btnsubmitsubpage">
                        Attach
                        <i class="ace-icon fa fa-arrow-right icon-on-right bigger-125"></i>
                    </button>
                </div>
            </td>
        </tr>
    </table>
</div>
