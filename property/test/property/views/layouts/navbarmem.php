<div id="navbar" class="navbar navbar-grey          ace-save-state" style="background-color: darkslategray;">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/icons/logo1.gif" height="40">
        </div>

        <div class="navbar-header pull-left">
            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=<?php if(Yii::$app->member->id !=null)  echo "members/portal/dashboard"; else echo "members/portal/default/index"; ?>" class="navbar-brand <?php if(Yii::$app->member->id !=null) { echo "ajaxlink"; } ?>">
                <small>
                    Property Management e-System
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
                <?php
                if(Yii::$app->member->id !=null)
                {
                ?>
            <ul class="nav ace-nav">

<li>
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle" style="background-color: darkslategray;">
                        <img class="nav-user-photo" src="<?php echo Yii::$app->urlManager->baseUrl; ?>/uploads/members/picture/<?php echo Yii::$app->member->identity->picture; ?>" />
                        <span class="user-info">
                            <small><?php echo Yii::$app->member->identity->fullname; ?></small>

                        </span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
<!--                        <li>
                            <a href="#">
                                <i class="ace-icon fa fa-cog"></i>
                                Profile
                            </a>
                        </li>-->

                        <li>
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/changepassword" class="ajaxlink">
                                <i class="ace-icon fa fa-key"></i>
                               Change Password
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=site/memlogout">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
                <?php
                }
                ?>
        </div>
    </div><!-- /.navbar-container -->
</div>
