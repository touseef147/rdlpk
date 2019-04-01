<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\visits\models\Dailyvisitors */

$this->title = 'Create Visitor';
?>
<div class="dailyvisitors-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
