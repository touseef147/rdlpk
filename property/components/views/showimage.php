<?php

use Yii;
use app\components\Showimage;

$height=($model->height=="" || $model->height=="0" ? 0 : intval($model->height));
$hasheight=($height==0? false : true);

$completepath = "";

if($model->file_name != NULL && $model->file_name != ""){
    $completepath = $model->path.$model->file_name;
}

if ($model->path != "" && file_exists($model->path)) {
    ?>
<img src="<?php echo $model->path; ?>" <?php if($hasheight==true) { ?> height="<?php echo $height; ?>" <?php } ?>>
<?php
} else {
    ?>
<img src="<?php echo Yii::$app->urlManager->baseUrl."/images/icons/pic_not_available.png"; ?>" height="<?php echo $height; ?>" alt="Picture not available.">
<?php
}
?>
