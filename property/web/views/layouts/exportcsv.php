<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

//page size 
//width & height : dpi settings * inches

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
    <body>
        <?php $this->beginBody() ?>
        <?= $content; ?>
        <?php $this->endBody() ?>
    </body>
</html>

<?php $this->endPage() ?>
<?php
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=Sheet.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
?>