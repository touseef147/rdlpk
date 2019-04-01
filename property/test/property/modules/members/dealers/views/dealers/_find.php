<?php
use yii\helpers\Html;
?>
<div class="padding-8" style="padding: 8px 8px;">
    <h3 class="row header smaller lighter blue">
        <span class="col-sm-7">
            <i class="ace-icon fa fa-th-large"></i>
            Find Dealer
        </span><!-- /.col -->

    </h3>
    <div class="padding-8" style="padding: 8px 8px;">
        <div class="input-group">
            <input placeholder="Enter CNIC" class="form-control commentstextbox" autofocus="autofocus" name="cnic" id="cnic" style="background-color: lightgoldenrodyellow" type="text">
                <?= Html::error($model, 'cnic', ['class' => 'help-block']) ?>
            <span class="input-group-btn">
                <button class="btn btn-sm btn-info btn-white btnfindrecord" type="button" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/findrecord">
                    <i class="ace-icon fa fa-tachometer"></i>
                    Find
                </button>
            </span>
        </div>
    </div>
</div>