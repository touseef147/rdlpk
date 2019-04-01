<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\visits\models\DailyvisitorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Visitors';

?>


    <?=  $this->render('_index',[
    'model' => $model,
    ]); ?>                                    
    <?php $this->beginBlock('pagesidebar'); ?>
    <?= $this->render('_summarysearch',['searchModel' => $searchModel]); ?>
    <?php $this->endBlock();  ?>        

