<?php

namespace app\models\application\custom;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class VisitorsFollowup extends Model {

    private $_status;
    private $_remarks;
    private $_next_visit;
	
    public function getNext_visit() {
        return $this->_next_visit;
    }

    public function getStatus() {
        return $this->_status;
    }

    public function getRemarks() {
        return $this->_remarks;
    }

    public function setNext_visit($value) {
        $this->_next_visit = $value;
    }
    public function setStatus($value) {
        $this->_status = $value;
    }


    public function setRemarks($value) {
        $this->_remarks = $value;
    }

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['status', 'remarks'], 'required'],
            [['remarks'], 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'status' => 'Followup Status',
            'remarks' => 'Followup Remarks',
        ];
    }

    public function statuses()
    {
        $model[] = new \app\models\Keyvalue();

        $model[0]->id = 0;
        $model[0]->value = "Pending";
        $model[0]->total = 0;
        
        $model[] = new \app\models\Keyvalue();

        $model[1]->id = 1;
        $model[1]->value = "Done";
        $model[1]->total = 0;
        
        $model[] = new \app\models\Keyvalue();

        $model[2]->id = 2;
        $model[2]->value = "Cancelled";
        $model[2]->total = 0;
        
        $model[] = new \app\models\Keyvalue();

        $model[3]->id = 3;
        $model[3]->value = "Next Visit";
        $model[3]->total = 0;
        
        return $model;
    }

}
