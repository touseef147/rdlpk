<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\security\models\User */

$this->title = 'Create User Account';
?>
<div class="user-create">

    <?= $this->render('_account', [
        'model' => $model,
    ]) ?>

</div>
