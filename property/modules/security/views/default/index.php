<?php

use app\components\Moduledashboarditem;
use app\components\Breadcrumb;
use app\components\Pageheader;
?>
<?=
Breadcrumb::widget([
    "items" => [
        ["link" => "", "title" => "Security Configuration"],
    ],
])
?>
<div class="page-content">

    <?= Pageheader::widget(["title" => "Security &amp; Rights", "subtitle" => "Manage Security &amp; Rights",]) ?>

    <div class="row">
        <?php
        echo Moduledashboarditem::widget([
            "title" => "Role Categories", "rights" => $myrights, "protected" => 0,
            "links" => [
                ["url" => "security/secrolecategory/index", "icon" => "categories.png", "title" => "", "counturl" => ""],
            ],
        ]);

        echo Moduledashboarditem::widget([
            "title" => "Role Types", "rights" => $myrights, "protected" => 0,
            "links" => [
                ["url" => "security/secroletypes/index", "icon" => "types.png", "title" => "", "counturl" => ""],
            ],
        ]);

        echo Moduledashboarditem::widget([
            "title" => "Roles", "rights" => $myrights, "protected" => 0,
            "links" => [
                ["url" => "security/secroles/index", "icon" => "roles_icon.gif", "title" => "", "counturl" => ""],
            ],
        ]);

        echo Moduledashboarditem::widget([
            "title" => "Users", "rights" => $myrights, "protected" => 0,
            "links" => [
                ["url" => "security/user/index", "icon" => "user.png", "title" => "", "counturl" => ""],
            ],
        ]);

        echo Moduledashboarditem::widget([
            "title" => "Module", "rights" => $myrights, "protected" => 0,
            "links" => [
                ["url" => "security/secmodules/index", "icon" => "module.png", "title" => "", "counturl" => ""],
            ],
        ]);

        echo Moduledashboarditem::widget([
            "title" => "Controllers", "rights" => $myrights, "protected" => 0,
            "links" => [
                ["url" => "security/seccontroller/index", "icon" => "controller.png", "title" => "", "counturl" => ""],
            ],
        ]);

        echo Moduledashboarditem::widget([
            "title" => "Screens", "rights" => $myrights, "protected" => 0,
            "links" => [
                ["url" => "security/secmoduleactions/index", "icon" => "view.png", "title" => "", "counturl" => ""],
            ],
        ]);
        ?>
    </div>
</div>
