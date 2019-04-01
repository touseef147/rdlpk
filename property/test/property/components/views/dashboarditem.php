<?php

use app\components\Dashboarditem;

$usertype = 0;

$link = "";
$icon = "";
$title = $model->title;
$colspan = 3;
$counturl = "";

$attached = FALSE;

if ($model->colspan != NULL)
    $colspan = $model->colspan;

$linkcol = $model->links;

for ($i = 0; $i < count($linkcol); $i++) {
    $link = $linkcol[$i]["url"];
    $icon = $linkcol[$i]["icon"];
    
    if ($linkcol[$i]["title"] != "") {
        $title = $linkcol[$i]["title"];
    }

    if ($linkcol[$i]["counturl"] != "") {
        $counturl = $linkcol[$i]["counturl"];
    }

    //top most link will be on higher priority
    if ($link != "" && $attached == FALSE) {
        if (array_key_exists($link, $model->rights)) {
            $attached = TRUE;
            ?>
            <div class="col-sm-<?= $colspan ?>">
                <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=<?php echo $link ?>">
                    <div class="infobox infobox-blue">
                        <div class="infobox-icon">
                            <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/icons/<?php echo $icon ?>" height="40"></div>
                        <div class="infobox-data">
                            <span class="infobox-data-number"><?= $model->title ?></span>
                            <span class="infobox-content">
                                <?php
                                if ($counturl != "") {
                                    ?>
                                    <div class="lazycontent blue_dark bolder" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=<?php echo $counturl; ?>"></div>
                                    <?php
                                } else {
                                    echo "&nbsp;";
                                }
                                ?>
                            </span>
                        </div>
                        <div class="infobox-collapsed-footer">
                            <!--
                            for drop down content, will be used for future use.
                            <span class="fa-angle-double-down"></span>
                            -->
                        </div>
                    </div>
                </a>
            </div>
            <?php
        }
    }
}
?>