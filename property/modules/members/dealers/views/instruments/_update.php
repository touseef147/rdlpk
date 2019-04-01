<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\application\Fmstransdetaildist */

$this->title = 'Update Instrument Detail';
?>
<div class="fmstransdetaildist-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modeldetail' => $modeldetail,
        'modelmember' => $modelmember,
    ]) ?>

</div>
