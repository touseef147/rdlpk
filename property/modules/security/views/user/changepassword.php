<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\security\models\User */

$this->title = 'Change Password';
?>
<div class="user-create">

    <?= $this->render('_changepassword', [
        'model' => $model,
    ]) ?>

</div>
