<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\security\models\User */

$this->title = $model->id;
?>
<div class="user-view">

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
            'firstname',
            'middelname',
            'lastname',
            'pic',
            'sodowo',
            'cnic',
            'address',
            'city',
            'email:email',
            'state',
            'zip',
            'country',
            'mobile',
            'username',
            'password',
            'per1',
            'per2',
            'per3',
            'per4',
            'per5',
            'per6',
            'per7',
            'per8',
            'per9',
            'per10',
            'per11',
            'per12',
            'per13',
            'per14',
            'per15',
            'per16',
            'per17',
            'status',
            'fp',
            'login_status',
            'user_id',
            'create_date',
            'modify_date',
        ],
    ]) ?>

</div>
