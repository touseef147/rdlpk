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
<body class="no-skin">
<?php $this->beginBody() ?>
    <?= $this->render('navbar'); ?>


    		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

                        <?= ""; //$this->render('sidebar'); ?>
                        
			<div class="main-content">
                            <div class="main-content-inner" style="text-align: center; padding-top: 20px;">
                                <div style="border: thin solid rgb(180, 188, 207); border-radius: 10px; width:300px; margin-left: auto; margin-right: auto; box-shadow: 0px 0px 5px 10px rgb(234, 238, 242) inset; background-color: rgb(248, 248, 248); padding: 10px; text-align: left; overflow: auto;">
                                    <?= $content ?>
                                </div>
                                    
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
</html>
<?php $this->endPage() ?>
