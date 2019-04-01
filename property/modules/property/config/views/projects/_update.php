<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\propertyconfig\models\Projects */

$this->title = 'Update Projects';
?>
<div class="projects-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
