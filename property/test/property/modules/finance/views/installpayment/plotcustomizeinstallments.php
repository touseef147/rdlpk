<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\finance\models\InstallpaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Installment Plan Details';
?>


<?=

$this->render('_plotcustomizeinstallments', [
    'model' => $model,
    'plot' => $plot,
    'sourcepage' => str_replace("&", "%26", $sourcepage),
]);
?>                                    
<?php $this->beginBlock('pagesidebar'); ?>
<?=
""
//$this->render('_summarysearch', [
//    'searchModel' => $searchModel,
  //  'myrights' => $myrights,
//]);
?>
<?php $this->endBlock(); ?>        

