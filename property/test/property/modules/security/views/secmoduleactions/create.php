<?php

use yii\helpers\Html;

$drows=NULL;

if(isset($modeldynamicrows))
{
    $drows=$modeldynamicrows;
}



/* @var $this yii\web\View */
/* @var $model app\modules\security\models\Secmoduleactions */

//$this->title = 'Create Secmoduleactions';
?>
<div class="secmoduleactions-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modules' => $modules,
        'controllers' => $controllers,
        'actions' => $actions,
        'modeldynamicrows' => $drows,
    ]) ?>

</div>
