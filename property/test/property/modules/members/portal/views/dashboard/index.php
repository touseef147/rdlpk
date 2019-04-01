<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$form = ActiveForm::begin([
                //'id' => 'login-form',
                //'options' => ['class' => 'form-horizontal'],
                //'fieldConfig' => [
                //'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                //'labelOptions' => ['class' => 'col-lg-1 control-label'],
                //],
        ]);
?>
<div class="general-default-index">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/portal/dashboard/index">Home</a>
            </li>
            <li class="active">Member Area</li>
        </ul><!-- /.breadcrumb -->
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-xs-4">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 center">
                        <span class="profile-picture">
                            <img class="editable img-responsive" alt="<?= $member->name; ?>" id="avatar2" src="<?php echo Yii::$app->urlManager->baseUrl; ?>/uploads/members/pictures/<?php echo $member->image; ?>">
                        </span>
                    </div><!-- /.col -->
                </div>
                <div class="row">

                    <div class="col-xs-12 col-sm-12">
                        <!--                        <h4 class="blue">
                                                    <span class="middle"><?= ""//$member->name;  ?></span>
                        
                                                    <span class="label label-purple arrowed-in-right">
                                                        <i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
                                                        online
                                                    </span>
                                                </h4>-->

                        <div class="profile-user-info">
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Name </div>

                                <div class="profile-info-value">
                                    <span><?= $member->name; ?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Contact # </div>

                                <div class="profile-info-value">
                                    <?= $member->phone; ?>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Email </div>

                                <div class="profile-info-value">
                                    <span><?= $member->email; ?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Address </div>

                                <div class="profile-info-value">
                                    <?= $member->address; ?>
                                </div>
                            </div>
                        </div>

                        <div class="hr hr-8 dotted"></div>

                        <div class="profile-user-info">
<!--                            <div class="profile-info-row">
                                <div class="profile-info-name">
                                    <i class="middle ace-icon fa fa-user bigger-150 blue"></i>
                                </div>

                                <div class="profile-info-value">
                                    <a href="#">Update Profile</a>
                                </div>
                            </div>-->

                            <div class="profile-info-row">
                                <div class="profile-info-name">
                                    <i class="middle ace-icon fa fa-key bigger-150 light-blue"></i>
                                </div>

                                <div class="profile-info-value">
                                    <a class="ajaxlink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/changepassword">Change Password</a>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name">
                                    <i class="middle ace-icon fa fa-envelope bigger-150 light-blue"></i>
                                </div>

                                <div class="profile-info-value">
                                    <a href="#">Messages</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.col -->
                </div>

            </div>
            <div class="col-xs-8">
                <!--        <div class="space-20"></div>-->

                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="widget-box transparent">
                            <div class="widget-header widget-header-small header-color-blue2">
                                <h4 class="widget-title smaller">
                                    <i class="ace-icon fa fa-lightbulb-o bigger-120"></i>
                                    Payable Dues
                                </h4>
                                <div class="widget-toolbar">
                                    <a href="#" class="red">
                                        <i class="ace-icon fa fa-refresh"></i>
                                        Pay Online
                                    </a>
                                </div>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <table id="simple-table" class="table  table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="detail-col ">File. No.      </th>
                                                <th class="detail-col ">Ms. No.      </th>
                                                <th class="detail-col ">Description</th>
                                                <th class="detail-col ">Due Amount      </th>
                                                <th class="detail-col ">Due Date      </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 0; $totaldue = 0; ?>
                                            <?php foreach ($payabledues as $row) {
                                                $count+=1; 
                                                $totaldue = $totaldue + $row->dueamount;
                                                ?>
                                                <tr>
                                                    <td class="center">      </td>
                                                    <td align="left"><?php echo $row->plot->completecode; ?>      </td>
                                                    <td align="left"><?php echo ($row->plot->currentmembership == NULL ? "" : $row->plot->currentmembership->completecode); ?>      </td>
                                                    <td align="left"><?php echo $row->lab; ?>      </td>
                                                    <td align="right"><?php echo number_format($row->dueamount); ?>      </td>
                                                    <td align="left"><?php echo $row->showduedate; ?>      </td>
                                                </tr>
                                            <?php
                                            }

                                            if ($count == 0) {
                                            ?>
                                        <tr>
                                            <td colspan="6" class="center red" style="padding: 18px;">No Record Found.</td>
                                        </tr>
                                                <?php
                                            } else {
                                                ?>
                                        <tr>
                                            <td class="center">      </td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td align="right"><?php echo $totaldue; ?>      </td>
                                            <td align="left"></td>
                                        </tr>
                                        <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="widget-box transparent">
                            <div class="widget-header widget-header-small">
                                <h4 class="widget-title smaller">
                                    <i class="ace-icon fa fa-check-square-o bigger-110"></i>
                                    Property Details
                                </h4>
                                <div class="widget-toolbar">
                                    <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=property/application/propertyapplication/newbooking" class="red ajaxlink">
                                        <i class="ace-icon fa fa-edit"></i>
                                        New Booking
                                    </a>
                                </div>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <table id="simple-table" class="table  table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="detail-col ">File. No.      </th>
                                                <th class="detail-col ">Ms. No.      </th>
                                                <th class="detail-col ">Size</th>
                                                <th class="detail-col ">Nominee      </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 0; //$totaldue = 0; ?>
                                            <?php foreach ($myproperty as $row) {
                                                $count+=1; 
                                                //$totaldue = $totaldue + $row->dueamount;
                                                ?>
                                                <tr>
                                                    <td class="center">      </td>
                                                    <td align="left"><?php //echo $row->plot->completecode; ?>      </td>
                                                    <td align="left"><?php //echo ($row->plot->currentmembership == NULL ? "" : $row->plot->currentmembership->completecode); ?>      </td>
                                                    <td align="left"><?php //echo $row->lab; ?>      </td>
                                                    <td align="right"><?php //echo number_format($row->dueamount); ?>      </td>
                                                </tr>
                                            <?php
                                            }

                                            if ($count == 0) {
                                            ?>
                                        <tr>
                                            <td colspan="6" class="center red" style="padding: 18px;">No Record Found.</td>
                                        </tr>
                                                <?php
                                            } else {
                                                ?>
                                        <tr>
                                            <td class="center">      </td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td align="right"><?php echo $totaldue; ?>      </td>
                                            <td align="left"></td>
                                        </tr>
                                        <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>