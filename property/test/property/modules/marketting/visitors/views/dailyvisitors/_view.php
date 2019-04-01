<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\application\Dailyvisitors */

$this->title = 'Visit Details';

$vd=NULL;
$bd=NULL;

if(isset($modelvisits))
{
    $vd=$modelvisits;
}

if(isset($modelbookings))
    $bd=$modelbookings;
    

?>
<div class="dailyvisitors-update">

    <?= $this->render('_viewdetail', [
        'model' => $model,
        'modelvisits' => $vd,
        'modelbookings' => $bd,
    ]) ?>

</div>
