<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\members\models\Members */

$this->title = 'Register Members';
?>
<div class="members-create">

    <?= $this->render('_activatemember', [
        'model' => $model,
    ]) ?>

</div>
