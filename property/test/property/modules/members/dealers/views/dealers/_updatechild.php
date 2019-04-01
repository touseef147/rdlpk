<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\members\models\Members */

$this->title = 'Update Nominee';
?>
<div class="members-update">

    <?= $this->render('_formchild', [
        'model' => $model,
    ]) ?>

</div>
