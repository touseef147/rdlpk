<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\application\Plots */

$this->title = 'Create Plots';
?>
<div class="plots-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
