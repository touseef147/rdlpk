<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\Propertyapplication */

$this->title = 'Add Application';
?>
<div class="propertyapplication-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelmember' => $modelmember,
//        'modelvoucher' => $modelvoucher,
  //      'modelvoucherfee' => $modelvoucherfee,
    //    'modelvoucherbooking' => $modelvoucherbooking,
        //'modelnewnominee' => $modelnewnominee,
        'modelpcateg' => $modelpcateg,

        //'modelphoto' => $modelphoto,
        //'modelcnic' => $modelcnic,
//        'modelbankdoc' => $modelbankdoc,
    ]) ?>

</div>
