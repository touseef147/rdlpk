<div class="general-default-index">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "", "title" => "Reports"],
        ],
    ])
    ?>
    <div class="page-content">
        <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/visitorsreports/followup/sidebarsummary">

        <div class="row">
            <div class="col-sm-12">

                <div class="widget-box ui-sortable-handle " id="recent-box">
                    <div class="widget-header">
                        <h4 class="widget-title lighter smaller">
                            <i class="ace-icon fa fa-rss orange"></i>Followup Reports
                        </h4>

                        <div class="widget-toolbar no-border">
                            <ul class="nav nav-tabs" id="recent-tab">
                                <?php
                                $count = 0;
                                foreach ($tabs as $tab) {
                                    $count++;
                                    ?>
                                    <li class="<?= ($tab["expanded"] == TRUE ? "active" : "" ) ?>">
                                        <a class="tab-pane-reports" data-report="<?php echo $tab["name"]; ?>" aria-expanded="<?= ($tab["expanded"] == TRUE ? "true" : "false" ) ?>" data-toggle="tab" href="#tab<?= $count ?>"><?= $tab["title"] ?></a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <div class="tab-content no-padding">
                                <?php
                                $count = 0;

                                foreach ($tabs as $tab) {
                                    $count++;
                                    ?>
                                    <div id="tab<?php echo $count; ?>" class="tab-pane <?= ($tab["expanded"] == TRUE ? "active" : "") ?>">
                                    <?php
                                    if ($tab["expanded"] == true) {
                                        echo $this->render('_' . $tab["name"], [
                                            'modelRows' => $modelRows,
                                            'modelColumns' => $modelColumns,
                                            'model' => $model,
                                        ]);
                                    }
                                    ?>
                                    </div>
                                        <?php
                                    }
                                    ?>
                            </div>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div>
            </div>
        </div>

    </div>
</div>
