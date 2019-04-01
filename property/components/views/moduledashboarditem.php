<?php

use app\components\Dashboarditem;

$link = "";
$icon = "";
$title = $model->title;


$linkcol = $model->links;

for ($i = 0; $i < count($linkcol); $i++) {
    $link = $linkcol[$i]["url"];
    $icon = $linkcol[$i]["icon"];

    if ($linkcol[$i]["title"] != "") {
        $title = $linkcol[$i]["title"];
    }
}

if (($model->protected == 1 ? array_key_exists($link, $model->rights) : 1)) {
    ?>
    <div class="col-sm-3">
        <div class="main-icons" style="height: 120px;">
            <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=<?php echo $link ?>">
                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/icons/<?php echo $icon ?>" style="height: 50px">
                <br><?= $model->title ?>
            </a>
        </div>
    </div>
    <?php
}
?>