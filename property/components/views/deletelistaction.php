<?php

use app\components\Deletelistaction;

if (array_key_exists($model->action, $model->rights)) {
    ?>
    <a data-original-title="Delete" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=<?php echo $model->action; ?>&id=<?php echo $model->id; ?>" class="tooltip-error deletelink" data-rel="tooltip" title="">
        <span class="red">
            <i class="ace-icon fa fa-trash-o bigger-120"></i>
        </span>
    </a>
    <?php
}
?>