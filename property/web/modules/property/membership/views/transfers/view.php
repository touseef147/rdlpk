<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\application\Propertymemberships */

$this->title = $model->ms_id;
?>
<div class="propertymemberships-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ms_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ms_id], [
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
            'ms_id',
            'plot_id',
            'member_id',
            'ms_no',
            'ms_status',
            'created_on',
            'modified_on',
            'is_joint',
            'parent_ms_id',
            'user_id',
            'is_active',
        ],
    ]) ?>

</div>
