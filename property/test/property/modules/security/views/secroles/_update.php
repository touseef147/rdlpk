<?php
$drows=NULL;

if(isset($modeldynamicrows))
{
    $drows=$modeldynamicrows;
}

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\security\models\Secroles */

$this->title = 'Update Role';
?>
<div class="secroles-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modules' => $modules,
        'controllers' => $controllers,
        'actions' => $actions,
        'rights' => $rights,
        'modeldynamicrows' => $drows,
    ]) ?>

</div>
