<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\general\models\City */

$this->title = 'Update City';
?>
<div class="city-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
