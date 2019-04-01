<?php

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\application\City;
use app\models\application\Country;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Members */
/* @var $form yii\widgets\ActiveForm */
?>

<?= Html::activeInput('hidden', $model, 'parent_id', ['class' => '']) ?>
<?= Html::activeInput('hidden', $model, 'id', ['class' => '']) ?>

<div class="padding-8" style="padding: 8px 8px;">
    <h3 class="row header smaller lighter blue">
        <span class="col-sm-7">
            <i class="ace-icon fa fa-th-large"></i>
            Nominee Details
        </span><!-- /.col -->

    </h3>
    <div class="row">
        <div class="col-xs-5">

            <?= Html::activeLabel($model, 'name', ['class' => 'control-label']) ?>
            <?= Html::activeInput('text', $model, 'name', ['class' => 'col-xs-12']) ?>
            <?= Html::error($model, 'name', ['class' => 'help-block']) ?>

        </div>

        <div class="col-xs-2">
            <?= Html::activeLabel($model, 'rwa', ['class' => 'control-label']) ?><br />
            <?=
            Html::activeDropDownList($model, 'rwa', \app\models\application\Members::Relationslist(), // Flat array ('id'=>'label')
                    ['prompt' => 'Select a Relation',
                    ]
            )
            ?>
            <?= Html::error($model, 'rwa', ['class' => 'help-block']) ?>
        </div>

        <div class="col-xs-5">
            <?= Html::activeLabel($model, 'sodowo', ['class' => 'control-label']) ?>
            <?= Html::activeInput('text', $model, 'sodowo', ['class' => 'col-xs-12']) ?>
            <?= Html::error($model, 'sodowo', ['class' => 'help-block']) ?>

        </div>
    </div>

    <div class="row">
        <div class="col-xs-3">

            <?= Html::activeLabel($model, 'relation_with_member', ['class' => 'control-label']) ?>
            <?= Html::activeInput('text', $model, 'relation_with_member', ['class' => 'col-xs-12']) ?>
            <?= Html::error($model, 'relation_with_member', ['class' => 'help-block']) ?>

        </div>

        <div class="col-xs-3">

            <?= Html::activeLabel($model, 'dob', ['class' => 'control-label']) ?>
            <?= Html::activeInput('text', $model, 'dob', ['class' => 'col-xs-12 date-picker']) ?>
            <?= Html::error($model, 'dob', ['class' => 'help-block']) ?>

        </div>

        <div class="col-xs-3">

            <?= Html::activeLabel($model, 'cnic', ['class' => 'control-label']) ?>
            <?= Html::activeInput('text', $model, 'cnic', ['class' => 'col-xs-12']) ?>
            <?= Html::error($model, 'cnic', ['class' => 'help-block']) ?>

        </div>
        <div class="col-xs-3">
            <?= Html::activeLabel($model, 'picture', ['class' => 'control-label']) ?>
            <?= Html::activeInput('file', $model, 'picture', ['class' => 'col-xs-12']) ?>
            <?= Html::error($model, 'picture', ['class' => 'help-block']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3">

            <?= Html::activeLabel($model, 'phone', ['class' => 'control-label']) ?>
            <?= Html::activeInput('text', $model, 'phone', ['class' => 'col-xs-12']) ?>
            <?= Html::error($model, 'phone', ['class' => 'help-block']) ?>

        </div>
        <div class="col-xs-3">

            <?= Html::activeLabel($model, 'email', ['class' => 'control-label']) ?>
            <?= Html::activeInput('text', $model, 'email', ['class' => 'col-xs-12']) ?>
            <?= Html::error($model, 'email', ['class' => 'help-block']) ?>

        </div>
        <div class="col-xs-3">
            <?= Html::activeLabel($model, 'country_id', ['class' => 'control-label']) ?><br />
            <?=
            Html::activeDropDownList($model, 'country_id', ArrayHelper::map(Country::find()->all(), 'id', 'country'), // Flat array ('id'=>'label')
                    ['prompt' => 'Select a Country',
                'onchange' => ' 
                            $.get( "' . Url::toRoute('/members/members/ddcontrollercities') . '", { id: $(this).val() } )
                                .done(function( data ) {
                                    $( "#' . Html::getInputId($model, 'city_id') . '" ).html( data );
                                }
                            );',
                    ]
            )
            ?>
            <?= Html::error($model, 'country_id', ['class' => 'help-block']) ?>
        </div>
        <div class="col-xs-3">
            <?= Html::activeLabel($model, 'city_id', ['class' => 'control-label']) ?><br />
            <?= Html::activeDropDownList($model, 'city_id', ['prompt' => 'Select a City'])
            ?>
            <?= Html::error($model, 'city_id', ['class' => 'help-block']) ?>
            <?php /*                                    echo $form->field($model, 'city_id')
              ->dropDownList(
              // Flat array ('id'=>'label')
              ['prompt'=>'Select a City']    // options
              );
             */ ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-9">
            <?= Html::activeLabel($model, 'address', ['class' => 'control-label']) ?>
            <?= Html::activeInput('text', $model, 'address', ['class' => 'col-xs-12']) ?>
            <?= Html::error($model, 'address', ['class' => 'help-block']) ?>

        </div>



    </div>


        <div class="row">
            <div class="col-xs-12">
                <div class="form-group pull-right" style="padding-top: 10px;">
                    <button type="button" class="btn btn-primary btn-white btn-round btnsubmitandcontsubpage" data-url="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/createnominee&parentid=<?php echo $model->parent_id; ?>">
                        Update
                        <i class="ace-icon fa fa-arrow-right icon-on-right bigger-125"></i>
                    </button>
                </div>
            </div>
        </div>
</div>
