<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\application\Plots */

$this->title = 'Allot Plots';

$project=NULL;
$insplan=NULL;

if(isset($modelpro))
{
    $project=$modelpro;
}

if(isset($modelinsplan))
    $isnplan=$modelinsplan;

?>
<div class="plots-update">
 <?= $this->render('_allotform', [
        'model' => $model,
        'modelpro' => $project,
        'modelinsplan' => $insplan
    ]) ?>
    
   

</div>
