<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\application\Secroles;
use app\models\application\Secmoduleactions;

/* @var $this yii\web\View */
/* @var $model app\models\application\Secrolerights */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="secrolerights-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "security", "title" => "Security"],
            ["link" => "security/secrolerights/index", "title" => "Rights"],
            ["link" => "", "title" => "Update"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

            <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=security/secrolerights/sidebarinput">

                        <?php $form = ActiveForm::begin(['options'=>['class'=>'frminput']]); ?>

                        <?php
                            echo $form->field($model, 'role_id')
                            ->dropDownList(
                                ArrayHelper::map(Secroles::find()->joinWith(['roleType'])->orderBy('role_type_name, role_name ASC')->all(), 'role_id', 
                                            function($model, $defaultValue) {
                                                return $model->role_name.' ('.$model->roleType->role_type_name.')';
                                            }
                                        ),           // Flat array ('id'=>'label')
                                ['prompt'=>'Select a Role']    // options
                            );
                        ?>

                        <?php
                            echo $form->field($model, 'action_id')
                            ->dropDownList(
                                ArrayHelper::map(Secmoduleactions::find()->joinWith(['controller'])->orderBy('controller_name, action_title ASC')->all(), 'action_id', 
                                            function($model, $defaultValue) {
                                            if($model->controller->module == NULL)
                                                return "";
                                            else
                                                return $model->controller->module->module_title . ": " . $model->controller->controller_name." : ".$model->action_title;
                                                //return $model->action_title.' ('.$model->controller->controller_name.', '.$model->controller->module->module_title.')';
                                            }
                                        ),           // Flat array ('id'=>'label')
                                ['prompt'=>'Select an Action']    // options
                            );
                        ?>

                        <?php
                            echo $form->field($model, 'right_status')
                            ->dropDownList(
                                array('1' => 'Active', '0' => 'In-Active'),           // Flat array ('id'=>'label')
                                ['prompt'=>'Select Status']    // options
                            );
                        ?>

                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
            </div>
    </div>

</div>
