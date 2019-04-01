<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
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
<div class="row" style="margin-right: 0px; margin-left: 0px; margin-top: 20px;">
    <div class="col-xs-3 align-right">
        <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/login.png" height="150" />
    </div>
    <div class="col-xs-6">
        <div class="row">
            <div class="col-xs-12 align-left white">
                <h1 style="border-bottom: thin solid rgb(180, 188, 207);">Protected Area</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 align-left white">
                <h4 class="center">Please Enter Your Login Details</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 align-left">
                <p style="color: white; font-weight: bold; margin-bottom: 5px;">User Name</p>
                <?= $form->field($model, 'username')->label(FALSE) ?>
            </div>
            <div class="col-xs-6 align-left">
                <p style="color: white; font-weight: bold; margin-bottom: 5px;">Password</p>
                <?= $form->field($model, 'password')->passwordInput()->label(FALSE) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 align-right">
                <div class="form-group pull-right" style="padding-right: 10px;">
                    <br/>
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary no-border btn-round', 'name' => 'login-button']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-3">
    </div>

</div>

<div class="form-row">
    <div class="col-xs-12">
    </div>
</div>





<?php ActiveForm::end(); ?>
