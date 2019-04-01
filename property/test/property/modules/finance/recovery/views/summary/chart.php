<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\visits\models\DailyvisitorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Visitors';

$no=0;

$visits=0;
$calls=0;

?>
['User Name', 'Visits', 'Calls' ],
<?php      foreach ($model as $row) { 
    $visits = intVal($row->no_of_visits);
    $calls = intVal($row->no_of_calls);
    ?>
<?php
    $no++;
    
if($no<count($model)) {
    ?>
['<?php echo $row->username; ?>',  <?php echo $visits; ?>,<?php echo $calls; ?>],
    <?php
}
else
{
    ?>
['<?php echo $row->username; ?>',  <?php echo $visits; ?>,<?php echo $calls; ?>]
<?php
    
}
}
      ?>
