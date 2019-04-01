<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\application\Members */
/* @var $form yii\widgets\ActiveForm */
?>
<?= Html::activeInput('hidden', $modelnominee, 'parent_id', ['class' => '']) ?>


<div class="padding-8" style="padding: 8px 8px;">
    <h4>
        <span class=" pull-right smaller-70">
            <a class="sublinkreset configurablelink" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/findrecord">
                <i class="ace-icon fa fa-arrow-left"></i>
                Search Again
            </a>
        </span>
    </h4>

    <table style="width: 100%;">
        <tr>
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                Name
            </td>
            <td style="border-bottom: dotted">
                <?php echo $model->name; ?>
            </td>
            <td rowspan="4" style="padding-left: 20px;">
                <img src="<?php echo Yii::$app->urlManager->baseUrl; ?>/uploads/members/pictures/<?php echo $model->image; ?>?<?php echo date('H-i-s'); ?>" height="120">

            </td>
        </tr>
        <tr>
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                <?php echo $model->relationname ?>
            </td>
            <td style="border-bottom: dotted">
                <?php echo $model->sodowo; ?>
            </td>
        </tr>
        <tr>
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">
                CNIC
            </td>
            <td style="border-bottom: dotted">
                <?php echo $model->cnic; ?>
            </td>
        </tr>
    </table>
    <h4 class="row header smaller lighter blue">
        <span class="col-sm-7">
            <i class="ace-icon fa fa-th-large"></i>
            Select Nominee
        </span><!-- /.col -->
        <span class=" pull-right smaller-70">
            <a class="sublink configurablelink purple" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/index.php?r=members/members/createnominee&parentid=<?php echo $modelnominee->parent_id; ?>">
                <i class="ace-icon fa fa-plus"></i>
                Add Nominee
            </a>&nbsp;
        </span>
    </h4>

    <table style="width: 100%;">
        <tr>
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 45px;">
                Nominee
            </td>
            <td>
                <?=
                Html::activeDropDownList($modelnominee, 'id', ArrayHelper::map(app\models\application\Members::find()->where(['parent_id' => $model->id])->all(), 'id', 'name'), // Flat array ('id'=>'label')
                        ['prompt' => 'Select a Nominee',
                    'onchange' => ' 
                                    $.get( "' . Url::toRoute('/members/members/nomineedetail') . '", '
                    . '             { '
                    . '                 id: $(this).val(), '
                    . '                 
                                                } 
                                             )
                                            .done(function( data ) {
                                                $( "#nomineedetail" ).html( data );
                                            }
                                        );
                                    '
                        ]
                )
                ?>
                <?= Html::error($modelnominee, 'id', ['class' => 'help-block']) ?>
            </td>
        </tr>
        <tr>
            <td>

            </td>
            <td id="nomineedetail">
            </td>
        </tr>
        <tr class="subpage_actions">
            <td style="text-align: right; width: 100px; padding-right: 5px; height: 25px;">

            </td>
            <td>
                <div class="form-group pull-right" style="padding-top: 10px;">
                    <button type="button" class="btn btn-primary btn-white btn-round btnsubmitsubpage">
                        Select
                        <i class="ace-icon fa fa-arrow-right icon-on-right bigger-125"></i>
                    </button>
                </div>
            </td>
        </tr>
    </table>
</div>
