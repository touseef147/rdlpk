<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\propertyconfig\models\Plots */

$this->title = 'Create Plots';
?>
<div class="plots-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
