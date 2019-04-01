<?php
use app\components\Developerzone;

if(Yii::$app->user->identity->isdeveloper ==1)
{
?>

<a href="#" class="devzonelink">Model Details</a>
<div class="developer">
    <div>
        <h3>Model Details</h3>
        <p>
        <?php
        foreach ($model->items as $item) {
            print_r($item);
            echo "<br /><br />";
        }
        ?>
            
        </p>
    </div>
</div>
<?php
}
?>