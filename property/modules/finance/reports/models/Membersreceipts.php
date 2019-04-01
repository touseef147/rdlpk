<?php

namespace app\modules\finance\reports\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Membersreceipts extends Model {

    private $_project_id;
    private $_project_name;
    private $membership_id;
    private $membership_no;
    private $_member_id;
    private $_member_name;
    private $_size2;
    private $_size;
    private $_user_id;
    private $_user_name;
    private $_property_type;
    private $_charges_due;
    private $_charges_received;
    private $_installment_due;
    private $_installment_received;
    private $_uptodate;

//////////////GETTER///////////////
    public function getProject_id() {
        return $this->_project_id;
    }

    public function getProject_name() {
        return $this->_project_name;
    }

    public function getMember_id() {
        return $this->_member_id;
    }

    public function getMembership_id() {
        return $this->_membership_id;
    }

    public function getMembership_no() {
        return $this->_membership_no;
    }

    public function getSize2() {
        return $this->_size2;
    }

    public function getSize() {
        return $this->_size;
    }

    public function getMember_name() {
        return $this->_member_name;
    }

    public function getProperty_type() {
        return $this->_property_type;
    }

    public function getCharges_due() {
        return $this->_charges_due;
    }

    public function getCharges_received() {
        return $this->_charges_received;
    }
	public function getInstallment_due() {
        return $this->_installment_due;
    }

    public function getInstallment_received() {
        return $this->_installment_received;
    }

    public function getUptodate() {
        return $this->_uptodate;
    }
    public function getUserid() {
        return $this->_user_id;
    }

    public function getUsername() {
        return $this->_user_name;
    }

    ////////////////SETTER///////////////
    public function setProject_id($value) {
        $this->_project_id = $value;
    }

    public function setProject_name($value) {
        $this->_project_name = $value;
    }

    public function setMember_id($value) {
        $this->_member_id = $value;
    }

    public function setMember_name($value) {
        $this->_member_name = $value;
    }

    public function setMembership_id($value) {
        $this->_membership_id = $value;
    }

    public function seMembership_no($value) {
        $this->_membership_no = $value;
    }

    public function setSize($value) {
        $this->_size = $value;
    }

    public function setSize2($value) {
        $this->_size2 = $value;
    }

    public function setProperty_type($value) {
        $this->_property_type= $value;
    }

    public function setCharges_due($value) {
        $this->_charges_due = $value;
    }

    public function setCharges_received($value) {
        $this->_charges_received = $value;
    }

    public function setInstallment_due($value) {
        $this->_installment_due = $value;
    }
	public function setInstallment_received($value) {
        $this->_installment_received = $value;
    }
	public function setUptodate($value) {
        $this->_uptodate = $value;
    }

    public function setUserid($value) {
        $this->_user_id = $value;
    }

    public function setUsername($value) {
        $this->_user_name = $value;
    }

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            //[['status', 'remarks'], 'required'],
            [['project_name'], 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() {
        return [
            'Project_name' => 'Project',
        ];
    }

}
