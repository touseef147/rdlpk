<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\general\models\Country */

$this->title = 'Create Country';
?>
<div class="country-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
