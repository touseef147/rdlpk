<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "fms_trans_detail_dist".
 *
 * @property string $distribution_id
 * @property integer $trans_id
 * @property string $distributed_to_type
 * @property integer $distributed_to_id
 * @property double $dr_amount
 * @property double $cr_amount
 * @property string $remarks
 */
class fmstransdetaildist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fms_trans_detail_dist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //, 'distributed_to_type', 'distributed_to_id', 'remarks'
            [['trans_id'], 'required'],
            [['trans_id', 'distributed_to_id', 'bank_id', 'against'], 'integer'],
            [['dr_amount', 'cr_amount'], 'number'],
            [['bank_trans_date', 'bank_trans_no'], 'safe'],
            [['distributed_to_type'], 'string', 'max' => 200],
            [['remarks'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'distribution_id' => 'Distribution ID',
            'trans_id' => 'Trans ID',
            'distributed_to_type' => 'Distributed To Type',
            'distributed_to_id' => 'Distributed To ID',
            'dr_amount' => 'Debit.',
            'cr_amount' => 'Credit.',
            'remarks' => 'Remarks',
            'bank_id' => 'Bank',
            'bank_trans_date' => 'Cheque Date',
            'bank_trans_no' => 'Cheque No.',
            'against' => 'Against',
        ];
    }

    public function getViewcramount() {
        return number_format($this->cr_amount);
    }
    
    public function getPerson()
    {
        return $this->hasOne(Members::className(), ['id' => 'distributed_to_id']);
    }
    
    public function getTransaction()
    {
        return $this->hasOne(Fmstransmaster::className(), ['trans_id' => 'trans_id']);
    }
    
    public function getBank()
    {
        return $this->hasOne(Fmsbanks::className(), ['bank_id' => 'bank_id']);
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
