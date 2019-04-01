<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "fms_voucher_plot_detail".
 *
 * @property string $voucher_plot_detail_id
 * @property string $voucher_id
 * @property string $plot_id
 * @property string $membership_id
 * @property string $serial_no
 * @property double $amount
 * @property integer $project_id
 * @property integer $application_id
 * @property integer $transaction_source
 * @property string $jv_no
 * @property integer $target_bank_id
 * @property string $deposit_date
 * @property string $clearance_date
 */
class Fmsvoucherplotdetail extends \yii\db\ActiveRecord {

    private $_is_selected;
    private $_ms_no;

    public function getIs_selected() {
        return $this->_is_selected;
    }

    public function setIs_selected($value) {
        $this->_is_selected = $value;
    }

    public function getMs_no() {
        return $this->_ms_no;
    }

    public function setMs_no($value) {
        $this->_ms_no = $value;
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'fms_voucher_plot_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            //[['voucher_id', 'member_id', 'plot_id', 'membership_id', 'serial_no', 'amount', 'project_id'], 'required'],
            [['voucher_plot_detail_id', 'voucher_id', 'plot_id', 'membership_id', 'serial_no', 'project_id', 'transaction_source', 'application_id', 'target_bank_id'], 'integer'],
            [['amount'], 'number'],
            [['is_selected', 'ms_no'], 'safe'],
            [['receipt_no', 'narration', 'jv_no', 'deposit_slip_no', 'deposit_date', 'clearance_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'voucher_plot_detail_id' => 'Voucher Plot Detail ID',
            'voucher_id' => 'Voucher ID',
            'plot_id' => 'Plot ID',
            'membership_id' => 'Membership ID',
            'serial_no' => 'Serial No',
            'amount' => 'Amount',
            'project_id' => 'Project',
            'receipt_no' => 'Receipt No',
            'narration' => 'Remarks',
            'application_id' => 'Form No.',
            'transaction_source' => 'Mode Of Receipt',
            'jv_no' => 'Voucher No.',
            'deposit_slip_no' => 'Deposit Slip No.',
            'target_bank_id' => 'Bank',
            'deposit_date' => 'Deposit Date',
            'clearance_date' => 'Clearance Date',
            'ms_no' => 'Membership No.',
        ];
    }

    public function getApplication() {
        return $this->hasOne(Propertyapplication::className(), ['application_id' => 'application_id']);
    }

    public function getTargetbank() {
        return $this->hasOne(Fmsbanks::className(), ['bank_id' => 'target_bank_id']);
    }

    public function getPlot() {
        return $this->hasOne(Plots::className(), ['id' => 'plot_id']);
    }

    public function getInstrument() {
        return $this->hasOne(Fmsvoucher::className(), ['voucher_id' => 'voucher_id']);
    }

    public function getMembership() {
        return $this->hasOne(Propertymemberships::className(), ['ms_id' => 'membership_id']);
    }

    public function getProject() {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }

    public function getCompletereceiptno() {
        if ($this->instrument->person->is_dealer) {
            return $this->jv_no;
        } else {
            return $this->serial_no . "/" . $this->instrument->voucher_sr_no;
        }
    }

    public static function updatemultiplerecords(&$receipts, &$installpayments, &$valid, $voucherid) {
        foreach ($receipts as $receipt) {
            $record = Fmsvoucherplotdetail::find()->where(['voucher_plot_detail_id' => $receipt->voucher_plot_detail_id])->one();

            if (intval($receipt->is_selected) != 0 && $valid) {
                if ($record == NULL) {
                    $record = new Fmsvoucherplotdetail();
                    $record->voucher_id = $voucherid;
                    $record->application_id = $receipt->application_id;
                    $record->plot_id = $receipt->plot_id;
                    $record->membership_id = $receipt->membership_id;
                    $record->transaction_source = $receipt->transaction_source;
                }

                $record->receipt_no = $receipt->receipt_no;
                $record->jv_no = $receipt->jv_no;
                $record->deposit_slip_no = $receipt->deposit_slip_no;
                $record->narration = $receipt->narration;

                if (!$record->save()) {
                    $valid = FALSE;
                    \app\models\Model::showerrors($record->errors, "Fmsvoucherplotdetail", "updatemultiplerecords");
                }

                if ($valid) {
                    if ($receipt->transaction_source == 1) {
                        $valid = Propertyapplication::updateReceiptstatus($receipt->application_id, 1) && $valid;
                    }
                }

                if ($valid) {
                    $amount = 0;
                    $valid = Installpayment::paymultipleinstallments($installpayments, $valid, $amount, $record->plot_id, $record->voucher_plot_detail_id) & $valid;

                    if ($valid) {
                        $record->amount = $amount;
                        $valid = $record->save(FALSE) & $valid;
                    }
                }
            } else {
                if ($record != NULL) {
                    Installpayment::resetmultipleinstallments($installpayments, $valid, $amount, $record->plot_id, $record->voucher_plot_detail_id);

                    if ($receipt->transaction_source == 1) {
                        $valid = Propertyapplication::updateReceiptstatus($receipt->application_id, 0);
                    }

                    $record->delete();
                }
            }
        }
        return $valid;
    }

    public static function updatemultipledepositslips(&$receipts) {
        foreach ($receipts as $receipt) {
            $record = Fmsvoucherplotdetail::find()->where(['voucher_plot_detail_id' => $receipt->voucher_plot_detail_id])->one();

            $record->deposit_slip_no = $receipt->deposit_slip_no;
            $record->target_bank_id = $receipt->target_bank_id;
            $record->deposit_date = \Yii::$app->formatter->asDate($receipt->deposit_date, 'php:Y-m-d');
            $record->clearance_date = \Yii::$app->formatter->asDate($receipt->clearance_date, 'php:Y-m-d');

            if (!$record->save()) {
                \app\models\Model::showerrors($record->errors, "Fmsvoucherplotdetail", "updatemultiplerecords");
                return false;
            }
        }
        return true;
    }

    public static function updatemultiplereceipts(&$receipts, &$valid, $voucherid) {
        foreach ($receipts as $receipt) {
            //if ($receipt->voucher_plot_detail_id != 0) {
                $record = Fmsvoucherplotdetail::find()->where(['voucher_plot_detail_id' => $receipt->voucher_plot_detail_id])->one();

                if (intval($receipt->is_selected) != 0 && $valid) {
                    if ($record == NULL) {
                        $record = new Fmsvoucherplotdetail();
                        $record->voucher_id = $voucherid;
                        $record->application_id = $receipt->application_id;
                        $record->plot_id = $receipt->plot_id;
                        $record->membership_id = $receipt->membership_id;
                        $record->transaction_source = $receipt->transaction_source;
                    }

                    $record->receipt_no = $receipt->receipt_no;
                    $record->jv_no = $receipt->jv_no;
                    $record->deposit_slip_no = $receipt->deposit_slip_no;
                    $record->narration = $receipt->narration;

                    if (!$record->save()) {
                        $valid = FALSE;
                        \app\models\Model::showerrors($record->errors, "Fmsvoucherplotdetail", "updatemultiplerecords");
                    }
                } else {
                    if ($record != NULL) {
                        Installpayment::resetinstallmentsofreceipt($valid, $record->voucher_plot_detail_id);

//                    if ($receipt->transaction_source == 1) {
//                        $valid = Propertyapplication::updateReceiptstatus($receipt->application_id,0);
//                    }

                        $record->delete();
                    }
                }
            //}
        }
        return $valid;
    }

}
