<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 style="border-bottom: thin solid rgb(180, 188, 207);"><?= Html::encode($this->title) ?></h1>

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

    <div class="form-row">
        <div class="col-xs-12">
<?= $form->field($model, 'username') ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-xs-12">
<?= $form->field($model, 'password')->passwordInput() ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-xs-12">
            <br/>
            <div class="form-group pull-right">
<?= Html::submitButton('Login', ['class' => 'btn btn-primary no-border btn-round', 'name' => 'login-button']) ?>
            </div>
        </div>
    </div>





<?php ActiveForm::end(); ?>
