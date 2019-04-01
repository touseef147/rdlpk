<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\finance\models\InstallpaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment Details';
?>


<?=

$this->render('_plotpaymentdetails', [
    'model' => $model,
    'plot' => $plot,
    'appform' => $appform,
    'instpaymentrights' => $instpaymentrights,
    'modeljointmembers' => $modeljointmembers,
    'parentpage' => $parentpage,
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

