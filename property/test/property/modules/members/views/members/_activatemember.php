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

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput', 'enctype' => 'multipart/form-data']])
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group pull-right">
                            <?= Html::submitButton($model->isNewRecord ? 'Activate' : 'Activate', ['class' => $model->isNewRecord ? 'btn btn-success btn-round' : 'btn btn-primary btn-round']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
