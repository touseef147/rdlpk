<?php
use app\components\Pageheader;
?>

<div class="page-header">
    <h1>
        <?php
        echo $model->title;

        if ($model->subtitle != null && $model->subtitle != "") {
            ?>

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?= $model->subtitle ?>
            </small>
            <?php
        }
        ?>
    </h1>
</div><!-- /.page-header -->
