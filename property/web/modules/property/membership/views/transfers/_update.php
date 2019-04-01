<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\application\Propertymemberships */

$this->title = 'Update Propertymemberships';
?>
<div class="propertymemberships-update">

    <?= $this->render('_form', [
        'model' => $model,
        'plot' => $plot,
    ]) ?>

</div>
