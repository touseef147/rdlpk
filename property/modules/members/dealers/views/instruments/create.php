<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\application\Fmstransdetaildist */

$this->title = 'Deposit Instrument';
?>
<div class="fmstransdetaildist-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modeldetail' => $modeldetail,
        'modelmember' => $modelmember,
    ]) ?>

</div>
