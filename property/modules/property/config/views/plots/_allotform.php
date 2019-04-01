<?php
use app\models\application\Installmentplan;
use app\models\application\Projects;
use app\models\application\Sectors;
use app\models\application\Members;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\application\Plots */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plots-form">
    <?=
    Breadcrumb::widget([
        "items" => [
            ["link" => "property", "title" => "Property"],
            ["link" => "property/config", "title" => "Configuration"],
            ["link" => "property/config/plots/index", "title" => "Plots"],
            ["link" => "", "title" => "Allottment"],
        ],
    ])
    ?>

    <div class="page-content">

        <?= \app\components\Pageheader::widget(["title" => Html::encode($this->title), "subtitle" => ""]) ?>

        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-7">
                        <div class="row-fluid form-row">
                            <div class="col-xs-3 form-label-right"> Plot Information </div>
                            <br /><strong>Size</strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $model->sizeCat->size;
echo'(' . $model->plot_size . ')'; ?>
                            <br /><strong>Street No</strong>:&nbsp;<?php echo $model->street->street; ?>
                            <br /><strong>Sector</strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
if ($model->plotsector == null)
    echo "";
else
    echo ($model->sector == 0 ? "" : $model->plotsector->sector_name);
?></br>

                            <br /><strong>Project</strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
echo $model->project->project_name;
?>

                            
?>
                            </br>

                        </div>
                    </div></br>
                    </br>
                    <input type="hidden" id="search_nav_link" value="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=propertyconfig/plots/sidebarinput">

<?php $form = ActiveForm::begin(['options' => ['class' => 'frminput']]); ?>

                    <?= Html::activeHiddenInput($model, 'type', ["value" => "Plot"]); ?>
                    <?php // echo $form->hiddenField($model, 'type'); ?>									
                    <div class="col-xs-3">
                        <?= $form->field($model, 'plot_detail_address')->textInput(['maxlength' => true]) ?></div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'plot_size')->textInput(['maxlength' => true]) ?></div>
                    <div class="col-xs-3">
                        <?php
                        echo $form->field($model, 'size2')
                                ->dropDownList(
                                        ArrayHelper::map(app\models\application\Sizecat::find()->all(), 'id', 'size'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select a Size']    // options
                        );
                        ?></div>

                    <div class="col-xs-3"><?php
                        echo $form->field($model, 'com_res')
                                ->dropDownList(
                                        array('Residential' => 'Residential', 'Commercial' => 'Commercial'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select Type']    // options
                        );
                        ?></div>
                    <div class="col-xs-3">
                        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?></div>
                    <div class="col-xs-3"><?php
                        echo $form->field($model, 'cstatus')
                                ->dropDownList(
                                        array('Developed' => 'Developed', 'Undeveloped' => 'Undeveloped'), // Flat array ('id'=>'label')
                                        ['prompt' => 'Select Developed/Undeveloped']    // options
                        );
                        ?></div>



                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Allot Plot', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            </div>
                        </div>
                    </div>
<?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        $(document).on('change', 'plots-project_id', function (event) {
            event.stopImmediatePropagation();
            event.preventDefault();

            //   var t =  $("#bookingcount").val();

            //   $("#bookingcount").val(parseInt(t)+1);

            alert($("#project_id").val());

            // $.ajax({url: "index.php?r=visits/dailyvisitors/dynamicbookingrow&id=" + $("#bookingcount").val(), success: function(result){
            //         $("#booking_list tbody").append(result);
            //}});

            return false;
        });
    </script>