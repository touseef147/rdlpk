<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
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
        window.onload = function () { window.print(); window.close(); };
    </script>
</head>
<body>
<?php $this->beginBody() ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td style="padding:0 10 0 10; "><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="130" class="BoledText" style="border-left:thin; border-left-style:solid; border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid"><img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/logo1.png" width="140" height="80" border="0"></td>
                  <td colspan="2" align="center" valign="middle" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid; font-size:18px; font-style:italic; font-weight:bold"><span class="style6">Report Title</span></td>
                  <td width="120" valign="top" style="border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="25" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Doc #: RDL/CONT/038</span></td>
                    </tr>
                    <tr>
                      <td height="25" style="border-bottom:inset; font-size:10px"><span class="style6">&nbsp;Rev: 00</span></td>
                    </tr>
                    <tr>
                      <td height="25" valign="middle" style="font-size:10px"><span class="style6">&nbsp;Page: 1 of 1</span></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="25" colspan="4" style="padding-left:5px; border-left:thin; border-left-style:solid; border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid"><span class="style6">Project:  <strong><?php echo "Royal Orchard"; ?></strong></span></td>
                </tr>
                <tr>
                  <td height="40" colspan="4" valign="middle" class="BoledText" style="border-left:thin; border-left-style:solid; border-top:thin; border-top-style:solid; border-right:thin; border-right-style:solid"><?= $content; ?></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
      </tr>
    <tr>
      <td style="padding:0 10 0 10; border-top:thin; border-top-style:solid; "><table width="100%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td width="65" valign="top" class="" style="border-left:thin; border-left-style:solid; border-bottom:thin; border-bottom-style:solid"><div align="center"><span class="BoledText style4" style="font-size:9px;"><img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/logo_small.gif" width="60" height="20"></span></div></td>
          <td align="center" valign="middle" class="" style="border-bottom:thin; border-bottom-style:solid"><div align="left"><span class="style4">|&nbsp;&nbsp;&nbsp;Report generated through online "RDL-e-System". </span></div></td>
          <td align="right" valign="top" class="" style="border-right:thin; border-right-style:solid; border-bottom:thin; border-bottom-style:solid">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td style="padding:0 10 0 10; ">&nbsp;</td>
    </tr>
  </table>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
