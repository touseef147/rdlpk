<?php
if (count($model) == 0) {
    ?>
    <p style="text-align: center; color: red; padding: 20px 20px;">No comments uploaded yet.</p>
    <?php
}

foreach ($model as $row) {
    ?>
    <div class="itemdiv dialogdiv">
        <div class="user">
            <img alt="Alexa's Avatar" src="<?php echo Yii::$app->urlManager->baseUrl; ?>/uploads/users/<?php echo $row->user->pic; ?>">
        </div>

        <div class="body">
            <div class="time">
                <i class="ace-icon fa fa-clock-o"></i>
                <span class="green"><?= date("d-m-Y h:i:s",  strtotime($row->date))." : ".$row->location ?></span>
            </div>

            <div class="name">
                <a href="#"><?= $row->user->person_name ?></a>
            </div>
            <div class="text"><?= $row->comments ?></div>
        </div>
    </div>
    <?php
}
?>