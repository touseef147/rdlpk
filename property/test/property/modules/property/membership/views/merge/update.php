<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\application\Propertymemberships */

$this->title = 'Merge File Request';
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
