<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$serial = $id+1;
?>

<tr id="row_<?php echo $id; ?>">
    <td class="center"><?php
        ?>
    </td>
    <td>
        <input type="hidden" name="CustomSearch[<?php echo $id; ?>][idx]" id="CustomSearch_<?php echo $id; ?>_idx" value="<?php echo $id; ?>" />
        <input type="text" name="CustomSearch[<?php echo $id; ?>][msno]" id="CustomSearch_<?php echo $id; ?>_msno" placeholder="Enter MS. No." class="form-control commentstextbox" autofocus="autofocus" />
    </td>

    <td>
        <input type="button" name="Find" value="find" onclick="event.stopImmediatePropagation();
event.preventDefault();

var formData = new FormData($(this).closest('form')[0]);
var msno = $('#CustomSearch_<?php echo $id; ?>_msno').val();

$.ajax({
    type: 'POST',
    url: '<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=finance/voucherplotdetail/searchms&msno=' + msno  + '&idx=<?php echo $id; ?>',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
  })
  .done(function(data, textStatus, jqXHR) {
    if (jqXHR.responseJSON) {
      $('#row_<?php echo $id; ?>').fadeOut().load(data[1], function() {
        $('#row_<?php echo $id; ?>').fadeIn();
      });
    } else {
    alert('Record not found.');
    }
  })
  .fail(function(data) {
    alert('Failed to find record.');
    console.log(data);
  });
return false;" />
    </td>
    <td>
    </td>
    <td>
    </td>
</tr>
