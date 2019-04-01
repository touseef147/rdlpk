<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "fms_voucher".
 *
 * @property string $voucher_id
 * @property integer $bank_id
 * @property string $entry_date
 * @property string $transaction_date
 * @property string $voucher_sr_no
 * @property integer $sales_center_id
 * @property integer $project_id
 * @property string $folio_no
 * @property string $amount
 * @property string $serial_no
 * @property integer $entry_status
 * @property integer $amount_type
 * @property string $narration
 * @property integer $member_id
 * @property integer $target_bank_id
 * @property string $forward_date
 * @property string $verification_date
 * @property string $approval_date
 */
class Fmsvoucher extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'fms_voucher';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['entry_date', 'sales_center_id', 'entry_status', 'member_id', 'project_id'], 'required'], //'folio_no', 
            [['bank_id', 'sales_center_id', 'entry_status', 'amount', 'amount_type', 'member_id', 'project_id', 'target_bank_id'], 'integer'],
            [['entry_date', 'transaction_date', 'narration', 'forward_date', 'verification_date', 'approval_date', 'center_remarks', 'verification_remarks', 'approval_remarks', 'person_name'], 'safe'],
            [['voucher_sr_no', 'folio_no'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'voucher_id' => 'Voucher',
            'bank_id' => 'Bank',
            'entry_date' => 'Entry Date',
            'transaction_date' => 'Transaction Date',
            'voucher_sr_no' => 'Cheque/DD/PO',
            'sales_center_id' => 'Sales Center',
            'folio_no' => 'Folio No',
            'amount' => 'Total Amount',
            'amount_Type' => 'Type',
            'serial_no' => 'Serial No',
            'entry_status' => 'Entry Status',
            'narration' => 'Narration',
            'member_id' => 'Member',
            'project_id' => 'Project',
            'target_bank_id' => 'Target Bank',
            'forward_date' => 'Date (Forwarded)',
            'verification_date' => 'Verification Date',
            'approval_date' => 'Approval Date',
            'center_remarks' => 'Sales Center Remarks',
            'verification_remarks' => 'Verification Remarks',
            'approval_remarks' => 'Approval Remarks',
            'person_name' => 'Person Name',
        ];
    }

    public static function statuslist() {
        return [
            1 => "Pending",
            2 => "Submitted",
            3 => "Forwarded",
            4 => "Verified",
            5 => "Approved",
        ];
    }

    public function getEntrystatustitle() {
        if ($this->entry_status == 0) {
            return "New";
        } elseif ($this->entry_status == 1) {
            return "Pending";
        } elseif ($this->entry_status == 2) {
            return "Submitted";
        } elseif ($this->entry_status == 3) {
            return "Forwarded";
        } elseif ($this->entry_status == 4) {
            return "Verified";
        } elseif ($this->entry_status == 5) {
            return "Approved";
        } else {
            return "";
        }
    }

    public function getAmounttypetitle() {
        if ($this->amount_type == 1) {
            return "Cash";
        } elseif ($this->amount_type == 2) {
            return "Cheque";
        } elseif ($this->amount_type == 3) {
            return "";
        } elseif ($this->amount_type == 4) {
            return "";
        } elseif ($this->amount_type == 5) {
            return "Funds Transfer";
        } else {
            return "";
        }
    }

    public function getShowentrydate() {
        if ($this->entry_date == "0000-00-00" || $this->entry_date == "1970-01-01") {
            return "";
        }

        return date("d-m-Y", strtotime($this->entry_date));
    }

    public function getForwarddate() {
        if ($this->forward_date == "0000-00-00" || $this->forward_date == "1970-01-01") {
            return "";
        }

        return date("d-m-Y", strtotime($this->forward_date));
    }

    public function getVerificationdate() {
        if ($this->verification_date == "0000-00-00" || $this->verification_date == "1970-01-01") {
            return "";
        }

        return date("d-m-Y", strtotime($this->verification_date));
    }

    public function getApprovaldate() {
        if ($this->approval_date == "0000-00-00" || $this->approval_date == "1970-01-01") {
            return "";
        }

        return date("d-m-Y", strtotime($this->approval_date));
    }

    public function getShowtransactiondate() {
        if ($this->transaction_date == "0000-00-00" || $this->transaction_date == "1970-01-01") {
            return "";
        }

        return date("d-m-Y", strtotime($this->transaction_date));
    }

    public function getPerson() {
        return $this->hasOne(Members::className(), ['id' => 'member_id']);
    }

    public function getDepositedbank() {
        return $this->hasOne(Fmsbanks::className(), ['bank_id' => 'bank_id']);
    }

    public function getTargetbank() {
        return $this->hasOne(Fmsbanks::className(), ['bank_id' => 'target_bank_id']);
    }

    public function getSalescenter() {
        return $this->hasOne(Salescenter::className(), ['id' => 'sales_center_id']);
    }

    public function getProject() {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }

    public function getTransactioncomments() {
        return $this->hasMany(Fmsvouchercomments::className(), ['voucher_id' => 'voucher_id']);
    }

    public function getReceipts() {
        return $this->hasMany(Fmsvoucherplotdetail::className(), ['voucher_id' => 'voucher_id']);
    }

    public function validaterecord(&$receipts, &$installpayments) {
        if ($receipts == NULL || count($receipts) == 0) {
            $this->addError("project_id", "Instrument detail is missing.");
            return FALSE;
        }

//        for ($i = 0; $i < count($receipts); $i++) {
//            if ($receipts[$i]->receipt_no == "") {
//                $receipts[$i]->addError("receipt_no", "Receipt number is missing.");
//                return FALSE;
//            }
//            
//            $checkreceipt = Fmsvoucherplotdetail::find()->where(['receipt_no' => $receipts[$i]->receipt_no])->one();
//        }

        for ($i = 0; $i < count($installpayments); $i++) {
            if ($installpayments[$i]->dueamount < $installpayments[$i]->paidamount) {
                $installpayments[$i]->addError("paidamount", "Paid Amount is wrong.");
                return FALSE;
            }
        }

        if ($this->entry_status != 1) {
            if ($this->amount_type == 5) {
                $funds = \app\models\application\fmstransdetaildist::find()->joinWith('transaction')->where(['distributed_to_id' => $this->member_id, 'distributed_to_type' => "Dealer", 'against' => 4, 'fms_trans_master.project_id' => $this->project_id])->select('sum(dr_amount) as dr_amount, sum(cr_amount) as cr_amount')->groupBy(['distributed_to_id'])->one(); //->one();

                if ($funds != NULL) {
                    if (floatval($funds->cr_amount) < floatval($this->amount)) {
                        $this->addError("amount", "Not enough amount.");
                        return FALSE;
                    }
                } else {
                    $this->addError("amount", "Not enough amount.");
                    return FALSE;
                }

                $value = array_sum(array_map(function($item) {
                            return $item['paidamount'];
                        }, $installpayments)); //array_sum(array_column($installpayments,'paidamount'));

                $this->amount = floatval($value);
            } else {
                $total = $this->amount;
                $value = array_sum(array_map(function($item) {
                            return $item['paidamount'];
                        }, $installpayments)); //array_sum(array_column($installpayments,'paidamount'));

                if (floatval($value) > floatval($total)) {
                    $this->addError('amount', 'Total amount does not match.');
                    return FALSE;
                }
            }
        }

        return TRUE;
    }

    public function updateinstrument() {
        $this->entry_date = \Yii::$app->formatter->asDate($this->entry_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));
        $this->transaction_date = \Yii::$app->formatter->asDate($this->transaction_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));

        if ($this->entry_status == NULL) {
            $this->entry_status = -2;
        }

//        if ($this->validaterecord($receipts, $installpayments) == false) {
//            return false;
//        }

        $valid = TRUE;
//        $transaction = \Yii::$app->db->beginTransaction();
        $newrecord = ($this->voucher_id == 0 ? true : false);

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "updaterecord");
        }

        if ($valid) {
            $valid = Fmsvouchercomments::updatesystemcomments(($newrecord ? "New Record." : "Record Updated."), 1, $this->voucher_id) && $valid;
        }

  //      ($valid ? $transaction->commit() : $transaction->rollBack());
        return $valid;
    }

    public function updaterecord(&$receipts, &$installpayments) {
        $this->entry_date = \Yii::$app->formatter->asDate($this->entry_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));
        $this->transaction_date = \Yii::$app->formatter->asDate($this->transaction_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));

        if ($this->entry_status == NULL || $this->entry_status < 1) {
            $this->entry_status = 1;
        }

        if ($this->validaterecord($receipts, $installpayments) == false) {
            return false;
        }

        $valid = TRUE;
        $transaction = \Yii::$app->db->beginTransaction();
        $newrecord = ($this->voucher_id == 0 ? true : false);

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "updaterecord");
        }
//paymultiplememberinstallments
        if ($valid) {
//            Fmsvoucherplotdetail::updatemultiplerecords($receipts, $installpayments, $valid, $this->voucher_id);
            $valid = Installpayment::paymultiplememberinstallments($installpayments, $valid) && $valid; 

            if ($valid && $this->amount_type == 5) {
                $valid = Fmstransmaster::adjustdealerinstrumentfromreceipts($this->member_id, $this->amount, $this->voucher_id, $this->entry_date, $this->project_id, $this->sales_center_id);
            }
        }

        if ($valid) {
            $valid = Fmsvouchercomments::updatesystemcomments(($newrecord ? "New Record." : "Record Updated."), 1, $this->voucher_id) && $valid;
        }

        ($valid ? $transaction->commit() : $transaction->rollBack());
        return $valid;
    }

    public function submitrecord(&$receipts, &$installpayments) {
        $this->entry_date = \Yii::$app->formatter->asDate($this->entry_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));
        $this->transaction_date = \Yii::$app->formatter->asDate($this->transaction_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));

        if ($this->amount_type == 5) {
            $this->entry_status = 3;
        } else {
            $this->entry_status = 2;
        }

        if ($this->validaterecord($receipts, $installpayments) == false) {
            return false;
        }

        $valid = TRUE;
        $transaction = \Yii::$app->db->beginTransaction();

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "updaterecord");
        }

        if ($valid) {
            Fmsvoucherplotdetail::updatemultiplerecords($receipts, $installpayments, $valid, $this->voucher_id);

            if ($valid && $this->amount_type == 5) {
                $valid = Fmstransmaster::adjustdealerinstrumentfromreceipts($this->member_id, $this->amount, $this->voucher_id, $this->entry_date, $this->project_id, $this->sales_center_id);
            }
        }

        if ($valid) {
            $valid = Fmsvouchercomments::updatesystemcomments("Record Submitted.", 1, $this->voucher_id) && $valid;
        }

        ($valid ? $transaction->commit() : $transaction->rollBack());
        return $valid;
    }

    public function forwardrecord($receipts) {
        //$this->entry_date = \Yii::$app->formatter->asDate($this->entry_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));
        $this->forward_date = date("Y-m-d");
        $this->entry_status = 3;

        $valid = TRUE;
        //$transaction = \Yii::$app->db->beginTransaction();

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "forwardrecord");
        }

        if ($valid) {
            $valid = Fmsvoucherplotdetail::updatemultipledepositslips($receipts) && $valid;
        }

        if ($valid) {
            $valid = Fmsvouchercomments::updatesystemcomments("Record Forwarded.", 1, $this->voucher_id) && $valid;
        }
        //($valid ? $transaction->commit() : $transaction->rollBack());
        return $valid;
    }

    public function verifyrecord() {
        //$this->entry_date = \Yii::$app->formatter->asDate($this->entry_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));
        $this->verification_date = date("Y-m-d");
        $this->entry_status = 4;

        $valid = TRUE;
//        $transaction = \Yii::$app->db->beginTransaction();

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "verifyrecord");
        }

        if ($valid) {
            $valid = Fmsvouchercomments::updatesystemcomments("Record Verified.", 1, $this->voucher_id) && $valid;
        }
//        ($valid ? $transaction->commit() : $transaction->rollBack());
        return $valid;
    }

    public function approverecord() {
        //$this->entry_date = \Yii::$app->formatter->asDate($this->entry_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));
        $this->approval_date = date("Y-m-d");
        $this->entry_status = 5;

        $valid = TRUE;
//        $transaction = \Yii::$app->db->beginTransaction();

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "approverecord");
        }

        if ($valid) {
            $valid = Fmsvouchercomments::updatesystemcomments("Record Approved.", 1, $this->voucher_id) && $valid;
        }
//        ($valid ? $transaction->commit() : $transaction->rollBack());
        return $valid;
    }

    public function updatedealerrecord(&$receipts, &$installpayments) {
        $this->entry_date = \Yii::$app->formatter->asDate($this->entry_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));
        $this->transaction_date = \Yii::$app->formatter->asDate($this->transaction_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));

        $this->amount_type = 5;
        $this->amount = 0;

        if ($this->entry_status == NULL) {
            $this->entry_status = 1;
        }

        if ($this->validaterecord($receipts, $installpayments) == false) {
            echo "validation failed.";
            return false;
        }

        $valid = TRUE;
        $transaction = \Yii::$app->db->beginTransaction();
        $newrecord = ($this->voucher_id == 0 ? true : false);

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "updaterecord");
        }

        if ($valid) {
            $valid = Fmsvoucherplotdetail::updatemultiplerecords($receipts, $installpayments, $valid, $this->voucher_id) & $valid;

            if ($valid) {                
                foreach ($installpayments as $payment) {
                    $this->amount += floatval($payment->paidamount);

                    if (!$this->save(FALSE)) {
                        $valid = FALSE;
                        \app\models\Model::showerrors($this->errors, $this->className(), "updaterecord");
                    }
                }
            }

            if ($valid && $this->amount_type == 5) {
                $valid = Fmstransmaster::adjustdealerinstrumentfromreceipts($this->member_id, $this->amount, $this->voucher_id, $this->entry_date, $this->project_id, $this->sales_center_id);
            }
        }

        if ($valid) {
            $valid = Fmsvouchercomments::updatesystemcomments(($newrecord ? "New Record." : "Record Updated."), 1, $this->voucher_id) && $valid;
        }

        ($valid ? $transaction->commit() : $transaction->rollBack());
        return $valid;
    }


    public function updatereceipts(&$receipts) {
        $this->entry_status = -1;

        $valid = TRUE;
        $transaction = \Yii::$app->db->beginTransaction();

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "updaterecord");
        }

        if ($valid) {
            $valid = Fmsvoucherplotdetail::updatemultiplereceipts($receipts, $valid, $this->voucher_id) && $valid; 
        }

        if ($valid) {
            $valid = Fmsvouchercomments::updatesystemcomments("Receipts Generated.", 1, $this->voucher_id) && $valid;
        }

        ($valid ? $transaction->commit() : $transaction->rollBack());
        return $valid;
    }
}
