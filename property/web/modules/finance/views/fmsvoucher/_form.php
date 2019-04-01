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
            ["link" => "finance", "title" => "Finance"],
            ["link" => "finance/fmsvoucher", "title" => "Instruments"],
            ["link" => "", "title" => Html::encode($this->title)],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/sidebarinput">

                <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->baseUrl . '/index.php?r=finance/fmsvoucher/' . ($model->isNewRecord ? 'create' : 'update&id=' . $model->voucher_id), 'options' => ['class' => 'frminput']]); ?>

                <?= ""//Html::errorSummary($model) ?>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-medium">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Instrument Detail</h6>
                                <div class="widget-toolbar">
                                    <?=
                                    $form->field($model, 'amount_type')->dropDownList(['2' => 'Cheque', '1' => 'Cash', '3' => 'PO', '4' => 'Online Deposit'], ['onchange' => ''
                                        . 'if($(this).val()==1) $("#bank_row").hide(); else $("#bank_row").show(); '
                                        . 'if($(this).val()==2) { $(".transdate label").text("Cheque Date"); $(".transno label").text("Cheque No."); } '
                                        . 'if($(this).val()==3) { $(".transdate label").text("PO. Date"); $(".transno label").text("PO. No."); } '
                                        . ''])->label(false)
                                    ?>
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <?php
                                            echo $form->field($model, 'project_id')
                                                    ->dropDownList(
                                                            ArrayHelper::map(\app\models\application\Projects::find()->joinWith("permissions")->orderBy("projects.project_name")->where(['project_permissions.user_id' => Yii::$app->user->identity->id])->all(), 'id', 'project_name'), // Flat array ('id'=>'label')
                                                            [
                                                        'prompt' => 'Select Project',
                                                            ]    // options
                                            );
                                            ?>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <?php
                                            echo $form->field($model, 'sales_center_id')
                                                    ->dropDownList(
                                                            ArrayHelper::map(\app\models\application\Salescenter::find()->joinWith("permissions")->orderBy("sales_center.name")->where(['centers_permissions.user_id' => Yii::$app->user->identity->id])->all(), 'id', 'name'), // Flat array ('id'=>'label')
                                                            ['prompt' => 'Select Center']  // options
                                            );
                                            ?>

                                        </div>
                                        <div class="col-xs-4">
                                            <?= $form->field($model, 'entry_date')->textInput(['class' => 'date-picker']) ?>

                                        </div>
                                    </div>
                                    <div class="row <?php if ($model->amount_type != 2) echo "hidecontent"; ?>" id="bank_row">
                                        <div class="col-xs-4">
                                            <?php
                                            echo $form->field($model, 'bank_id')
                                                    ->dropDownList(
                                                            ArrayHelper::map(\app\models\application\Fmsbanks::find()->orderBy("bank_title")->all(), 'bank_id', 'bank_title'), // Flat array ('id'=>'label')
                                                            ['prompt' => 'Select Bank']  // options
                                            );
                                            ?>

                                        </div>
                                        <div class="col-xs-4 transdate">
                                            <?= $form->field($model, 'transaction_date')->textInput(['class' => 'date-picker']) ?>

                                        </div>
                                        <div class="col-xs-4 transno">
                                            <?= $form->field($model, 'voucher_sr_no')->textInput(['maxlength' => true]) ?>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4 amountfield <?php if ($model->amount_type == 5) echo "hidecontent"; ?>">
                                            <?= $form->field($model, 'amount')->textInput()->label('Instrument Amount') ?>

                                        </div>
                                        <div class="narrationfield <?php if ($model->amount_type == 5)
                                                echo "col-xs-12";
                                            else
                                                echo "col-xs-8";
                                            ?>">
<?= $form->field($model, 'narration')->textInput() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Member Detail</h6>

                                <div class="widget-toolbar">
                                    <div class="red lazycontent" id="dealerledgerbalance" data-url="<?php echo Yii::$app->urlManager->baseUrl . "/index.php?r=members/dealers/ledger/showbalance&id=" . $modelmember->id . "&type=Dealer" ?>"></div>
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <?php $model->member_id = $modelmember->id; ?>
                                    <?= $form->field($model, 'member_id')->hiddenInput()->label(FALSE) ?>
                                    <?=
                                    $this->renderFile(
                                            Yii::getAlias("@app") . '/modules/members/views/members/showrecord.php', [
                                        'model' => $modelmember
                                    ]);
                                    ?>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title"><i class="icon-th-large"></i> Receipt Detail</h6>

                                <div class="widget-toolbar">
                                    <div class="widget-menu">
                                        <a href="#" data-action="settings" data-toggle="dropdown">
                                            Add
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
                                            <li>
                                                <a class="add_dynamic_content" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/dynamicform&mode=entry" data-rowcount="drcount" data-myrowcount="drcountform" data-desttable="voucher_detail" data-extras="<?php echo $modelmember->id; ?>" href="#">Form</a>
                                            </li>

                                            <li>
                                                <a class="add_dynamic_content" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/dynamicinstallment&mode=entry" data-rowcount="drcount" data-myrowcount="drcountinstallment" data-desttable="voucher_detail" data-extras="<?php echo $modelmember->id; ?>" href="#">Installment</a>
                                            </li>

                                            <li>
                                                <a class="add_dynamic_content" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/dynamictransfer&mode=entry" data-rowcount="drcount" data-myrowcount="drcounttransfer" data-desttable="voucher_detail" data-extras="<?php echo $modelmember->id; ?>" href="#">Transfer</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div id="voucher_detail">
                                        <?php
                                        $records = 0;
                                        $receiptno = 0;
                                        $receiptinstno = 0;
                                        $receipttransno = 0;
                                        $totalamount = 0;

                                        if ($modelreceipts != NULL) {
                                            foreach ($modelreceipts as $row) {
                                                if ($row->transaction_source == 1) {
                                                    echo $this->render('_dynamicform', [
                                                        'id' => $records,
                                                        'id2' => $receiptno,
                                                        'memberid' => $model->member_id,
                                                        'receipt' => $row,
                                                        'receiptdetail' => $modelreceiptdetail,
                                                        'records' => $records,
                                                        'mode' => 'entry',
                                                        'print' => 'no',
                                                    ]);
                                                    $receiptno+=1;
                                                } else if ($row->transaction_source == 2) {
                                                    echo $this->render('_dynamicinstallment', [
                                                        'id' => $records,
                                                        'id2' => $receiptno,
                                                        'memberid' => $model->member_id,
                                                        'receipt' => $row,
                                                        'receiptdetail' => $modelreceiptdetail,
                                                        'records' => $records,
                                                        'mode' => 'entry',
                                                        'print' => 'no',
                                                    ]);
                                                    $receiptinstno+=1;
                                                } else {
                                                    echo $this->render('_dynamictransfer', [
                                                        'id' => $records,
                                                        'id2' => $receiptno,
                                                        'memberid' => $model->member_id,
                                                        'receipt' => $row,
                                                        'receiptdetail' => $modelreceiptdetail,
                                                        'records' => $records,
                                                        'mode' => 'entry',
                                                        'print' => 'no',
                                                    ]);
                                                    $receipttransno+=1;
                                                }

                                                foreach ($modelreceiptdetail as $detail) {
                                                    if ($detail->plot_id == $row->plot_id) {
                                                        $records+=1;
                                                        $totalamount += $detail->paidamount;
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                    <input type="hidden" value="-1" id="drcount" name="drcount" />
                                    <input type="hidden" value="<?php echo intval($receiptno) - 1 ?>" id="drcountform" name="drcountform" />
                                    <input type="hidden" value="<?php echo intval($receiptinstno) - 1 ?>" id="drcountinstallment" name="drcountinstallment" />
                                    <input type="hidden" value="<?php echo intval($receipttransno) - 1 ?>" id="drcounttransfer" name="drcounttransfer" />
                                    <input type="hidden" value="<?php echo intval($records) - 1; ?>" id="drinstpaymentcount" name="drinstpaymentcount" />
                                </div>
                                <div class="widget-toolbox padding-8 clearfix">
                                    <div class="pull-left">
                                        <strong>Total Amount:</strong>  <span id="runningtotalpaid">
                                            <?php
                                            if (count($modelreceiptdetail) > 0) {
                                                echo number_format($totalamount);
//                                                echo number_format(array_sum(array_map(function($item) {
//                                                                    return $item['paidamount'];
//                                                                }, $modelreceiptdetail))); //array_sum(array_column($installpayments,'paidamount'));
                                            }
                                            ?>
                                        </span>
                                    </div>
                                    <div class=" pull-right">
                                        <div class="widget-menu">
                                            <a href="#" data-action="settings" data-toggle="dropdown">
                                                Add
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
                                                <li>
                                                    <a class="add_dynamic_content" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/dynamicform&mode=entry" data-rowcount="drcount" data-myrowcount="drcountform" data-extras="<?php echo $modelmember->id; ?>" data-desttable="voucher_detail" href="#">Form</a>
                                                </li>

                                                <li>
                                                    <a class="add_dynamic_content" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/dynamicinstallment&mode=entry" data-rowcount="drcount" data-myrowcount="drcountinstallment" data-extras="<?php echo $modelmember->id; ?>" data-desttable="voucher_detail" href="#">Installment</a>
                                                </li>

                                                <li>
                                                    <a class="add_dynamic_content" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/fmsvoucher/dynamictransfer&mode=entry" data-rowcount="drcount" data-myrowcount="drcounttransfer" data-desttable="voucher_detail" href="#">Transfer</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (!$model->isNewRecord) {
                    echo \app\components\Commentbox::widget([
                        'title' => 'Comments',
                        'dataurl' => 'finance/fmsvoucher/comments&id=' . $model->voucher_id,
                        'submiturl' => 'finance/fmsvoucher/updatecomments',
                        'parentval' => $model->voucher_id,
                        'allowadd' => 1,
                    ]);
                }
                ?>
                <br />
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group pull-right">
<?= Html::submitInput($model->isNewRecord ? 'Create' : 'Update', ['name' => 'submit', 'class' => $model->isNewRecord ? 'btn btn-success multiplesubmitbuttons' : 'btn btn-primary btn-round multiplesubmitbuttons']) ?>&nbsp;&nbsp;&nbsp;
                <?= Html::submitInput('Submit', ['name' => 'submit', 'class' => 'btn btn-danger btn-round multiplesubmitbuttons']) ?>
                        </div>
                    </div>
                </div>
<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
<?php
//echo $this->renderFile(Yii::getAlias("@app").'\modules\members\views\members\_find.php', ['model'=> new app\models\application\Members()]);
?>