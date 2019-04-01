<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\propertyconfig\models\Projects */

$this->title = 'Create Projects';
?>
<div class="projects-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
