<?php

namespace app\models\application\custom;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CustomSearch extends Model {

    private $_idx;
    private $_formno;
    private $_msno;
    private $_cnic;
	
    public function getIdx() {
        return $this->_idx;
    }
	
    public function getCnic() {
        return $this->_cnic;
    }

    public function getMsno() {
        return $this->_msno;
    }

    public function getFormno() {
        return $this->_formno;
    }

    public function setIdx($value) {
        $this->_idx = $value;
    }

    public function setCnic($value) {
        $this->_cnic = $value;
    }
    public function setMsno($value) {
        $this->_msno = $value;
    }


    public function setFormno($value) {
        $this->_formno = $value;
    }

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
//            [['status', 'remarks'], 'required'],
            [['msno','formno','cnic'], 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'msno' => 'Ms. No.',
            'formno' => 'Form No.',
            'cnic' => 'CNIC.',
        ];
    }

}
