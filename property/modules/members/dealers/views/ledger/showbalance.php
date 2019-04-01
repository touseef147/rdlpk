<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\application\Fmstransdetaildist */
if($model==NULL) return;

?>
<table>
    <tr>
        <td>
            <?php echo number_format(floatval($model->cr_amount) - floatval($model->dr_amount)); 
            if(floatval($model->cr_amount) > floatval($model->dr_amount)){
                echo " Cr.";
            }
            else if(floatval($model->cr_amount) < floatval($model->dr_amount)){
                echo " Dr.";
            }
            ?>
        </td>
    </tr>
</table>
