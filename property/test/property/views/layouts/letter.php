<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAssetPrintLetter;

AppAssetPrintLetter::register($this);

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

        <!-- inline styles related to this page -->
        <style media="print">
            /*            table {
                            page-break-after: auto;
                        }
            
                        tr {
                            page-break-inside: avoid;
                            page-break-after: auto;
                        }
            
                        tbody {
                            page-break-before: avoid;
                        }
            
                        td {
                            page-break-inside: avoid;
                            page-break-after: auto;
                        }
            
                        thead {
                            display: table-header-group;
                        }
            
                        tfoot {
                            display: table-row-group;
                            display: table-footer-group;
                        }
            
                        table tbody tr td:before,
                        table tbody tr td:after {
                            content: "";
                            height: 4px;
                            display: block;
                        }*/

            /*            table tbody thead td {
                            font-weight: bold;
                            background-color:grey;
                        }*/
        </style>

        <script type="text/javascript">
            window.onload = function () {
//                window.print();
                if (!!window.chrome) {
                    window.history.back(-1);
                } else {
                    //                window.close();
                }
            };
        </script>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?= $content; ?>
        <?php $this->endBody() ?>
    </body>
</html>

<?php $this->endPage() ?>
