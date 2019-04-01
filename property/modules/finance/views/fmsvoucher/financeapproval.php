<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\finance\models\FmsvoucherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Instruments';
?>


<?=

$this->render('_financeapproval', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
    'myrights' => $myrights,
]);
?>                                    
<?php $this->beginBlock('pagesidebar'); ?>
<?=

$this->render('_summarysearch', [
    'searchModel' => $searchModel,
    'myrights' => $myrights,
]);
?>
<?php $this->endBlock(); ?>        

