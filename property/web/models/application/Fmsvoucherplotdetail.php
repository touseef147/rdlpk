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
 */
class Fmsvoucherplotdetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fms_voucher_plot_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['voucher_id', 'member_id', 'plot_id', 'membership_id', 'serial_no', 'amount', 'project_id'], 'required'],
            [['voucher_plot_detail_id', 'voucher_id', 'plot_id', 'membership_id', 'serial_no', 'project_id', 'transaction_source', 'application_id'], 'integer'],
            [['amount'], 'number'],
            [['receipt_no', 'narration'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
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
        ];
    }

    public function getApplication() {
        return $this->hasOne(Propertyapplication::className(), ['application_id' => 'application_id']);
    }

    public function getPlot() {
        return $this->hasOne(Plots::className(), ['id' => 'plot_id']);
    }

    public function getInstrument() {
        return $this->hasOne(Fmsvoucher::className(), ['voucher_id' => 'voucher_id']);
    }

    public function getMembership() {
        return $this->hasOne(Propertymemberships::className(), ['membership_id' => 'membership_id']);
    }

    public function getProject() {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }
    
    public static function updatemultiplerecords(&$receipts,&$installpayments, &$valid, $voucherid){
        foreach ($receipts as $receipt) {
            $record = Fmsvoucherplotdetail::find()->where(['voucher_plot_detail_id' => $receipt->voucher_plot_detail_id])->one();

            if ($record == NULL) {
                $record = new Fmsvoucherplotdetail();
                $record->voucher_id = $voucherid;
                $record->application_id = $receipt->application_id;
                $record->plot_id = $receipt->plot_id;
            }

            $record->receipt_no = $receipt->receipt_no;
            $record->narration = $receipt->narration;

            if (!$record->save()) {
                $valid = FALSE;
                \app\models\Model::showerrors($record->errors, "Fmsvoucherplotdetail", "updatemultiplerecords");
            }

            if ($receipt->transaction_source == 1) {
                $valid = Propertyapplication::updateReceiptstatus($receipt->application_id);
            }

            if ($valid) {
                Installpayment::paymultipleinstallments($installpayments, $valid, $record->plot_id, $record->voucher_plot_detail_id);
            }
        }
    }
}
