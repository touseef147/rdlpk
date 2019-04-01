<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\application\Dailyvisitors */

$this->title = 'Visit Details';

$vd=NULL;
$bd=NULL;
$fd=NULL;

if(isset($modelvisits))
{
    $vd=$modelvisits;
}

if(isset($modelbookings))
    $bd=$modelbookings;

if(isset($modelfollowup))
    $fd=$modelfollowup;
    

?>
<div class="dailyvisitors-update">

    <?= $this->render('_followupdetail', [
        'model' => $model,
        'modelfollowup' => $fd,
        'modelvisits' => $vd,
        'modelbookings' => $bd,
    ]) ?>

</div>
