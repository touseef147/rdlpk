<?php

//session_start();

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

//print_r($_SESSION);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body style="/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#591206+0,1c0300+100 */
background: rgb(129, 65, 54); /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover,  rgb(129, 65, 54) 0%, #1c0300 100%); /* FF3.6-15 */
background: -webkit-radial-gradient(center, ellipse cover,  rgb(129, 65, 54) 0%,#1c0300 100%); /* Chrome10-25,Safari5.1-6 */
background: radial-gradient(ellipse at center,  rgb(129, 65, 54) 0%,#1c0300 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#591206', endColorstr='#1c0300',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
">
        <?php $this->beginBody() ?>
        <?= $this->render('navbar'); ?>


        <div >
            <div style="text-align: center;">
                <?= $content ?>
            </div><!-- /.main-content -->

            <?= ""//$this->render('footer'); ?>

            <!--			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                                            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
                                    </a>-->

        </div><!-- /.main-container -->




        <!--<div class="wrap">
            <div class="container">
                
            </div>
        </div>-->

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
