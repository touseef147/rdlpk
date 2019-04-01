<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\general\models\Profession */

$this->title = 'Create Profession';
?>
<div class="profession-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
