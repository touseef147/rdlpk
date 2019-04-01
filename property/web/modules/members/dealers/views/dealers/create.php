<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\members\models\Members */

$this->title = 'Create Dealer';
?>
<div class="members-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
