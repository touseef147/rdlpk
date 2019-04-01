<?php

use app\components\Updatelistaction;

if (array_key_exists($model->action, $model->rights)) {
    ?>
    <a data-original-title="Edit" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=<?php echo $model->action; ?>&id=<?php echo $model->id; ?>" class="tooltip-error ajaxlink" data-rel="tooltip" title="">
        <span class="blue">
            <i class="ace-icon fa fa-pencil bigger-120"></i>
        </span>
    </a>
    <?php
}
?>