<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\propertyconfig\models\Projects */

$this->title = $model->id;
?>
<div class="projects-view">

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
            'project_name',
            'url:url',
            'code',
            'teaser:ntext',
            'details:ntext',
            'project_image',
            'project_map',
            'land_map',
            'status',
            'create_date',
            'modify_date',
        ],
    ]) ?>

</div>
