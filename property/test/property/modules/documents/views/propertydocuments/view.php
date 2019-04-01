<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\application\Propertydocuments */

$this->title = $model->title;
?>
<div class="propertydocuments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->document_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->document_id], [
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
            'document_id',
            'category_id',
            'title',
            'file_name',
            'remarks',
            'project_id',
            'sales_center_id',
            'membership_id',
            'entered_by',
            'entry_date',
            'application_id',
            'plot_id',
        ],
    ]) ?>

</div>
