<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\application\Propertymemberships */

$this->title = 'Create Cancellation Request';
?>
<div class="propertymemberships-create">

    <?= $this->render('_form', [
        'model' => $model,
        'file' => $file,
        'appform' => $appform,
        'modeljointmembers' => $modeljointmembers,
        'modelinstallmentplan' => $modelinstallmentplan,
        'instpaymentrights' => $instpaymentrights,
    ]) ?>

</div>
