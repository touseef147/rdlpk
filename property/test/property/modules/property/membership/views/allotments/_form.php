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
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/membership/allotments/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>
                                    <?= $form->field($model, 'plot_id')->hiddenInput()->label(FALSE) ?>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-medium">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Plot</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <?= $form->field($model, 'plot_id')->hiddenInput()->label(FALSE) ?>
                                    <?=
                                    $this->renderFile(
                                            Yii::getAlias("@app") . '/modules/property/config/views/files/_showdetail.php', [
                                        'model' => \app\models\application\Plots::find()->where(['id' => $model->plot_id])->one(),
                                    ]);
                                    ?>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-medium">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Membership Detail</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <?= $form->field($model, 'ms_no')->textInput(['maxlength' => true]) ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-medium">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Members</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <?= $form->field($model, 'member_id')->hiddenInput()->label(false) ?>
                                    <?=
                                    $this->renderFile(
                                            Yii::getAlias("@app") . '/modules/members/views/members/_showdetail.php', [
                                        'model' => \app\models\application\Members::find()->where(['id' => $model->member_id])->one(),
                                    ]);
                                    ?>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!--                <div class="row">
                    <div class="col-xs-12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-medium">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Receipt</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <?php
                                    //echo $model->plot->application->receipt->receipt_no;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
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
