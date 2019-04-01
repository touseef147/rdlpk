<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\Fmsvoucher */

$this->title = 'Create Instrument';
?>
<div class="fmsvoucher-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelmember' => $modelmember,
        'modelreceipts' => $modelreceipts,
        'modelreceiptdetail' => $modelreceiptdetail,
    ]) ?>

</div>
