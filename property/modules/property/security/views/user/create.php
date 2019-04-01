<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\security\models\User */

$this->title = 'Create User';
?>
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelprojects' => $modelprojects,
        'modelcenters' => $modelcenters,
    ]) ?>

</div>
