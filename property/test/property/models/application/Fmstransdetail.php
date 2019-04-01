<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "fms_trans_detail".
 *
 * @property integer $detail_id
 * @property integer $trans_id
 * @property integer $acc_id
 * @property double $dr_amount
 * @property double $cr_amount
 * @property string $remarks
 */
class Fmstransdetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fms_trans_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //, 'dr_amount', 'cr_amount', 'remarks'
            [['trans_id', 'acc_id'], 'required'],
            [['trans_id', 'acc_id'], 'integer'],
            [['dr_amount', 'cr_amount'], 'number'],
            [['remarks'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'detail_id' => 'Detail ID',
            'trans_id' => 'Trans ID',
            'acc_id' => 'Acc ID',
            'dr_amount' => 'Dr Amount',
            'cr_amount' => 'Cr Amount',
            'remarks' => 'Remarks',
        ];
    }
    
    public function getTransaction()
    {
        return $this->hasOne(Fmstransmaster::className(), ['trans_id' => 'trans_id']);
    }
    
    public function getAccount()
    {
        return $this->hasOne(Fmsaccounts::className(), ['acc_id' => 'acc_id']);
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
}
