<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;

//$form = new \yii\bootstrap\ActiveForm();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

                                                        $booking = new \app\modules\visits\models\Interestbooking();
                                                        ?>
                                                    <tr>
                                                        <td class="">
                                                            <?php
                                                            echo Html::dropDownList('Interestbooking['.$id.'][com_res]',null,
                                                                            array('Commercial' => 'Commercial', 'Residential' => 'Residential'), 
                                                                            ['prompt' => '---']    // options
                                                                    );
                                                            ?>
                                                        </td>

                                                        <td>
                                                            <?php
                                                            echo Html::dropDownList('Interestbooking['.$id.'][size2]',null,
                                                                        ArrayHelper::map(app\modules\propertyconfig\models\Sizecat::find()->all(), 'id', 'size'),           // Flat array ('id'=>'label')
                                                                        ['prompt'=>'---']    // options
                                                                    );
                                                            ?>
                                                        </td>

                                                        <td class="hidden-480">
                                                            <?= Html::textInput('Interestbooking['.$id.'][booking_date]') ?>
                                                        </td>
                                                        <td class="hidden-480">
                                                            <?= Html::textInput('Interestbooking['.$id.'][no_of_plots]') ?>
                                                        </td>
                                                        <td class="hidden-480">
                                                            <?php
                                                            echo Html::dropDownList('Interestbooking['.$id.'][type]',null,
                                                                            array('Booking' => 'Booking', 'Interest' => 'Interest'), // Flat array ('id'=>'label')
                                                                            ['prompt' => '---']    // options
                                                                    );
                                                            ?>
                                                        </td>
                                                        <td class="hidden-480">
                                                            <?php
                                                            echo Html::dropDownList('Interestbooking['.$id.'][center_id]',null,
                                                                            ArrayHelper::map(\app\modules\propertyconfig\models\Salescenter::find()->joinWith("permissions")->orderBy("sales_center.name")->where(['centers_permissions.user_id'=>$_SESSION["user_array"]["id"]])->all(), 'id', 'name'),           // Flat array ('id'=>'label')
                                                                                ['prompt' => '---',
                                                                                    //'name'=>'Interestbooking['.$bcount.'][center_id]'
                                                                                    ]    // options
                                                                    );
                                                            ?>
                                                        </td>
                                                        <td class="hidden-480">
                                                            <?php 
															 echo Html::dropDownList('Interestbooking['.$id.'][project_id]',null,
                                                                            ArrayHelper::map(\app\modules\propertyconfig\models\Projects::find()->joinWith("permissions")->orderBy("projects.project_name")->where(['project_permissions.user_id'=>$_SESSION["user_array"]["id"]])->all(), 'id', 'project_name'),           // Flat array ('id'=>'label')
                                                                                ['prompt' => '---',
                                                                                    //'name'=>'Interestbooking['.$bcount.'][center_id]'
                                                                                    ]    // options
                                                                    );
															
															
															/*
                                                            echo Html::dropDownList('Interestbooking['.$id.'][project_id]',null,
                                                                        ArrayHelper::map(app\modules\propertyconfig\models\Projects::find()->all(), 'id', 'project_name'),           // Flat array ('id'=>'label')
                                                                        ['prompt'=>'---']    // options
                                                                    );*/
                                                            ?>
                                                        </td>
                                                    </tr>