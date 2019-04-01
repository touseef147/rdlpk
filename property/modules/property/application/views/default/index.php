<?php
use app\components\Breadcrumb;
?>
<div class="general-default-index">
    <?=
    Breadcrumb::widget([
        "items" => [
            ["link" => "property", "title" => "Property"],
            ["link" => "", "title" => "Application"],
        ],
    ])
    ?>
    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => "Application", "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="main-icons" style="height: 120px;">
                            <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=Propertyapplication/controller/index">
                                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/logo1.png" style="width: 90%">
                                <br>One
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="main-icons" style="height: 120px;">
                            <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=Propertyapplication/controller/index">
                                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/logo1.png" style="width: 90%">
                                <br>Two
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="main-icons" style="height: 120px;">
                            <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=Propertyapplication/controller/index">
                                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/logo1.png" style="width: 90%">
                                <br>Three
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                
            </div>
        </div>
        
    </div>
</div>
