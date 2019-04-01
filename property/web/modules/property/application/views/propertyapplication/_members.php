<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\application\Propertyapplication */
/* @var $form yii\widgets\ActiveForm */
?>

<table id="members-list" class="table  table-bordered table-hover">
    <thead>
        <tr>
            <th class="center" style="width:40px;">      </th>
            <th>Picture</th>
            <th>Name</th>
            <th>S/o, D/o, W/o</th>
            <th>CNIC</th>
            <th>Contact No.</th>
            <th>Nominee</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="center">      </td>
            <td align="left">
                
            </td>
            <td align="left"><?= $model->member->name ?></td>
            <td align="left"><?= $model->member->sodowo ?></td>
            <td align="left"><?= $model->member->cnic ?></td>
            <td align="left"><?= $model->member->phone ?></td>
            <td align="left"><?= ($model->nominee == null ? "" : $model->nominee->name) ?></td>
        </tr>
        <?php //$rows = $dataProvider->getModels();  ?>
        <?php foreach ($model->plot->jointmembers as $row) {  ?>
        <tr>
            <td class="center">      </td>
            <td align="left"></td>
            <td align="left"><?= $row->member->name ?></td>
            <td align="left"><?= $row->member->sodowo ?></td>
            <td align="left"><?= $row->member->cnic ?></td>
            <td align="left"><?= $row->member->phone ?></td>
            <td align="left"><?= ($row->nominee == null ? "" : $row->nominee->name) ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
