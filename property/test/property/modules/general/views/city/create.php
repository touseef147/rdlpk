<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\general\models\City */

$this->title = 'Create City';
?>
<div class="city-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
