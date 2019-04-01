<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\InstallpaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Installment Plan Details';


$colnameclass = "";

/*
  if(isset($dataProvider->sort->orders["role_type_name"]))
  {
  if($dataProvider->sort->orders["role_type_name"] ==4)
  {
  $colnameclass="sorting_asc";
  }
  if($dataProvider->sort->orders["role_type_name"] ==3)
  {
  $colnameclass="sorting_desc";
  }
  }
 */
$depositallowd = false;
$verificationallowd = false;
$approvalallowed = false;

$multiplerights = TRUE;

//if (array_key_exists("finance/fmsvoucher/centerverification", $myrights)) {
//    $depositallowd = true;
//}
//
//if (array_key_exists("finance/fmsvoucher/financeverification", $myrights)) {
//    $verificationallowd = true;
//}
//
//if (array_key_exists("finance/fmsvoucher/financeapproval", $myrights)) {
//    $approvalallowed = true;
//}
//
//if ($depositallowd || $verificationallowd || $approvalallowed) {
//    $multiplerights = true;
//}
?>
<div class="installmentplanmaster-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => str_replace("%26", "&", $sourcepage), "title" => "Back"],
            //["link" => "finance/installmentplanmaster/index", "title" => "Installment Plans"],
            //["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>
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
                            <?= $form->field($plot, 'id')->hiddenInput()->label(FALSE) ?>
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
                            <?=
                            $this->renderFile(
                                    Yii::getAlias("@app") . '/modules/members/views/members/_showdetail.php', [
                                'model' => \app\models\application\Members::find()->where(['id' => $plot->currentmembership->member_id])->one(),
                            ]);
                            ?>                                    
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12">
                <div class="widget-box ui-sortable-handle" id="widget-box-1">
                    <div class="widget-header widget-header-large">
                        <h4 class="widget-title">Installment Details</h4>
                        <div class="widget-toolbar"> <a class="add_dynamic_row" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/dynamicrow" data-rowcount="drcount" data-desttable="dynamic_list" href="#">Add</a> </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="dynamic_list" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th style="width: 100px;">Due Date</th>
                                        <th style="width: 100px;">Due Amount</th>
                                        <th>Remarks</th>
                                        <th style="width:40px;">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //$rows = $dataProvider->getModels();  ?>
                                    <?php
                                    $count = -1;
                                    $totalamount = 0;

                                    foreach ($model as $row) {
                                        $totalamount += $row->dueamount;

                                        if ($row->paidamount != NULL && $row->paidamount != 0) {
                                            ?>
                                            <tr>
                                                <td align="left">
                                                    <?= $row->lab ?>
                                                </td>
                                                <td align="left">
                                                    <?= $row->showduedate ?>
                                                </td>
                                                <td align="right">
                                                    <?= $row->dueamount ?>
                                                </td>
                                                <td align="left">
                                                    <?= $row->remarks ?>
                                                </td>
                                                <td class="center">
                                                </td>
                                            </tr>
                                            <?php
                                        } else {
                                            $count++;
                                            ?>
                                            <tr>
                                                <td align="left">
                                                    <?=
                                                    Html::hiddenInput('Installpayment[' . $count . '][id]', $row->id)

//$form->field($row, 'lab')->textInput(['name' => 'Installmentplandetail[' . $count . '][lab]', 'class' => 'col-xs-12'])->label(false) 
                                                    ?>
                                                    <?=
                                                    Html::textInput('Installpayment[' . $count . '][lab]', $row->lab)
                                                    //$form->field($row, 'lab')->textInput(['name' => 'Installpayment[' . $count . '][lab]', 'class' => 'col-xs-12'])->label(false)
                                                    ?>
                                                </td>
                                                <td align="left">
                                                    <?=
                                                    Html::textInput('Installpayment[' . $count . '][due_date]', $row->showduedate, ['class' => 'date-picker', 'style' => 'width: 100px;'])
//                                                    $form->field($row, 'due_date')->textInput(['name' => 'Installpayment[' . $count . '][due_date]', 'class' => 'col-xs-12 date-picker', 'style' => 'width: 100px;'])->label(false)
                                                    ?>
                                                </td>
                                                <td align="right">
                                                    <?=
                                                    Html::textInput('Installpayment[' . $count . '][dueamount]', $row->dueamount, ['class' => 'right-align', 'style' => 'width: 100px;'])
                                                    ?>
                                                </td>
                                                <td align="left">
                                                    <?=
                                                    Html::textInput('Installpayment[' . $count . '][remarks]', $row->remarks)
                                                    ?>
                                                </td>
                                                <td class="center">
                                                    <input type="checkbox" value="0" onclick="javascript: if (this.checked)
                                                                this.value = '1';
                                                            else
                                                                this.value = '0';" name="Installpayment[<?php echo $count; ?>][removerecord]" id="Installpayment-<?php echo $count; ?>_removerecord" />
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <tr style="background-color: rgb(240, 240, 240)">
                                        <td align="left">
                                            <strong>Totals</strong>
                                        </td>
                                        <td align="left">

                                        </td>
                                        <td align="right">
                                            <?= number_format($totalamount) ?>
                                        </td>
                                        <td align="left">
                                        </td>
                                        <td class="center">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" value="<?php echo $count; ?>" id="drcount" name="drcount" />

                        </div>
                        <div class="widget-toolbox padding-8 clearfix">
                            <div class=" pull-right"><a class="add_dynamic_row" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installpayment/dynamicrow" data-rowcount="drcount" data-desttable="dynamic_list" href="#">Add</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group pull-right">
                    <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
