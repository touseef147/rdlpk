<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>

                                            <tr>
                                                <td align="left">
                                            <?=
                                            Html::hiddenInput('Installpayment[' . $id . '][id]', 0);
                                            
                                            ?>
                                                    <?=
                                                    Html::textInput('Installpayment[' . $id . '][lab]', '');
                                                    
                                                    ?>
                                                </td>
                                                <td align="left">
                                                    <?=
                                                    Html::textInput('Installpayment[' . $id . '][due_date]', date("d-m-Y"));
                                                    
                                                    ?>
                                                </td>
                                                <td align="right">
                                                    <?=
                                                    Html::textInput('Installpayment[' . $id . '][dueamount]', '0');
                                                    
                                                    ?>
                                                </td>
                                                <td align="left">
                                                    <?=
                                                    Html::textInput('Installpayment[' . $id . '][remarks]', '');
                                                    
                                                    ?>
                                                </td>
                                                <td class="center">
                                                    <input type="checkbox" value="0" onclick="javascript: if (this.checked)
                                                                    this.value = '1';
                                                                else
                                                                    this.value = '0';" name="Installpayment[<?php echo $id; ?>][removerecord]" id="Installpayment-<?php echo $id; ?>_removerecord" />
                                                </td>
                                            </tr>
