<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\members\models\Members */

$this->title = $model->name;
?>
<div class="members-view">

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
            'name',
            'mem_id',
            'username',
            'sodowo',
            'cnic',
            'image',
            'address',
            'city_id',
            'phone',
            'email:email',
            'country_id',
            'state',
            'nomineename',
            'nomineecnic',
            'rwa',
            'password',
            'status',
            'fp',
            'login_status',
            'user_id',
            'create_date',
            'modify_date',
            'dob',
            'RFM',
        ],
    ]) ?>

</div>
