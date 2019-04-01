<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "installment_plan_detail".
 *
 * @property integer $detail_id
 * @property integer $plan_id
 * @property string $installment_title
 * @property double $installment_amount
 * @property integer $gap
 * @property integer $gap_type
 */
class Installmentplandetail extends \yii\db\ActiveRecord {

    private $_remove_record;

    public function getRemove_record() {
        return $this->_remove_record;
    }

    public function setRemove_record($value) {
        $this->_remove_record = $value;
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'installment_plan_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['plan_id', 'installment_title', 'installment_amount', 'gap', 'gap_type'], 'required'],
            [['plan_id', 'gap', 'gap_type', 'detail_id'], 'integer'],
            [['installment_amount'], 'number'],
            [['remove_record'], 'safe'],
            [['installment_title'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'detail_id' => 'Detail ID',
            'plan_id' => 'Plan ID',
            'installment_title' => 'Installment Title',
            'installment_amount' => 'Installment Amount',
            'gap' => 'Gap',
            'gap_type' => 'Gap Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstallmentPlan() {
        return $this->hasOne(Installmentplanmaster::className(), ['plan_id' => 'plan_id']);
    }

    public static function generatenewrow($planid, $rowno) {
        $modelinstallmentdetail = new \app\models\application\Installmentplandetail();

        $modelinstallmentdetail->plan_id = $planid;
        $modelinstallmentdetail->gap = 30;
        $modelinstallmentdetail->gap_type = 1;
        $modelinstallmentdetail->installment_amount = 0;

        $modelinstallmentdetail->installment_title = ($rowno == 0 ? "Booking" : ($rowno == 1 ? "Confirmation after 30 days" : "Installment No. " . ($rowno + 1)));

        if ($modelinstallmentdetail->save()) {
            return TRUE;
        }

        if (Yii::$app->user->identity->rawerrors == 1) {
            echo "<h3>" . $this->className() . " Model: generatenewrow</h3>";
            print_r($this->errors);
        }

        return FALSE;
    }

    public static function updateList(&$prevdata, &$newdata, &$count, &$valid, $parentid) {
        foreach ($newdata as $rec) {
            if ($rec->detail_id == 0) {
                if ($rec->installment_amount != 0) {
                    $newrec = new Installmentplandetail();

                    $newrec->detail_id = 0;
                    $newrec->plan_id = $parentid; //$model->plan_id;
                    $newrec->installment_title = $rec->installment_title;
                    $newrec->installment_amount = $rec->installment_amount;
                    $newrec->gap = $rec->gap;
                    $newrec->gap_type = $rec->gap_type;

                    $prevdata[] = $newrec;
                }
            }
        }

        $valid = \app\models\Model::validateMultiple($prevdata) && $valid;
        foreach ($prevdata as $rec) {
            if ($rec->installment_amount != 0) {
                //$rec->addError('installment_amount', 'Amount is missing.');
                //$valid = false;
                if ($rec->gap == 0) {
                    $rec->addError('gap', 'Value is missing.');
                    $valid = false;
                }

                $count++;
                $valid = $rec->save(FALSE) && $valid;
            } else {
                if ($rec->detail_id != 0) {
                    $rec->delete();
                }
            }
        }
    }

}
