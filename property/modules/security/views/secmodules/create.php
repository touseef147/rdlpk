<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\security\models\Secmodules */

$this->title = 'Create Modules';
?>
<div class="secmodules-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
