<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\application\City;
use app\models\application\Profession;
use app\models\application\Salescenter;

/* @var $this yii\web\View */
/* @var $model app\models\application\Dailyvisitors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dailyvisitors-form">
    <?=
    \app\components\Breadcrumb::widget([
        "items" => [
            ["link" => "marketting", "title" => "Marketting"],
            ["link" => "marketting/visitors", "title" => "Visits"],
            ["link" => "marketting/visitors/dailyvisitors/index", "title" => "Summary"],
            ["link" => "", "title" => Html::encode($this->title)],
        ],
    ])
    ?>

    <div class="page-content">

        <?=
        \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""])
        ?>

        <div class="row">
            <div class="col-xs-12">
                <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=visits/dailyvisitors/sidebarinput">

                <?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>

                <?php //$rows = $model->getModels();   ?>
                <?php //foreach ($rows as $row) {  ?>

                <div class="row">
                    <div class="col-xs-7">
                        <div class="row-fluid form-row">
                            <div class="col-xs-3 form-label-right"> Visitor Name </div>
                            <div class="col-xs-9 read-only-field"><?php echo $model->name; ?></div>
                        </div>
                    </div>
                    <div class="col-xs-5">
                        <div class="row-fluid form-row">
                            <div class="col-xs-3 form-label-right"> Reg. Date </div>
                            <div class="col-xs-9 read-only-field"><?php echo date("d-m-Y", strtotime($model->reg_date)); ?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-7">
                        <div class="row-fluid form-row">
                            <div class="col-xs-3 form-label-right"> Profession </div>
                            <div class="col-xs-9 read-only-field"><?php if ($model->profession == null) echo "";
                else echo ($model->profession_id == 0 ? "" : $model->profession->profession); ?></div>
                        </div>
                    </div>
                    <div class="col-xs-5">
                        <div class="row-fluid form-row">
                            <div class="col-xs-3 form-label-right"> City </div>
                            <div class="col-xs-9 read-only-field"><?php echo ($model->visitorCity == null ? "" : $model->visitorCity->city); ?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-7">
                        <div class="row-fluid form-row">
                            <div class="col-xs-3 form-label-right"> Contact No </div>
                            <div class="col-xs-9 read-only-field"><?php echo $model->contactno; ?></div>
                        </div>
                    </div>
                    <div class="col-xs-5">
                        <div class="row-fluid form-row">
                            <div class="col-xs-3 form-label-right"> E-mail </div>
                            <div class="col-xs-9 read-only-field"><?php echo $model->email; ?></div>
                        </div>
                    </div>
                </div>
                <?php //}  ?>
                <br/>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Visits</h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main no-padding">
                                    <div class="row-fluid">
                                        <div id="table_bug_report_male" class="span12">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead class="thin-border-bottom">
                                                    <tr>
                                                        <th>
                                                            <i class="ace-icon fa fa-user"></i>
                                                            Type
                                                        </th>

                                                        <th>
                                                            <i>@</i>
                                                            Date
                                                        </th>
                                                        <th class="hidden-480">Remarks</th>
                                                        <th class="hidden-480">Next Visit</th>
                                                        <th class="hidden-480">Sales Center</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    foreach ($model->visitDetails as $visit) {
                                                        ?>
                                                        <tr>
                                                            <td class="">
                                                                <?= $visit->visit_type ?>
                                                            </td>

                                                            <td>
                                                                <?= date("d-m-Y", strtotime($visit->visit_date)) ?>
                                                            </td>

                                                            <td class="hidden-480">
                                                                <?= $visit->remarks ?>
                                                            </td>
                                                            <td class="hidden-480">
                                                                <?= date("d-m-Y", strtotime($visit->next_visit)) ?>
                                                            </td>
                                                            <td class="hidden-480">
                                                                <?php
                                                                if ($visit->saleCenter == null)
                                                                    echo "";
                                                                elseif ($visit->center_id == 0)
                                                                    echo "";
                                                                else
                                                                    echo $visit->saleCenter->name
                                                                    ?>
                                                            </td>

                                                        </tr>
                                                        <?php
                                                    }

                                                    $visit = NULL;

                                                    if (isset($modelvisits))
                                                        $visit = $modelvisits;
                                                    else
                                                        $visit = new \app\models\application\Visitdetails();
                                                    ?>
                                                    <tr>
                                                        <td class="">
                                                            <?php
                                                            echo $form->field($visit, 'visit_type')
                                                                    ->dropDownList(
                                                                            array('caller' => 'Caller', 'visitor' => 'Visitor'), // Flat array ('id'=>'label')
                                                                            ['prompt' => 'Select Type']  // options
                                                                    )->label(false);
                                                            ?>
                                                        </td>

                                                        <td>
                                                            <?= $form->field($visit, 'visit_date')->textInput(['class' => 'date-picker'])->label(false) ?>
                                                        </td>

                                                        <td class="hidden-480">
                                                            <?= $form->field($visit, 'remarks')->textInput()->label(false) ?>
                                                        </td>
                                                        <td class="hidden-480">
                                                            <?= $form->field($visit, 'next_visit')->textInput(['class' => 'date-picker'])->label(false) ?>
                                                        </td>

                                                        <td class="hidden-480">
                                                            <?php
                                                            echo $form->field($visit, 'center_id')
                                                                    ->dropDownList(
                                                                            ArrayHelper::map(\app\models\application\Salescenter::find()->joinWith("permissions")->orderBy("sales_center.name")->where(['centers_permissions.user_id' => $_SESSION["user_array"]["id"]])->all(), 'id', 'name'), // Flat array ('id'=>'label')
                                                                            ['prompt' => 'Select Center']  // options
                                                                    )->label(false);
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--widget-main-->
                            </div>
                            <!--widget-body-->
                        </div>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title bigger"><i class="icon-th-large"></i> Bookings &amp; Interests</h6>
                                <div class="widget-toolbar"> <a id="add_new_booking_row" href="#">Add</a> </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main no-padding">
                                    <div class="row-fluid">
                                        <div id="table_bug_report_male" class="span12">
                                            <table id="booking_list" class="table table-striped table-bordered table-hover">
                                                <thead class="thin-border-bottom">
                                                    <tr>
                                                        <th>
                                                            <i class="ace-icon fa fa-user"></i>
                                                            Plot Type
                                                        </th>

                                                        <th>
                                                            <i>@</i>
                                                            Size
                                                        </th>
                                                        <th class="hidden-480">Date</th>
                                                        <th class="hidden-480">No. of Plots</th>
                                                        <th class="hidden-480">Type</th>
                                                        <th class="hidden-480">Sales Center</th>
                                                        <th class="hidden-480">Project</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
<?php
$bcount = -1;

foreach ($model->bookingDetails as $booking) {
    //$bcount++;
    ?>
                                                        <tr>
                                                            <td class="">
                                                        <?= $booking->com_res ?>
                                                            </td>

                                                            <td>
                                                                <?= $booking->plotSize->size ?>
                                                            </td>

                                                            <td class="hidden-480">
                                                                <?= date("d-m-Y", strtotime($booking->booking_date)) ?>
                                                            </td>
                                                            <td class="hidden-480">
                                                                <?= $booking->no_of_plots ?>
                                                            </td>
                                                            <td class="hidden-480">
                                                                <?= $booking->type ?>
                                                            </td>
                                                            <td class="hidden-480">
                                                                <?= ($booking->center_id == 0 ? "" : $booking->saleCenter->name ) ?>
                                                            </td>
                                                            <td class="hidden-480">
                                                                <?= ($booking->project_id == 0 ? "" : $booking->project->project_name) ?>
                                                            </td>
                                                        </tr>
                                                                <?php
                                                            }

                                                            if (isset($modelbookings)) {
                                                                foreach ($modelbookings as $booking) {
                                                                    $bcount++;
                                                                    ?>
                                                            <tr>
                                                                <td class="">
                                                            <?php
                                                            echo $form->field($booking, 'com_res')
                                                                    ->dropDownList(
                                                                            array('Commercial' => 'Commercial', 'Residential' => 'Residential'), ['prompt' => '---',
                                                                        'name' => 'Interestbooking[' . $bcount . '][com_res]'
                                                                            ]    // options
                                                                    )->label(false);
                                                            ?>
                                                                </td>

                                                                <td>
                                                                    <?php
                                                                    echo $form->field($booking, 'size2')
                                                                            ->dropDownList(
                                                                                    ArrayHelper::map(app\models\application\Sizecat::find()->all(), 'id', 'size'), // Flat array ('id'=>'label')
                                                                                    ['prompt' => '---',
                                                                                'name' => 'Interestbooking[' . $bcount . '][size2]'
                                                                                    ]    // options
                                                                            )->label(false);
                                                                    ?>
                                                                </td>

                                                                <td class="hidden-480">
                                                                    <?= $form->field($booking, 'booking_date')->textInput(['class' => 'date-picker', 'name' => 'Interestbooking[' . $bcount . '][booking_date]'])->label(false) ?>
                                                                </td>
                                                                <td class="hidden-480">
        <?= $form->field($booking, 'no_of_plots')->textInput(['name' => 'Interestbooking[' . $bcount . '][no_of_plots]'])->label(false) ?>
                                                                </td>
                                                                <td class="hidden-480">
                                                                    <?php
                                                                    echo $form->field($booking, 'type')
                                                                            ->dropDownList(
                                                                                    array('Booking' => 'Booking', 'Interest' => 'Interest'), // Flat array ('id'=>'label')
                                                                                    ['prompt' => '---',
                                                                                'name' => 'Interestbooking[' . $bcount . '][type]'
                                                                                    ]    // options
                                                                            )->label(false);
                                                                    ?>
                                                                </td>
                                                                <td class="hidden-480">
                                                                    <?php
                                                                    echo $form->field($booking, 'center_id')
                                                                            ->dropDownList(
                                                                                    ArrayHelper::map(\app\models\application\CentersPermissions::find()->joinWith("center")->orderBy("center")->all(), 'id', 'name'), // Flat array ('id'=>'label')
                                                                                    ['prompt' => '---',
                                                                                'name' => 'Interestbooking[' . $bcount . '][center_id]'
                                                                                    ]    // options
                                                                            )->label(false);
                                                                    ?>
                                                                </td>
                                                                <td class="hidden-480">
                                                                    <?php
                                                                    echo $form->field($booking, 'project_id')
                                                                            ->dropDownList(
                                                                                    ArrayHelper::map(app\models\application\Projects::find()->all(), 'id', 'project_name'), // Flat array ('id'=>'label')
                                                                                    ['prompt' => '---',
                                                                                'name' => 'Interestbooking[' . $bcount . '][project_id]'
                                                                                    ]    // options
                                                                            )->label(false);
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                <input type="hidden" value="<?php echo $bcount; ?>" id="bookingcount" name="bookingcount" />
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--widget-main-->
                                <div class="widget-toolbox padding-8 clearfix">
                                    <div class=" pull-right"><a id="add_new_booking_row" href="#">Add</a></div>
                                </div>
                            </div>
                            <!--widget-body-->
                        </div>
                    </div>
                </div>

                <div class="hr"></div>

                <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
                </div>

<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).on('click', '#add_new_booking_row', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        var t = $("#bookingcount").val();

        $("#bookingcount").val(parseInt(t) + 1);

        //alert($("#bookingcount").val());

        $.ajax({url: "index.php?r=visits/dailyvisitors/dynamicbookingrow&id=" + $("#bookingcount").val(), success: function (result) {
                $("#booking_list tbody").append(result);
            }});

        return false;
    });
</script>