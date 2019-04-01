<?php

use app\components\Dashboarditem;
use yii\helpers\Html;

/* $usertype = 0;

  $link = "";
  $icon = "";
  $title = $model->title;
  $colspan = 4;

  if ($model->colspan != NULL)
  $colspan = $model->colspan;

  $linkcol = $model->links;

  for ($i = 0; $i < count($linkcol); $i++) {
  $link = $linkcol[$i]["url"];
  $icon = $linkcol[$i]["icon"];

  if ($linkcol[$i]["title"] != "") {
  $title = $linkcol[$i]["title"];
  }
  } */
?>
<div class="widget-box widget-color-grey" style="margin-top: 10px;">
    <div class="widget-header">
        <h4 class="widget-title lighter smaller">
            <i class="ace-icon fa fa-comment white"></i>
            <?= $model->title; ?>
        </h4>

        <?php
        if (Yii::$app->user->identity->systemcomments != NULL && Yii::$app->user->identity->systemcomments != 0) {
            ?>
            <div class="widget-toolbar">
                <?php
                echo Html::dropDownList('Comment_type', null, ['0' => 'User', '1' => 'System'], // Flat array ('id'=>'label')
                        [
                    'onchange' => ' 
                          $.get( "' . Yii::$app->urlManager->baseUrl .'/index.php?r='. $model->dataurl . '", { type: $(this).val() } )
                          .done(function( data ) {
                          $( "#comments_content" ).html( data );
                          }
                          );',
                        ]     // options
                );
                ?>
            </div>
            <?php
        }
        ?>
    </div>

    <div class="widget-body commentbox">
        <input type="hidden" name="comment_box_data_url" id="comment_box_data_url" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=<?= $model->dataurl ?>">
        <input type="hidden" id="comment_box_parent_id" name="comment_box_parent_id" value="<?= $model->parentval ?>">
        <div class="widget-main no-padding">
            <div id="comments_content" style="padding: 10px 10px;">
            </div>

            <?php
            if($model->allowadd==1)
            {
            ?>
            <div class="form-actions" style="margin-bottom: 0px; margin-top: 0px; padding: 5px 5px;">
                <div class="input-group">
                    <input placeholder="Type your message here ..." class="form-control commentstextbox" name="comment_message" id='comment_message' type="text" style="background-color: lightyellow">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-info no-radius btnsubmitcomment" type="button" onclick="
                            event.stopImmediatePropagation();
                                    event.preventDefault();
                                    
                                    var formData = new FormData($(this).closest('form')[0]);
                                    
                                    $.ajax({
                                    type: 'POST',
                                            url: '<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=<?php echo $model->submiturl ?>',
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                    })
                                    .done(function (data, textStatus, jqXHR) {
                                        if (jqXHR.responseJSON)
                                        {
                                            $('#comment_message').val('');
                                            $('#comments_content').fadeOut().load(data[1], function () {
                                            $('#comments_content').fadeIn();
                                        });
                                        }
                                    })
                                    .fail(function (data) {
                                        alert('Failed to post comment.');
                                        console.log(data);
                                    });
                                            return false;">
                            <i class="ace-icon fa fa-share"></i>
                            Send
                        </button>
                    </span>
                </div>
            </div>
            <?php
            }
            ?>
        </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
</div>