<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\finance\models\InstallpaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Receipts';
?>


<?=

$this->render('_plotreceipts', [
    'model' => $model,
    'plot' => $plot,
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

