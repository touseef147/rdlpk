<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "installpayment".
 *
 * @property integer $id
 * @property integer $ref
 * @property string $plot_id
 * @property string $payment_type
 * @property string $paidamount
 * @property string $dueamount
 * @property string $discount
 * @property string $surcharge
 * @property string $lab
 * @property string $paidsurcharge
 * @property string $mem_id
 * @property string $paidas
 * @property string $detail
 * @property string $date
 * @property string $remarks
 * @property string $others
 * @property string $due_date
 * @property string $paid_date
 * @property string $fstatus
 * @property integer $fid
 * @property integer $voucher_plot_detail_id
 * @property integer $trans_type
 * @property integer $plan_type
 * @property integer $transaction_source
 */
class Installpayment extends \yii\db\ActiveRecord {

    public $removerecord = 0;

//
//    public function getRemove_record() {
//        return $this->_remove_record;
//    }
//
//    public function setRemove_record($value) {
//        $this->_remove_record = $value;
//    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'installpayment';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            //[['ref', 'plot_id', 'payment_type', 'paidamount', 'dueamount', 'discount', 'surcharge', 'lab', 'paidsurcharge', 'mem_id', 'paidas', 'detail', 'date', 'remarks', 'others', 'due_date', 'paid_date', 'fstatus', 'fid'], 'required'],
            [['surcharge', 'plot_id', 'ref', 'paidamount', 'mem_id', 'dueamount', 'fid', 'paidsurcharge', 'discount', 'voucher_plot_detail_id', 'trans_type', 'plan_type', 'transaction_source', 'id'], 'integer'],
            [['payment_type', 'fstatus'], 'string', 'max' => 256],
            [['lab'], 'string', 'max' => 255],
            //[[], 'string', 'max' => 100],
            [['paidas', 'detail', 'date', 'remarks', 'others'], 'string', 'max' => 200],
            [['due_date'], 'date'],
            [['removerecord'], 'safe'],
                //[['due_date', 'paid_date'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'ref' => 'Ref',
            'plot_id' => 'Plot ID',
            'payment_type' => 'Payment Type',
            'paidamount' => 'Paidamount',
            'dueamount' => 'Dueamount',
            'discount' => 'Discount',
            'surcharge' => 'Surcharge',
            'lab' => 'Lab',
            'paidsurcharge' => 'Paidsurcharge',
            'mem_id' => 'Mem ID',
            'paidas' => 'Paidas',
            'detail' => 'Detail',
            'date' => 'Date',
            'remarks' => 'Remarks',
            'others' => 'Others',
            'due_date' => 'Due Date',
            'paid_date' => 'Paid Date',
            'fstatus' => 'Fstatus',
            'fid' => 'Fid',
            'voucher_plot_detail_id' => 'Transaction',
            'trans_type' => 'Transaction Type',
            'plan_type' => 'Plan Type',
            'transaction_source' => 'Source',
        ];
    }

    public function getPlot() {
        return $this->hasOne(Plots::className(), ['id' => 'plot_id']);
    }

    public function getReceipt() {
        return $this->hasOne(Fmsvoucherplotdetail::className(), ['voucher_plot_detail_id' => 'voucher_plot_detail_id']);
    }

    public function getMember() {
        return $this->hasOne(Members::className(), ['id' => 'mem_id']);
    }

    public function getShowduedate() {
        if ($this->due_date == '0000-00-00' || $this->due_date == "1970-01-01") {
            return "";
        }

        return date("d-m-Y", strtotime($this->due_date));
    }

    public function getShowpaiddate() {
        if ($this->paid_date == '0000-00-00' || $this->paid_date == "1970-01-01") {
            return "";
        }

        return date("d-m-Y", strtotime($this->paid_date));
    }

    public function getTranstypetitle() {
        if ($this->trans_type == 1) {
            return "";
        } else {
            return "";
        }
    }

    public function getPlantypetitle() {
        if ($this->plan_type == 1) {
            return "";
        } elseif ($this->plan_type == 2) {
            return "Development";
        }
        return "";
    }

    public function getTransactionsourcetitle() {
        if ($this->transaction_source == 1) {
            return "Form";
        } elseif ($this->transaction_source == 2) {
            return "Membership";
        } elseif ($this->transaction_source == 3) {
            return "Transfer";
        } else {
            return "";
        }
    }

    public function updaterecord() {
        if ($this->save()) {
            return TRUE;
        }

        if (Yii::$app->user->identity->rawerrors == 1) {
            echo "<h3>" . $this->className() . " Model: updaterecord</h3>";
            print_r($this->errors);
        }

        return FALSE;
    }

    public static function updateList(&$prevdata, &$newdata, &$count, &$valid, $parentid) {
//        if ($newdata != NULL) {
//            foreach ($newdata as $rec) {
//                if ($rec->id == 0) {
//                    if ($rec->removerecord != 0) {
//                        $newrec = new Installpayment();
//
//                        $newrec->id = 0;
//                        $newrec->plot_id = $parentid; //$model->plan_id;
//                        $newrec->lab = $rec->lab;
//                        $newrec->dueamount = $rec->dueamount;
//                        $newrec->due_date = $rec->due_date;
//                        $newrec->remarks = $rec->remarks;
//
//                        $prevdata[] = $newrec;
//                    }
//                }
//            }
//        }
//
        $valid = \app\models\Model::validateMultiple($prevdata) && $valid;

        if ($valid) {
            foreach ($prevdata as $rec) {
                if ($rec->removerecord != 0) {
                    $rec->delete();
                } else {
                    if ($valid) {
                        $valid = $rec->save(FALSE) && $valid;

                        if (!$valid) {
                            print_r($rec->errors);
                            return false;
                        }
                    } else {
                        print_r($rec);
                        print_r($rec->errors);
                        return false;
                    }
                }
            }
        } else {
            print_r($prevdata);
            return false;
        }

        return $valid;
    }

    public static function generatePlanFromApplication(&$app, $regeenerateplan = false) {
        $file = Plots::find()->where(['application_id' => $app->application_id])->one();

        if ($file == NULL) {
            $app->addError('application_no', 'File does not exist.');
            return FALSE;
        }

        $plan = Installpayment::find()->where(['plot_id' => $file->id])->all();

        if ($regeenerateplan == TRUE) {
            $connection = Yii::$app->getDb();
            $connection->createCommand("delete from installpayment where plot_id =" . $file->id)->execute();
        } else {
            if ($plan != NULL) {
                $app->addError('application_no', 'Installment Plan already exist.'); //.$app->application_id.", ".$file->id);
                return FALSE;
            }
        }

        $count = 0;
        $prevdate = \Yii::$app->formatter->asDate($app->plan_start_date, 'php:Y-m-d');
        $instplandetail = Installmentplandetail::find()->where(['plan_id' => $app->installment_plan])->all();
        $proj = Projects::find()->where(['id' => $app->project_id])->one();

//        if ($app->dealer_id == NULL || $app->dealer_id == 0) {
        $newinstallpayment = new Installpayment();
        $newinstallpayment->due_date = \Yii::$app->formatter->asDate($prevdate, 'php:Y-m-d'); //$prevdate;
        $newinstallpayment->dueamount = $proj->membership_fee;
        $newinstallpayment->mem_id = $app->member_id;
        $newinstallpayment->plot_id = $file->id;
        $newinstallpayment->lab = "Membership Fee";

        $newinstallpayment->trans_type = 1;

        if ($newinstallpayment->save() == FALSE) {
            if (Yii::$app->user->identity->rawerrors == 1) {
                echo "<h3>Installpayment Model: generatePlanFromApplication</h3>";
                print_r($newinstallpayment->errors);
            }
            $app->addError('application_no', 'Failed to generate Installment Plan.');
            return FALSE;
        }
//        }

        if ($app->property_against != 1) {
            foreach ($instplandetail as $rec) {
                if ($count > 0) {
                    //$this->application_date = \Yii::$app->formatter->asDate($this->application_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));
                    if ($rec->gap_type == 1) {
                        $prevdate = date("Y-m-d", strtotime("+" . $rec->gap . " days", strtotime($prevdate)));
                    } else {
                        $prevdate = date("Y-m-d", strtotime("+" . $rec->gap . " months", strtotime($prevdate)));
                    }
                }
                $newinstallpayment = new Installpayment();
                $newinstallpayment->due_date = \Yii::$app->formatter->asDate($prevdate, 'php:Y-m-d'); //$prevdate;
                $newinstallpayment->dueamount = $rec->installment_amount;
                $newinstallpayment->mem_id = $app->member_id;
                $newinstallpayment->plot_id = $file->id;
                $newinstallpayment->lab = $rec->installment_title;

                $newinstallpayment->trans_type = 2;

                if ($newinstallpayment->save() == FALSE) {
                    if (Yii::$app->user->identity->rawerrors == 1) {
                        echo "<h3>Installpayment Model: generatePlanFromApplication</h3>";
                        print_r($newinstallpayment->errors);
                    }
                    $app->addError('application_no', 'Failed to generate Installment Plan.');
                    return FALSE;
                }
                $count++;
            }
        }
        return true;
    }

    public static function paymultipleinstallments(&$installpayments, &$valid, &$amount, $plotid, $parentid) {
        foreach ($installpayments as $payment) {
            if ($payment->plot_id == $plotid && $valid) {
                $instpayment = Installpayment::find()->where(['id' => $payment->id])->one();
                //$payment->isNewRecord = FALSE;
                $instpayment->voucher_plot_detail_id = $parentid;
                $instpayment->paidamount = $payment->paidamount;
                $instpayment->transaction_source = $payment->transaction_source;
                $instpayment->remarks = $payment->remarks;

                $amount += floatval($payment->paidamount);
//$payment->voucher_plot_detail_id = $receipt->voucher_plot_detail_id;
//$payment->due_date = date("Y-m-d", strtotime($payment->due_date));

                if ($valid) {
                    if ($instpayment->paidamount < $instpayment->dueamount && $instpayment->paidamount > 0) {
                        $splitpayment = new Installpayment();

                        $splitpayment->ref = $instpayment->id;
                        $splitpayment->due_date = $instpayment->due_date;
                        $splitpayment->dueamount = floatval($instpayment->dueamount) - floatval($instpayment->paidamount);
                        $splitpayment->plot_id = $instpayment->plot_id;
                        $splitpayment->lab = $instpayment->lab;
                        $splitpayment->mem_id = $instpayment->mem_id;
                        $splitpayment->trans_type = $instpayment->trans_type;
                        $splitpayment->plan_type = $instpayment->plan_type;

                        if (!$splitpayment->save()) {
                            $valid = FALSE;
                            \app\models\Model::showerrors($splitpayment->errors, "Fmsvoucherplotdetail", "updatemultiplerecords");
                        }
                    }
                }

                if ($instpayment->paidamount < $instpayment->dueamount && $instpayment->paidamount > 0) {
                    $instpayment->dueamount = $instpayment->paidamount;
                }

                if ($valid) {
                    if (!$instpayment->save()) {
                        $valid = FALSE;
                        \app\models\Model::showerrors($instpayment->errors, "Fmsvoucherplotdetail", "updatemultiplerecords");
                    }
                }
            }
        }
        return $valid;
    }

    public static function resetmultipleinstallments(&$installpayments, &$valid, &$amount, $plotid, $parentid) {
        foreach ($installpayments as $payment) {
            if ($payment->plot_id == $plotid) {
                $instpayment = Installpayment::find()->where(['id' => $payment->id])->one();
                //$payment->isNewRecord = FALSE;
                if ($instpayment->voucher_plot_detail_id == $parentid) {
                    $instpayment->voucher_plot_detail_id = 0;
                    $instpayment->paidamount = 0;
                    $instpayment->transaction_source = 0;
                }

                if ($valid) {
                    if (!$instpayment->save()) {
                        $valid = FALSE;
                        \app\models\Model::showerrors($instpayment->errors, "Fmsvoucherplotdetail", "updatemultiplerecords");
                    }
                }
            }
        }
        return $valid;
    }

    public static function resetinstallmentsofreceipt(&$valid, $plotid, $parentid) {
        $installpayments = Installpayment::find()->where(['voucher_plot_detail_id' => $parentid])->all();
        foreach ($installpayments as $payment) {
            $instpayment = Installpayment::find()->where(['id' => $payment->id])->one();
            $instpayment->voucher_plot_detail_id = 0;
            $instpayment->paidamount = 0;
            $instpayment->transaction_source = 0;
            if (!$instpayment->save()) {
                $valid = FALSE;
                \app\models\Model::showerrors($instpayment->errors, "Fmsvoucherplotdetail", "updatemultiplerecords");
            }
        }
        return $valid;
    }

    public static function paymultiplememberinstallments(&$installpayments, &$valid) {
        foreach ($installpayments as $payment) {
            $instpayment = Installpayment::find()->where(['id' => $payment->id])->one();
            //$payment->isNewRecord = FALSE;
            $instpayment->voucher_plot_detail_id = $payment->voucher_plot_detail_id;
            $instpayment->paidamount = $payment->paidamount;
            $instpayment->transaction_source = $payment->transaction_source;
            $instpayment->remarks = $payment->remarks;

//            $amount += floatval($payment->paidamount);
//$payment->voucher_plot_detail_id = $receipt->voucher_plot_detail_id;
//$payment->due_date = date("Y-m-d", strtotime($payment->due_date));

            if ($valid) {
                if ($instpayment->paidamount < $instpayment->dueamount && $instpayment->paidamount > 0) {
                    $splitpayment = new Installpayment();

                    $splitpayment->ref = $instpayment->id;
                    $splitpayment->due_date = $instpayment->due_date;
                    $splitpayment->dueamount = floatval($instpayment->dueamount) - floatval($instpayment->paidamount);
                    $splitpayment->plot_id = $instpayment->plot_id;
                    $splitpayment->lab = $instpayment->lab;
                    $splitpayment->mem_id = $instpayment->mem_id;
                    $splitpayment->trans_type = $instpayment->trans_type;
                    $splitpayment->plan_type = $instpayment->plan_type;

                    if (!$splitpayment->save()) {
                        $valid = FALSE;
                        \app\models\Model::showerrors($splitpayment->errors, "Fmsvoucherplotdetail", "updatemultiplerecords");
                    }
                }
            }

            if ($instpayment->paidamount < $instpayment->dueamount && $instpayment->paidamount > 0) {
                $instpayment->dueamount = $instpayment->paidamount;
            }

            if ($valid) {
                if (!$instpayment->save()) {
                    $valid = FALSE;
                    \app\models\Model::showerrors($instpayment->errors, "Fmsvoucherplotdetail", "updatemultiplerecords");
                }
            }
        }
        return $valid;
    }

}
