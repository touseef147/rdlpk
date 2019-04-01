<?php

use app\components\Detaillistaction;

if (array_key_exists($model->action, $model->rights)) {
    ?>
    <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=<?php echo $model->action; ?>&id=<?php echo $model->id; ?>" class="ajaxlink"><?php echo $model->text; ?></a>
    <?php
}
else
{
    echo $model->text;
}
?>