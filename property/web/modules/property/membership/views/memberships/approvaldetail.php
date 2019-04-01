<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\application\Fmsvoucher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fmsvoucher-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
//            ["link" => "property/membership/default/index", "title" => "Memberships Control Panel"],
            ["link" => "property/membership/memberships/financever", "title" => "Memberships"],
            ["link" => "", "title" => "Membership Approval"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => "Membership Approval", "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>

                <?= ""//Html::errorSummary($model) ?>

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
                                <div class="widget-toolbar">
                                    <strong class="red"><?php echo $model->completecode; ?></strong>
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row">
                                        <div class="col-xs-12">
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
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="widget-box transparent">
                            <div class="widget-header widget-header-flat">
                                <h4 class="widget-title lighter">
                                    <i class="ace-icon fa fa-signal"></i>
                                    Approval
                                </h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main padding-4">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="widget-box widget-color-blue3" id="widget-box-7">
                                                <div class="widget-header widget-header-small">
                                                    <h6 class="widget-title smaller">Submission Details</h6>
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        <table style="width: 100%;" >
                                                            <tr>
                                                                <td style="width: 80px; height: 30px;">
                                                                    Date
                                                                </td>
                                                                <td style="border-bottom: dotted;">
                                                                    <?php echo $model->showsubmissiondate; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="vertical-align: top;">
                                                                    Remarks
                                                                </td>
                                                                <td style="height: 83px; vertical-align: top;">
                                                                    <?php echo ""; //$model->center_remarks  ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>                                        
                                        </div>                    
                                        <div class="col-xs-4">
                                            <div class="widget-box widget-color-blue3" id="widget-box-7">
                                                <div class="widget-header widget-header-small">
                                                    <h6 class="widget-title smaller">Finance Verification</h6>
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        <table style="width: 100%;" >
                                                            <tr>
                                                                <td style="width: 80px; height: 30px;">
                                                                    Date
                                                                </td>
                                                                <td style="border-bottom: dotted;">
                                                                    <?php echo $model->showverificationdate; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="vertical-align: top;">
                                                                    Remarks
                                                                </td>
                                                                <td style="height: 83px; vertical-align: top;">
                                                                    <?php echo $model->verification_remarks  ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>                                        
                                        </div>                    
                                        <div class="col-xs-4">
                                            <div class="widget-box widget-color-blue3" id="widget-box-7">
                                                <div class="widget-header widget-header-small">
                                                    <h6 class="widget-title smaller">Approval</h6>
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        <?php
                                                        echo $form->field($model, 'approval_remarks')->textarea()->label('Remarks');
                                                        ?>
                                                    </div>
                                                    <div class="widget-toolbox padding-8 clearfix">
                                                        <!--                                                        <button class="btn btn-xs btn-danger pull-left">
                                                                                                                    <i class="ace-icon fa fa-times"></i>
                                                                                                                    <span class="bigger-110">I don't accept</span>
                                                                                                                </button>-->

                                                        <button class="btn btn-xs btn-success pull-right multiplesubmitbuttons" type="submit" name="submit" value="submit">
                                                            <span class="bigger-110">Approve</span>

                                                            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                        </button>
                                                    </div>                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>                    
                                </div>

                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div>                    
                </div>
            </div>
        </div>

        <?php
        if (!$model->isNewRecord) {
            echo \app\components\Commentbox::widget([
                'title' => 'Comments',
                'dataurl' => 'property/membership/memberships/comments&id=' . $model->ms_id,
                'submiturl' => 'property/membership/memberships/updatecomments',
                'parentval' => $model->ms_id,
                'allowadd' => 1,
            ]);
        }
        ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
//echo $this->renderFile(Yii::getAlias("@app").'\modules\members\views\members\_find.php', ['model'=> new app\models\application\Members()]);
?>