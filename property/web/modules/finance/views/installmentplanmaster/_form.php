<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\Installmentplanmaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="installmentplanmaster-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "finance", "title" => "Finance"],
            ["link" => "finance/installmentplanmaster/index", "title" => "Installment Plans"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installmentplanmaster/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>

                <div class="row">
                    <div class="col-xs-6">
                        <?php
                        echo $form->field($model, 'project_id')
                                ->dropDownList(
                                        ArrayHelper::map(\app\models\application\Projects::find()->joinWith("permissions")->orderBy("projects.project_name")->where(['project_permissions.user_id' => Yii::$app->user->identity->id])->all(), 'id', 'project_name'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select Project',
                                        ]    // options
                        );
                        ?>

                    </div>
                    <div class="col-xs-3">
                        <?php
                        echo $form->field($model, 'category_id')
                                ->dropDownList(
                                        ArrayHelper::map(app\models\application\Sizecat::find()->all(), 'id', 'size'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select Size']  // options
                        );
                        ?>
                    </div>
                    <div class="col-xs-3">
                        <?php
                        echo $form->field($model, 'plan_land_type')
                                ->dropDownList(
                                        array('1' => 'Residential', '2' => 'Commercial'), ['prompt' => '---',
                                        ]    // options
                        );
                        ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <?php
                        echo $form->field($model, 'plan_development_type')
                                ->dropDownList(
                                        array('1' => 'Land', '2' => 'Development', '3' => 'Common'), ['prompt' => '---',
                                        ]    // options
                        );
                        ?>

                    </div>
                    <div class="col-xs-4">
                        <?= $form->field($model, 'total_amount')->textInput() ?>

                    </div>
                    <div class="col-xs-4">
                        <?= $form->field($model, 'no_of_installments')->textInput() ?>

                    </div>
                </div>
                <?php
                if ($model->plan_id != 0) {
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="widget-box ui-sortable-handle" id="widget-box-1">
                                <div class="widget-header widget-header-large">
                                    <h4 class="widget-title">Installment Details</h4>
                                    <div class="widget-toolbar"> <a class="add_dynamic_row" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installmentplanmaster/dynamicrow" data-rowcount="drcount" data-desttable="dynamic_list" href="#">Add</a> </div>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main no-padding">
                                        <table id="dynamic_list" class="table  table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="center" style="width:30px;">#</th>
                                                    <th>Title</th>
                                                    <th style="width: 150px;">Amount</th>
                                                    <th style="width: 60px;">Gap</th>
                                                    <th style="width: 100px;">Gap Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = -1;

                                                foreach ($modeldetail as $row) {
                                                    $count++;
                                                    ?>
                                                    <tr>
                                                        <td class="center"><?php
                                                            echo $count + 1;
                                                            echo $form->field($row, 'detail_id')->hiddenInput(['name' => 'Installmentplandetail[' . $count . '][detail_id]'])->label(false);
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?= $form->field($row, 'installment_title')->textInput(['name' => 'Installmentplandetail[' . $count . '][installment_title]', 'class' => 'col-xs-12'])->label(false) ?>
                                                        </td>

                                                        <td>
                                                            <?= $form->field($row, 'installment_amount')->textInput(['name' => 'Installmentplandetail[' . $count . '][installment_amount]'])->label(false) ?>
                                                        </td>
                                                        <td>
                                                            <?= $form->field($row, 'gap')->textInput(['name' => 'Installmentplandetail[' . $count . '][gap]'])->label(false) ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo $form->field($row, 'gap_type')
                                                                    ->dropDownList(
                                                                            array('1' => 'Days', '2' => 'Months'), ['prompt' => '---',
                                                                        'name' => 'Installmentplandetail[' . $count . '][gap_type]'
                                                                            ]    // options
                                                                    )->label(false);
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <input type="hidden" value="<?php echo $count; ?>" id="drcount" name="drcount" />
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="widget-toolbox padding-8 clearfix">
                                        <div class=" pull-right"><a class="add_dynamic_row" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/installmentplanmaster/dynamicrow" data-rowcount="drcount" data-desttable="dynamic_list" href="#">Add</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
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
