<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//use yii\captcha\Captcha;

$this->title = 'Member Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$form = ActiveForm::begin([
                //'id' => 'login-form',
                //'options' => ['class' => 'form-horizontal'],
                //'fieldConfig' => [
                //'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                //'labelOptions' => ['class' => 'col-lg-1 control-label'],
                //],
        ]);
?>
<div class="row">
    <div class="col-xs-4 align-right">
    </div>
    <div class="col-xs-4">
        <div class="row" style="margin-top: 20px; background-color: black; opacity: 0.7; padding: 10px; border-radius: 15px; -webkit-box-shadow: 5px 5px 15px 1px #919191;
             box-shadow: 5px 5px 15px 1px #919191;">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12 align-left white">
                        <h2 style="border-bottom: thin solid rgb(180, 188, 207);">Member Registration Area</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 align-left white">
                        <h4 class="center">Please Enter Your Details</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 align-left">
                        <p style="color: white; font-weight: bold; margin-bottom: 5px;">Name</p>
                        <?= $form->field($model, 'name')->label(FALSE) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 align-left">
                        <p style="color: white; font-weight: bold; margin-bottom: 5px;">Contact No.</p>
                        <?= $form->field($model, 'contactno')->label(FALSE) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 align-left">
                        <p style="color: white; font-weight: bold; margin-bottom: 5px;">Email</p>
                        <?= $form->field($model, 'email')->label(FALSE) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 align-left">
                        <p style="color: white; font-weight: bold; margin-bottom: 5px;">Password</p>
                        <?= $form->field($model, 'password')->passwordInput()->label(FALSE) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 align-left">
                        <p style="color: white; font-weight: bold; margin-bottom: 5px;">Confirm Password</p>
                        <?= $form->field($model, 'confirmpassword')->passwordInput()->label(FALSE) ?>
                    </div>
                </div>
                <div class="hr"></div>
                <div class="row">
                    <div class="col-xs-12 align-center">
                        <?= \himiklab\yii2\recaptcha\ReCaptcha::widget(['name' => 'reCaptcha']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group" style="padding-right: 10px; padding-top: 8px;">
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/portal/default/index" class="white pull-left">Back</a>
                        </div>
                    </div>
                    <div class="col-xs-6 align-right">
                        <div class="form-group pull-right" style="padding-right: 10px;">
                            <?= Html::submitButton('Register', ['class' => 'btn btn-primary no-border btn-round', 'name' => 'login-button']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-4">
    </div>

</div>
