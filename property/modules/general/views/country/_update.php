<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\general\models\Country */

$this->title = 'Update Country';
?>
<div class="country-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
