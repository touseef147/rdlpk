<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\security\models\Secroles */

$this->title = 'Create Role';
?>
<div class="secroles-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
