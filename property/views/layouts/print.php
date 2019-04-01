<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAssetPrint;

AppAssetPrint::register($this);
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

        <script type="text/javascript">
            window.onload = function () {
                window.print();
                if (!!window.chrome) {
                    window.history.back(-1);
                } else {
                                    window.close();
                }
            };
        </script>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <table style="width: <?= $this->reportwidth ?>" cellpadding="0" cellspacing="0" >
            <thead>
                <tr>
                    <td style="text-align: left; width: 70px; border-left: solid #000 thin; border-top: solid #000 thin;  border-right: solid #000 thin;  border-bottom: solid #000 thin;">
                        <table style="width:100%;"  cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width:70px; vertical-align: top; border-right: thin solid #000; padding: 3px;">
                                    <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/logo1.png" style="height: 60px;" />
                                </td>
                                <td style="vertical-align:middle">
                                    <table style="width: 100%;" cellpadding="3" cellspacing="0">
                                        <?php 
                                        if($this->reporttitle1 != "")
                                        {
                                        ?>
                                        <tr>
                                            <td style="font-size:18px; font-weight: bold; text-align: center;"><?= $this->reporttitle1 ?></td>
                                        </tr>
                                        <?php
                                        }
                                        if($this->reporttitle2 != "")
                                        {
                                        ?>
                                        <tr>
                                            <td style="font-size:14px; font-weight: bold; text-align: center;"><?= $this->reporttitle2 ?></td>
                                        </tr>
                                        <?php
                                        }
                                        if($this->reporttitle3 != "")
                                        {
                                        ?>
                                        <tr>
                                            <td style="font-size:12px; font-weight: bold; text-align: center;"><?= $this->reporttitle3 ?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                                <td style="width:150px; vertical-align: top; border-left: thin solid #000;">
                                    <table style="width: 100%;" cellpadding="3" cellspacing="0">
                                        <tr>
                                            <td style="border-bottom: thin solid #000; font-size: 12px;">Doc #: <?= $this->reportdocno ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border-bottom: thin solid #000; font-size: 12px;">Rev: <?= $this->reportrev ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left; font-size: 12px;">Date: <?= $this->reportdocdate ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>

<!--                                <table style="width: 100%">
                        <tr>
                            <td colspan="3">
                                <table style="width: 100%">
                                    <tr>
                                        <td>
                                            <h4 style="color: #4f81bd;">
                                                 Report Title 
                                            </h4>
                                        </td>
                                        <td>
                                            <h4 style="color: #4f81bd; text-align: right">
                                                 Report Criteria 
                                            </h4>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>-->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style=" border-left: solid #000 thin; border-right: solid #000 thin;  border-bottom: solid #000 thin;">
                        <?= $content; ?>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td style="font-size: 8px; color: darkgray; border-left: solid #000 thin; border-right: solid #000 thin;  border-bottom: solid #000 thin;">
                        <table style="width:100%;" cellpadding="8" cellspacing="0">
                            <tr>
                                <td style="width:50%;">Printed On: <?php echo date("d-M-Y H:i:s") ?></td>
                                <td style="width:50%; text-align: right;">GENERATED THROUGH ONLINE eSYSTEM</td>
                            </tr>
                        </table>
                        
                    </td>
                </tr>
            </tfoot>
        </table>
        <?php $this->endBody() ?>
    </body>
</html>

<?php $this->endPage() ?>
