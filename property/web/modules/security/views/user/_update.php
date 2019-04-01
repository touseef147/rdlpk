<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\security\models\User */

$this->title = 'Update User';
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelprojects' => $modelprojects,
        'modelcenters' => $modelcenters,
        'selectedproj' => $selectedproj,
        'selectedcenter' => $selectedcenter,
    ]) ?>

</div>
