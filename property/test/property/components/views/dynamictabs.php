<?php

use app\components\Dynamictabs;

$allowditems =0;

foreach ($model->items as $titem) {
    if (array_key_exists($titem->link, $myrights)) {
        $titem->allowed = true;
        $alloweditems +=1;
    }
}
if($alloweditems)
?>

<ul class="nav nav-tabs" id="myTab">
    <?php
    foreach ($model->items as $titem) {
        //fa-home
        ?>
        <li class="<?php echo $titem->active ?>">
            <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=<?php echo $titem->link; ?>">
                <i class="green ace-icon fa <?php echo $titem->icon; ?> bigger-120"></i>
                <?php
                echo $titem->title;

                if ($titem->badge != "") {
                    ?>
                    <span class="badge badge-danger">---</span>
                    <?php
                }
                ?>

            </a>
        </li>
        <?php
    }
    ?>
</ul>

<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=dashboard">Home</a>
        </li>
        <?php
        foreach ($model->items as $bitem) {
            if ($bitem["link"] != "") {
                ?>
                <li>
                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=<?= $bitem["link"] ?>"><?= $bitem["title"] ?></a>
                </li>
                <?php
            } else {
                ?>
                <li class="active"><?= $bitem["title"] ?></li>
                    <?php
                }
            }
            ?>
    </ul>
</div>
