<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\Charges */

$this->title = 'Create Charges';
?>
<div class="charges-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
