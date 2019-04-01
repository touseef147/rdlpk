<?php
use app\components\Breadcrumb;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\Seccontroller */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seccontroller-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "security", "title" => "Security"],
            ["link" => "security/seccontroller/index", "title" => "Controllers"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/seccontroller/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>

                <div class="row">
                    <div class="col-xs-12">
                        <?php
                        echo $form->field($model, 'module_id')
                                ->dropDownList(
                                        ArrayHelper::map(\app\models\application\Secmodules::find()->all(), 'module_id', 'module_title'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select a Module']    // options
                        );
                        ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?= $form->field($model, 'controller_code')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?= $form->field($model, 'controller_name')->textInput(['maxlength' => true, 50]) ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?= $form->field($model, 'sort_order')->textInput() ?>

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
