<?php

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\application\City;
use app\models\application\Country;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Members */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="members-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "members/members/index", "title" => "Members"],
            ["link" => "", "title" => Html::encode($this->title)],
        ],
    ])
    ?>

    <div class="page-content">
        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/dealers/dealers/update&id=<?php echo $model->parent_id ?>" class="ajaxlink pull-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput', 'enctype' => 'multipart/form-data']])
                ?>
                <div class="row">
                    <div class="col-xs-6">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    </div>
                    <div class="col-xs-6">
                        <?= $form->field($model, 'sodowo')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">

                        <?= $form->field($model, 'dob')->textInput(['class' => 'date-picker']) ?>

                    </div>


                    <div class="col-xs-3">
                        <?= $form->field($model, 'cnic')->textInput(['maxlength' => true]) ?>

                    </div>

                    <div class="col-xs-3">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                    </div>

                    <div class="col-xs-3">
                        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <?php
                        echo $form->field($model, 'country_id')
                                ->dropDownList(
                                        ArrayHelper::map(Country::find()->all(), 'id', 'country'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select a Country',
                                    'onchange' => ' 
                                                    $.get( "' . Url::toRoute('/members/members/ddcontrollercities') . '", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                            $( "#' . Html::getInputId($model, 'city_id') . '" ).html( data );
                                                        }
                                                    );',
                                        ]    // options
                        );
                        ?>
                    </div>
                    <div class="col-xs-3">
                        <?php
                        echo $form->field($model, 'city_id')
                                ->dropDownList(
                                        ArrayHelper::map(City::find()->where(['country_id'=>$model->country_id])->all(), 'id', 'city'), // Flat array ('id'=>'label')
                                        // Flat array ('id'=>'label')
                                        ['prompt' => 'Select a City']    // options
                        );
                        ?>
                    </div>



                    <div class="col-xs-6">

                        <?= $form->field($model, 'image')->fileInput() ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group pull-right">
                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-round' : 'btn btn-primary btn-round']) ?>
                        </div>
                    </div>
                </div>
                <?php
                if (!$model->isNewRecord) {
                    ?>
                    <br />
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="widget-box">
                                <div class="widget-header widget-header-small">
                                    <h6 class="widget-title bigger"><i class="icon-th-large"></i> Nominees</h6>

                                    <div class="widget-toolbar">
                                        <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/createchild&id=<?php echo $model->id; ?>" class="ajaxlink">Add</a>
                                    </div>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main no-padding">
                                        <table id="simple-table" class="table  table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="center" style="width:40px;">      </th>
                                                    <th>ID</th>
                                                    <th>Name</th>

                                                    <th>CNIC</th>
                                                    <th>Picture</th>
                                                    <th>Address</th>
                                                    <th style="width:40px;">      </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $rows = $model->nominees; ?>
                                                <?php foreach ($rows as $row) { ?>
                                                    <tr>
                                                        <td class="center">      </td>
                                                        <td align="left"><a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/updatechild&id=<?php echo $row->id; ?>" class="ajaxlink"><?php echo $row->id; ?></a></td>
                                                        <td align="left"><a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/updatechild&id=<?php echo $row->id; ?>" class="ajaxlink"><?php echo $row->name; ?></a></td>

                                                        <td align="left"><?php echo $row->cnic; ?>      </td>
                                                        <td align="left"><?php echo Html::img('uploads/members/pictures/' . $row->image, ['height' => '100']); ?>     </td>
                                                        <td align="left"><?php echo $row->address; ?>      </td>
                                                        <td class="center">
                                                            <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/updatechild&id=<?php echo $row->id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
                                                                <span class="blue">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </span>
                                                            </a>
                                                            <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/deletechild&id=<?php echo $row->id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
                                                                <span class="red">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
