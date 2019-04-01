<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\Propertyapplication */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Submit Form';
?>

<div class="propertyapplication-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "property", "title" => "Property"],
            ["link" => "property/application/propertyapplication", "title" => "Forms"],
            ["link" => "", "title" => "Submit"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>


        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/application/propertyapplication/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput', 'enctype' => 'multipart/form-data']]); ?>
                <?= $form->field($model, 'application_id')->hiddenInput()->label(FALSE) ?>
                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Form No.</td>
                        <td style="border-bottom: dotted"><?= $model->application_no ?></td>
                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Date</td>
                        <td style="border-bottom: dotted"><?= $model->application_date ?></td>
                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Against</td>
                        <td style="border-bottom: dotted"><?= $model->property_against ?></td>
                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Status</td>
                        <td style="border-bottom: dotted"><?= $model->application_status ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Project</td>
                        <td colspan="3" style="border-bottom: dotted"><?= $model->project->project_name ?></td>
                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Sales Center</td>
                        <td colspan="3" style="border-bottom: dotted"><?= $model->salecenter->name ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">Dealer</td>
                        <td colspan="7" style="border-bottom: dotted"><?= $model->dealer_id ?></td>
                    </tr>
                </table>
                <table style="width: 100%;">
                    <tr>
                        <td style="padding: 5px; vertical-align: top;">
                            <div class="widget-box">
                                <div class="widget-header widget-header-small">
                                    <h6 class="widget-title bigger"><i class="icon-th-large"></i> Property Detail</h6>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                                                    Property Type
                                                </td>
                                                <td style="border-bottom: dotted">
                                                    <?php echo $model->property_type; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                                                    Property Size
                                                </td>
                                                <td style="border-bottom: dotted">
                                                    <?php echo $model->property_size; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                                                    Installment Plan
                                                </td>
                                                <td style="border-bottom: dotted">
                                                    <?php echo $model->installment_plan; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 5px; width: 50%; vertical-align: top;">
                            <div class="widget-box">
                                <div class="widget-header widget-header-small">
                                    <h6 class="widget-title bigger"><i class="icon-th-large"></i> Member Detail</h6>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                                                    Name
                                                </td>
                                                <td style="border-bottom: dotted">
                                                    <?php echo $model->member->name; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                                                    Father Name
                                                </td>
                                                <td style="border-bottom: dotted">
                                                    <?php echo $model->member->sodowo; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                                                    CNIC
                                                </td>
                                                <td style="border-bottom: dotted">
                                                    <?php echo $model->member->cnic; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>


                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Submit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
