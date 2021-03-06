<?php

namespace app\modules\marketting\visitors\reports\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Overall extends Model {

    private $_project_id;
    private $_project_name;
    private $_center_id;
    private $_center_name;
    private $_size_id;
    private $_size_title;
    private $_user_id;
    private $_user_name;
    
    private $_no_of_visits;
    private $_no_of_bookings;
    private $_no_of_interests;
    private $_no_of_calls;
    private $_followup_status;

//////////////GETTER///////////////
    public function getProject_id() {
        return $this->_project_id;
    }

    public function getProject_name() {
        return $this->_project_name;
    }

    public function getCenter_id() {
        return $this->_center_id;
    }

    public function getCenter_name() {
        return $this->_center_name;
    }

    public function getSizeid() {
        return $this->_size_id;
    }

    public function getSizetitle() {
        return $this->_size_title;
    }

    public function getNo_of_visits() {
        return $this->_no_of_visits;
    }

    public function getNo_of_calls() {
        return $this->_no_of_calls;
    }

    public function getNo_of_interests() {
        return $this->_no_of_interests;
    }

    public function getNo_of_bookings() {
        return $this->_no_of_bookings;
    }

    public function getUserid() {
        return $this->_user_id;
    }

    public function getUsername() {
        return $this->_user_name;
    }

    public function getFollowupstatus() {
        return $this->_followup_status;
    }

    ////////////////SETTER///////////////
    public function setProject_id($value) {
        $this->_project_id = $value;
    }

    public function setProject_name($value) {
        $this->_project_name = $value;
    }

    public function setCenter_id($value) {
        $this->_center_id = $value;
    }

    public function setCenter_name($value) {
        $this->_center_name = $value;
    }

    public function setSizeid($value) {
        $this->_size_id = $value;
    }

    public function setSizetitle($value) {
        $this->_size_title = $value;
    }

    public function setNo_of_visits($value) {
        $this->_no_of_visits = $value;
    }

    public function setNo_of_calls($value) {
        $this->_no_of_calls = $value;
    }

    public function setNo_of_interests($value) {
        $this->_no_of_interests = $value;
    }

    public function setNo_of_bookings($value) {
        $this->_no_of_bookings = $value;
    }

    public function setUserid($value) {
        $this->_user_id = $value;
    }

    public function setUsername($value) {
        $this->_user_name = $value;
    }

    public function setFollowupstatus($value) {
        $this->_followup_status = $value;
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
    public function attributeLabels() {
        return [
            'status' => 'Followup Status',
            'remarks' => 'Followup Remarks',
        ];
    }

}
