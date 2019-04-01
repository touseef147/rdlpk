<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Propertymemberships */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="propertymemberships-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
//            ["link" => "property/membership/default/index", "title" => "Memberships Control Panel"],
            ["link" => "property/membership/allotments/index", "title" => "Allotments"],
            ["link" => "", "title" => Html::encode($this->title)],
        ],
    ])
    ?>

    <div class="page-content">

            <div class="page-header">
                    <h1>
                        <?= Html::encode($this->title) ?>
                            <small>
                                    <i class="ace-icon fa fa-angle-double-right"></i>
                                                                </small>
                    </h1>
            </div><!-- /.page-header -->

            <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/transfers/sidebarinput">

                        <?php $form = ActiveForm::begin(['options'=>['class'=>'frminput']]); ?>

                                            <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'plot_id')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'member_id')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'ms_no')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'ms_status')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'created_on')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'modified_on')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'is_joint')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'parent_ms_id')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'user_id')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                            <?= $form->field($model, 'is_active')->textInput() ?>

                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                </div>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
            </div>
    </div>

</div>
