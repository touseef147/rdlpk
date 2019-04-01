<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Propertyapplication */
/* @var $form yii\widgets\ActiveForm */

$this->title = "New Instrument";
?>

<div class="propertyapplication-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "finance/fmsvoucher", "title" => "Instruments"],
            ["link" => "", "title" => Html::encode($this->title)],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/propertyapplication/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>


                <div class="row">
                    <div class="col-xs-12">
                        <table>
                            <tr>
                                <td style="width: 100px;">
                                    Deposited By
                                </td>
                                <td>
                                    <select id="membertype" name="membertype" onchange="if ($(this).val() == 1) {
                                                $('#nonmemberrow').hide();
                                                $('#memberrow').show();
                                                $('#name').val('');
                                            } else {
                                                $('#nonmemberrow').show();
                                                $('#memberrow').hide();
                                                $('#cnic').val('');
                                            }">
                                        <option value="1">Member</option>
                                        <option value="2">Non Member</option>
                                    </select>
                                </td>
                            </tr>
                            <tr id="memberrow">
                                <td style="width: 100px;">
                                    CNIC
                                </td>
                                <td>
                                    <input placeholder="Enter CNIC" class="form-control commentstextbox" autofocus="autofocus" name="cnic" id="cnic" style="background-color: lightgoldenrodyellow" type="text" value="<?php echo $model->cnic; ?>">
                                    <?= Html::error($model, 'cnic', ['class' => 'help-block']) ?>
                                </td>
                            </tr>
                            <tr id="nonmemberrow" class="hidecontent">
                                <td style="width: 100px;">
                                    Person Name
                                </td>
                                <td>
                                    <input placeholder="Enter Name" class="form-control" autofocus="autofocus" name="name" id="name" style="background-color: lightgoldenrodyellow" type="text" value="<?php echo $model->name; ?>">
                                    <?= Html::error($model, 'name', ['class' => 'help-block']) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>

                                </td>
                                <td style="text-align: right;">
                                    <?= Html::submitButton($model->isNewRecord ? 'Proceed' : 'Proceed', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
