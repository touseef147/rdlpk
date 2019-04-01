<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\Charges */

$this->title = 'Update Charges';
?>
<div class="charges-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
