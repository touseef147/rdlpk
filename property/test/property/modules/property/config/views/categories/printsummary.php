<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\propertyconfig\models\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->reporttitle1 = "Categories Summary";
$this->reportdocno = "RDBL/PROP/01";
$this->reportrev = "01";
$this->reportdocdate = "01-Jan-2014";
$this->reportwidth = "98%";
?>
                                            <table cellpadding="3" cellspacing="0" width="100%">
  <thead>
      <tr class="HeaderBlue" height="25">
      <th  class="HeaderLeft style13" style="border-bottom:thin solid" align="center" width="20">      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Title      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Name      </th>
      <th class="HeaderMiddle" style="border-bottom:thin solid">Sign      </th>
      <th class="HeaderRight" style="border-bottom:thin solid">      </th>
      </tr>
  </thead>
  <tbody>
<?php      $rows = $dataProvider->getModels(); ?>
<?php      foreach ($rows as $row) { ?>
      <tr>
      <td class="GridLeftCell">      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->title; ?>      </td>

                                                                  <td class="GridMiddleCell" align="left"><?php echo $row->name; ?>      </td>
      <td class="GridMiddleCell" align="left"><?php echo $row->sign; ?>      </td>
      <td class="GridRightCell">       </td>
      </tr>
      <?php } ?>
  </tbody>
</table>
    

