<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\Propertyapplication */

$this->title = 'Add Application Form';
?>
<div class="propertyapplication-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelmember' => $modelmember,
        'modelpcateg' => $modelpcateg,
    ]) ?>

</div>
