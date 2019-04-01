<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\Propertyapplication */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="propertyapplication-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "finance", "title" => "Finance"],
            ["link" => "", "title" => "Property Application"],
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
                    <div class="col-xs-6">
                        <?php
                        echo $form->field($model, 'project_id')
                                ->dropDownList(
                                        ArrayHelper::map(\app\models\application\Projects::find()->joinWith("permissions")->orderBy("projects.project_name")->where(['project_permissions.user_id'=> Yii::$app->user->identity->id])->all(), 'id', 'project_name'),           // Flat array ('id'=>'label')
                                        ['prompt' => 'Select Project',
                                        ]    // options
                                );
                        ?>

                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $form->field($model, 'sales_center_id')
                                ->dropDownList(
                                        ArrayHelper::map(\app\models\application\Salescenter::find()->joinWith("permissions")->orderBy("sales_center.name")->where(['centers_permissions.user_id' => Yii::$app->user->identity->id])->all(), 'id', 'name'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select Center']  // options
                                );
                        ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <?= $form->field($model, 'application_no')->textInput(['maxlength' => true]) ?>

                    </div>
                    <div class="col-xs-6">
                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'application_date')->textInput() ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Member Details</h4>
                        <?= $form->field($model, 'member_id')->hiddenInput()->label(FALSE) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <?= $form->field($modelmember, 'name')->textInput() ?>

                    </div>
                    <div class="col-xs-6">
                        <?= $form->field($modelmember, 'sodowo')->textInput() ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <?= $form->field($modelmember, 'cnic')->textInput() ?>

                    </div>
                    <div class="col-xs-4">
                        <?= $form->field($modelmember, 'phone')->textInput() ?>

                    </div>
                    <div class="col-xs-4">
                        <?= $form->field($modelmember, 'email')->textInput() ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Property Details</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <?= $form->field($model, 'property_type')->textInput() ?>

                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'property_size')->textInput() ?>

                    </div>
                    <div class="col-xs-6">
                        <?= $form->field($model, 'dealer_id')->textInput() ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Nominee</h4>
                        <?= $form->field($model, 'nominee_id')->hiddenInput()->label(FALSE) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?= $form->field($modelmember, 'name')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Payment Details</h4>
                        <?= $form->field($model, 'voucher_id')->hiddenInput()->label(FALSE) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">

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
