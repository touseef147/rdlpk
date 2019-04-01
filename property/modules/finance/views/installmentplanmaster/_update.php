<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\application\Installmentplanmaster */

$this->title = 'Update Installment Plan';
?>
<div class="installmentplanmaster-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modeldetail' => $modeldetail,
    ]) ?>

</div>
