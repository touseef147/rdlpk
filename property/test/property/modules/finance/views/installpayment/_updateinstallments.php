<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\Fmsvoucher */

$this->title = 'Update Instrument';
?>
<div class="fmsvoucher-update">

    <?= $this->render('_formupdateinstallments', [
        'model' => $model,
        //'modelmember' => $modelmember,
        'modelreceipts' => $modelreceipts,
        'modelreceiptdetail' => $modelreceiptdetail,
    ]) ?>

</div>
