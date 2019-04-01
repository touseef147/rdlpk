<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\Propertyapplication */

$this->title = $model->application_id;
?>
<div class="propertyapplication-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->application_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->application_id], [
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
            'application_id',
            'project_id',
            'sales_center_id',
            'member_id',
            'application_no',
            'property_type',
            'property_size',
            'dealer_id',
            'nominee_id',
            'voucher_id',
        ],
    ]) ?>

</div>
