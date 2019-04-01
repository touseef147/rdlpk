<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Installpayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="installpayment-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => str_replace("%26", "&", $sourcepage), "title" => "Back"],
//            ["link" => "finance", "title" => "Finance"],
  //          ["link" => "finance/installpayment/index", "title" => "Installments"],
    //        ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>
        <?= Html::hiddenInput('sourcepage', str_replace("&", "%26", $sourcepage)) ?>

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
                                        'model' => \app\models\application\Plots::find()->where(['id' => $plot->id])->one(),
                                    ]);
                                    ?>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-medium">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Member Detail</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <?= $form->field($model, 'mem_id')->hiddenInput()->label(FALSE) ?>
                                    <?=
                                    $this->renderFile(
                                            Yii::getAlias("@app") . '/modules/members/views/members/_showdetail.php', [
                                        'model' => \app\models\application\Members::find()->where(['id' => $memberid])->one(),
                                    ]);
                                    ?>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">                    
                    <div class="col-xs-6">
                        <?= $form->field($model, 'lab')->textInput(['maxlength' => true])->label('Description') ?>

                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'due_date')->textInput(['class' => 'date-picker', 'maxlength' => true]) ?>

                    </div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'dueamount')->textInput(['maxlength' => true]) ?>
                    </div>


                </div>
                <div class="row"> 
                    <div class="col-xs-12">
                        <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>

                    </div>

                </div>

                <div class="row">
                    <div class="row">
                        <div class="col-xs-3">
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
