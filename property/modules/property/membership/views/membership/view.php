<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\application\Plots */

$this->title = $model->id;
?>
<div class="plots-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'project_id',
            'street_id',
            'plot_detail_address',
            'plot_size',
            'size2',
            'installment',
            'price',
            'create_date',
            'modify_date',
            'com_res',
            'category_id',
            'sector',
            'image',
            'shap_id',
            'cstatus',
            'status',
            'fstatus',
            'rstatus',
            'bstatus',
            'bid',
            'atype',
            'rownumber',
            'application_id',
            'ms_member_id',
            'ms_creation_date',
            'ms_modification_date',
            'ms_status',
            'ms_no',
        ],
    ]) ?>

</div>
