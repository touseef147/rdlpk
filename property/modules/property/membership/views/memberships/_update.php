<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\application\Propertymemberships */

$this->title = 'Update Membership';
?>
<div class="propertymemberships-update">

    <?=
    $this->render('_form', [
        'model' => $model,
        'appform' => $appform,
        'modeljointmembers' => $modeljointmembers,
        'modelinstallmentplan' => $modelinstallmentplan,
        'instpaymentrights' => $instpaymentrights,
    ])
    ?>

</div>
