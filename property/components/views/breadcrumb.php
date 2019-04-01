<?php

use app\components\Breadcrumb;

$hasback = "";
$backlink = "";
?>

<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard">Home</a>
        </li>
        <?php
        foreach ($model->items as $bitem) {
            if ($bitem["link"] != "") {
                if ($bitem["title"] == "Back") {
                    $hasback = "Back";
                    $backlink = $bitem["link"];
                } else {
                    ?>
                    <li>
                        <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=<?= $bitem["link"] ?>"><?= $bitem["title"] ?></a>
                    </li>
                    <?php
                }
                ?>
                <?php
            } else {
                ?>
                <li class="active"><?= $bitem["title"] ?></li>
                    <?php
                }
            }
            ?>
    </ul>
    
    <?php
    if($hasback != ""){
     ?>
    <a class="pull-right ajaxlink" href="<?= $backlink ?>">Back</a>
    <?php
    }        
    ?>
</div>
