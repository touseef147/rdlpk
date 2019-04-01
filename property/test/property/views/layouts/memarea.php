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
        <title>FDH eSystem</title>
        <?php $this->head() ?>
    </head>
    <body class="no-skin">
        <?php $this->beginBody() ?>
        <?= $this->render('navbarmem'); ?>


        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('main-container')
                } catch (e) {
                }
            </script>

                    <?= ""//$this->render('sidebar'); ?>

            <div class="main-content">
                <div class="main-content-inner">
            <?= $content ?>
                </div>
            </div><!-- /.main-content -->

<?= $this->render('footer'); ?>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>

        </div><!-- /.main-container -->




        <div class="wrap">
            <div class="container">

            </div>
        </div>

<?php $this->endBody() ?>
    </body>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!--    <script type="text/javascript" src="http://www.google.com/jsapi"></script>-->
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
//google.load('visualization', '1', {packages: ['corechart']});
    </script>

</html>
<?php $this->endPage() ?>
