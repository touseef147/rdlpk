<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\application\PropertydoccategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Propertydoccategories';

?>


    <?=  $this->render('_index',[
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
    'myrights'=>$myrights,
    ]); ?>                                    
    <?php $this->beginBlock('pagesidebar'); ?>
    <?= $this->render('_summarysearch',[
        'searchModel' => $searchModel,
        'myrights'=>$myrights,
        ]); ?>
    <?php $this->endBlock();  ?>        

