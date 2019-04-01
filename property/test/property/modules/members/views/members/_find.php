<?php
use yii\helpers\Html;
?>
<input type="hidden" id="titles" name="titles" value="<?php echo $titles; ?>">
<input type="hidden" id="target" name="target" value="<?php echo $target; ?>">
<input type="hidden" id="membertype" name="membertype" value="<?php echo $membertype; ?>">
<div class="padding-8" style="padding: 8px 8px;">
    <?php
    if($titles==""){
    ?>
    <h3 class="row header smaller lighter blue">
        <span class="col-sm-7">
            <i class="ace-icon fa fa-th-large"></i>
            Find Member
        </span><!-- /.col -->

    </h3>
    <?php
    }
    ?>
    <div class="padding-8" style="padding: 8px 8px;">
        <div class="input-group">
            <input placeholder="Enter CNIC" class="form-control commentstextbox" autofocus="autofocus" name="cnic" id="cnic" style="background-color: lightgoldenrodyellow" type="text" value="<?php echo $model->cnic; ?>">
                <?= Html::error($model, 'cnic', ['class' => 'help-block']) ?>
            <span class="input-group-btn" style="vertical-align: top; padding-left: 10px; padding-top: 3px;">
                <button class="btn btn-sm btn-info btn-white btnfindrecord" type="button" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/findrecord">
                    <i class="ace-icon fa fa-tachometer"></i>
                    Find
                </button>
            </span>
        </div>
    </div>
</div>