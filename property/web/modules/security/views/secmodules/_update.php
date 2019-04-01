<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\security\models\Secmodules */

$this->title = 'Update Modules';
?>
<div class="secmodules-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
