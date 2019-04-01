<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Propertymemberships;

/**
 * PropertymembershipsSearch represents the model behind the search form about `app\models\application\Propertymemberships`.
 */
class PropertymembershipsSearch extends Propertymemberships {

    /**
     * @inheritdoc
     */
//    public $dealer_id;
    private $_dealer_id;
    private $_form_no;
    private $_date_criteria_type;
    private $_from_date;
    private $_to_date;
    private $_date_month;
    private $_date_year;
    private $_submission_criteria_type;
    private $_submission_from_date;
    private $_submission_to_date;
    private $_submission_month;
    private $_submission_year;
    private $_verification_criteria_type;
    private $_verification_from_date;
    private $_verification_to_date;
    private $_verification_month;
    private $_verification_year;
    private $_approval_criteria_type;
    private $_approval_from_date;
    private $_approval_to_date;
    private $_approval_month;
    private $_approval_year;
    private $_activation_status;

    public function getDealer_id() {
        return $this->_dealer_id;
    }

    public function setDealer_id($value) {
        $this->_dealer_id = $value;
    }

    public function getForm_no() {
        return $this->_form_no;
    }

    public function setForm_no($value) {
        $this->_form_no = $value;
    }

    //date criteria
    public function getFrom_date() {
        return $this->_from_date;
    }

    public function setFrom_date($value) {
        $this->_from_date = $value;
    }

    public function getTo_date() {
        return $this->_to_date;
    }

    public function setTo_date($value) {
        $this->_to_date = $value;
    }

    public function getDate_criteria_type() {
        return $this->_date_criteria_type;
    }

    public function setDate_criteria_type($value) {
        $this->_date_criteria_type = $value;
    }

    public function getDate_month() {
        return $this->_date_month;
    }

    public function setDate_month($value) {
        $this->_date_month = $value;
    }

    public function getDate_year() {
        return $this->_date_year;
    }

    public function setDate_year($value) {
        $this->_date_year = $value;
    }

    //submission date
    public function getSubmission_from_date() {
        return $this->_submission_from_date;
    }

    public function setSubmission_from_date($value) {
        $this->_submission_from_date = $value;
    }

    public function getSubmission_to_date() {
        return $this->_submission_to_date;
    }

    public function setSubmission_to_date($value) {
        $this->_submission_to_date = $value;
    }

    public function getSubmission_criteria_type() {
        return $this->_submission_criteria_type;
    }

    public function setSubmission_criteria_type($value) {
        $this->_submission_criteria_type = $value;
    }

    public function getSubmission_month() {
        return $this->_submission_month;
    }

    public function setSubmission_month($value) {
        $this->_submission_month = $value;
    }

    public function getSubmission_year() {
        return $this->_submission_year;
    }

    public function setSubmission_year($value) {
        $this->_submission_year = $value;
    }

    //verification date
    public function getVerification_from_date() {
        return $this->_verification_from_date;
    }

    public function setVerification_from_date($value) {
        $this->_verification_from_date = $value;
    }

    public function getVerification_to_date() {
        return $this->_verification_to_date;
    }

    public function setVerification_to_date($value) {
        $this->_verification_to_date = $value;
    }

    public function getVerification_criteria_type() {
        return $this->_verification_criteria_type;
    }

    public function setVerification_criteria_type($value) {
        $this->_verification_criteria_type = $value;
    }

    public function getVerification_month() {
        return $this->_verification_month;
    }

    public function setVerification_month($value) {
        $this->_verification_month = $value;
    }

    public function getVerification_year() {
        return $this->_verification_year;
    }

    public function setVerification_year($value) {
        $this->_verification_year = $value;
    }

    //Approval date
    public function getApproval_from_date() {
        return $this->_approval_from_date;
    }

    public function setApproval_from_date($value) {
        $this->_approval_from_date = $value;
    }

    public function getApproval_to_date() {
        return $this->_approval_to_date;
    }

    public function setApproval_to_date($value) {
        $this->_approval_to_date = $value;
    }

    public function getApproval_criteria_type() {
        return $this->_approval_criteria_type;
    }

    public function setApproval_criteria_type($value) {
        $this->_approval_criteria_type = $value;
    }

    public function getApproval_month() {
        return $this->_approval_month;
    }

    public function setApproval_month($value) {
        $this->_approval_month = $value;
    }

    public function getApproval_year() {
        return $this->_approval_year;
    }

    public function setApproval_year($value) {
        $this->_approval_year = $value;
    }

    public function getActivation_status() {
        return $this->_activation_status;
    }

    public function setActivation_status($value) {
        $this->_activation_status = $value;
    }

    public function rules() {
        return [
            [['ms_id', 'plot_id', 'member_id', 'ms_status', 'is_joint', 'parent_ms_id', 'user_id', 'is_active', 'activation_status'], 'integer'],
            [['ms_no', 'created_on', 'modified_on', 'dealer_id', 'form_no'], 'safe'],
            [['from_date', 'to_date', 'date_criteria_type', 'date_month', 'date_year'], 'safe'],
            [['submission_from_date', 'submission_to_date', 'submission_criteria_type', 'submission_month', 'submission_year'], 'safe'],
            [['verification_from_date', 'verification_to_date', 'verification_criteria_type', 'verification_month', 'verification_year'], 'safe'],
            [['approval_from_date', 'approval_to_date', 'approval_criteria_type', 'approval_month', 'approval_year'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Propertymemberships::find()->joinWith('plot')->joinWith('plot.application')->joinWith('plot.application.dealer');
        //$query = Secmoduleactions::find()->joinWith(['controller'])->joinWith('controller.module');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
            //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
            //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);

//        $dataProvider->setSort([
//            'attributes' => [
//                'plot_id' => [
//                    'asc' => ['plot_id' => SORT_ASC, 'plot_id' => SORT_ASC],
//                    'desc' => ['plot_id' => SORT_DESC, 'plot_id' => SORT_DESC],
//                    'label' => 'File/Plot',
//                    'default' => SORT_ASC
//                ],  
//                'member_id' => [
//                    'asc' => ['member_id' => SORT_ASC, 'member_id' => SORT_ASC],
//                    'desc' => ['member_id' => SORT_DESC, 'member_id' => SORT_DESC],
//                    'label' => 'Member',
//                    'default' => SORT_ASC
//                ],                
//                'ms_no' => [
//                    'asc' => ['ms_no' => SORT_ASC, 'ms_no' => SORT_ASC],
//                    'desc' => ['ms_no' => SORT_DESC, 'ms_no' => SORT_DESC],
//                    'label' => 'Ms. No.',
//                    'default' => SORT_ASC
//                ],                
//                'ms_status' => [
//                    'asc' => ['ms_status' => SORT_ASC, 'ms_status' => SORT_ASC],
//                    'desc' => ['ms_status' => SORT_DESC, 'ms_status' => SORT_DESC],
//                    'label' => 'Status',
//                    'default' => SORT_ASC
//                ],                
//                'is_joint' => [
//                    'asc' => ['is_joint' => SORT_ASC, 'is_joint' => SORT_ASC],
//                    'desc' => ['is_joint' => SORT_DESC, 'is_joint' => SORT_DESC],
//                    'label' => 'Joint Membership',
//                    'default' => SORT_ASC
//                ],                
//                'dealer_name' => [
//                    'asc' => ['dealer_name' => SORT_ASC, 'dealer_name' => SORT_ASC],
//                    'desc' => ['dealer_name' => SORT_DESC, 'dealer_name' => SORT_DESC],
//                    'label' => 'Dealer',
//                    'default' => SORT_ASC
//                ],                
//            ],
//        'defaultOrder' => ['ms_no' => SORT_ASC]
//        ]);        

        $query->andWhere('ifnull(parent_ms_id,0) = 0');
//        $query->andFilterWhere([
//            'parent_ms_id' => 0,
//            ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ms_id' => $this->ms_id,
            'plot_id' => $this->plot_id,
            'member_id' => $this->member_id,
            'ms_status' => $this->ms_status,
            'created_on' => $this->created_on,
            'modified_on' => $this->modified_on,
            'is_joint' => $this->is_joint,
            'parent_ms_id' => $this->parent_ms_id,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'ms_no', $this->ms_no]);

        if ($this->dealer_id != NULL && $this->dealer_id != 0) {
            $query->andFilterWhere([
                'members.id' => $this->dealer_id,
            ]);
        }

        if ($this->form_no != NULL && $this->form_no != "") {
            $query->andFilterWhere([
                'property_application.application_no' => $this->form_no,
            ]);
        }

        return $dataProvider;
    }

    public function searchtransfers($params) {
        $query = Propertymemberships::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
            //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
            //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);

        $query->andWhere('ifnull(parent_ms_id,0) > 0');
        //$query->andFilterWhere(['!=', 'parent_ms_id', 0]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ms_id' => $this->ms_id,
            'plot_id' => $this->plot_id,
            'member_id' => $this->member_id,
            'ms_status' => $this->ms_status,
            'created_on' => $this->created_on,
            'modified_on' => $this->modified_on,
            'is_joint' => $this->is_joint,
            'parent_ms_id' => $this->parent_ms_id,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'ms_no', $this->ms_no]);

        return $dataProvider;
    }

    public function searchmemberships($params) {
        $query = Propertymemberships::find()->innerJoinWith("currentmembership")->innerJoinWith("currentmembership.application");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
            //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
            //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);

//        $query->andWhere('ifnull(parent_ms_id,0) > 0');
        //$query->andFilterWhere(['!=', 'parent_ms_id', 0]);
        $query->andFilterWhere(['in', 'property_application.application_status', [1, 10]]);

        $this->load($params);

        if ($this->ms_status == NULL || $this->ms_status == "") {
            if ($this->form_no != NULL || $this->ms_no != NULL || $this->ms_status != null || $this->dealer_id != NULL) {
                
            } else {
                $query->andFilterWhere([
                    'ms_status' => 1,
                ]);
            }
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ms_id' => $this->ms_id,
            'plot_id' => $this->plot_id,
            'member_id' => $this->member_id,
            'ms_status' => $this->ms_status,
            'created_on' => $this->created_on,
            'modified_on' => $this->modified_on,
            'is_joint' => $this->is_joint,
            'parent_ms_id' => $this->parent_ms_id,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'ms_no', $this->ms_no]);

        if ($this->dealer_id != NULL && $this->dealer_id != 0) {
            $query->andFilterWhere([
                'property_application.dealer_id' => $this->dealer_id,
            ]);
        }

        if ($this->form_no != NULL && $this->form_no != "") {
            $query->andFilterWhere([
                'property_application.application_no' => $this->form_no,
            ]);
        }

        return $dataProvider;
    }

    public function searchfinanceverification($params) {
        $query = Propertymemberships::find()->joinWith('plot')->joinWith('plot.application')->joinWith('plot.application.dealer');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
            //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
            //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);

//        $query->andWhere('ifnull(parent_ms_id,0) > 0');
        $query->andFilterWhere(['=', 'ms_status', 2]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ms_id' => $this->ms_id,
            'plot_id' => $this->plot_id,
            'member_id' => $this->member_id,
            'ms_status' => $this->ms_status,
            'created_on' => $this->created_on,
            'modified_on' => $this->modified_on,
            'is_joint' => $this->is_joint,
            'parent_ms_id' => $this->parent_ms_id,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'ms_no', $this->ms_no]);

        if ($this->dealer_id != NULL && $this->dealer_id != 0) {
            $query->andFilterWhere([
                'members.id' => $this->dealer_id,
            ]);
        }

        if ($this->form_no != NULL && $this->form_no != "") {
            $query->andFilterWhere([
                'property_application.application_no' => $this->form_no,
            ]);
        }

        return $dataProvider;
    }

    public function searchapproval($params) {
        $query = Propertymemberships::find()->joinWith('plot')->joinWith('plot.application')->joinWith('plot.application.dealer');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
            //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
            //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);

//        $query->andWhere('ifnull(parent_ms_id,0) > 0');
        $query->andFilterWhere(['=', 'ms_status', 3]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ms_id' => $this->ms_id,
            'plot_id' => $this->plot_id,
            'member_id' => $this->member_id,
            'ms_status' => $this->ms_status,
            'created_on' => $this->created_on,
            'modified_on' => $this->modified_on,
            'is_joint' => $this->is_joint,
            'parent_ms_id' => $this->parent_ms_id,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'ms_no', $this->ms_no]);

        if ($this->dealer_id != NULL && $this->dealer_id != 0) {
            $query->andFilterWhere([
                'members.id' => $this->dealer_id,
            ]);
        }

        if ($this->form_no != NULL && $this->form_no != "") {
            $query->andFilterWhere([
                'property_application.application_no' => $this->form_no,
            ]);
        }

        return $dataProvider;
    }

    public function loadparams($params) {
        $this->load($params);
    }


    public function searchcancelreq($params,$defaultstatus) {
        $query = Propertymemberships::find()->innerJoinWith("currentmembership")->innerJoinWith("currentmembership.application");//->innerJoinWith("plot");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
            //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
            //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);

//        $query->andWhere('ifnull(parent_ms_id,0) > 0');
        //$query->andFilterWhere(['!=', 'parent_ms_id', 0]);
        //$query->andFilterWhere(['in', 'property_application.application_status', [1, 10]]);

        $this->load($params);
        
        if($this->activation_status == NULL || $this->activation_status ==0){
            $query->andFilterWhere(['in', 'plots.activation_status', [$defaultstatus]]);
        } else if($this->activation_status == 111){
            $query->andFilterWhere(['in', 'plots.activation_status', [11,12,13,14,15,16]]);
        } else {
            $query->andFilterWhere(['in', 'plots.activation_status', [$this->activation_status]]);
        }
        

//        if ($this->ms_status == NULL || $this->ms_status == "") {
//            if ($this->form_no != NULL || $this->ms_no != NULL || $this->ms_status != null || $this->dealer_id != NULL) {
//                
//            } else {
//                $query->andFilterWhere([
//                    'ms_status' => 1,
//                ]);
//            }
//        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ms_id' => $this->ms_id,
            'plot_id' => $this->plot_id,
            'member_id' => $this->member_id,
            'ms_status' => $this->ms_status,
            'created_on' => $this->created_on,
            'modified_on' => $this->modified_on,
            'is_joint' => $this->is_joint,
            'parent_ms_id' => $this->parent_ms_id,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'ms_no', $this->ms_no]);

        if ($this->dealer_id != NULL && $this->dealer_id != 0) {
            $query->andFilterWhere([
                'property_application.dealer_id' => $this->dealer_id,
            ]);
        }

        if ($this->form_no != NULL && $this->form_no != "") {
            $query->andFilterWhere([
                'property_application.application_no' => $this->form_no,
            ]);
        }

        return $dataProvider;
    }

    public function searchconversionreq($params,$defaultstatus) {
        $query = Propertymemberships::find()->innerJoinWith("currentmembership")->innerJoinWith("currentmembership.application");//->innerJoinWith("plot");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
            //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
            //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);

//        $query->andWhere('ifnull(parent_ms_id,0) > 0');
        //$query->andFilterWhere(['!=', 'parent_ms_id', 0]);
        //$query->andFilterWhere(['in', 'property_application.application_status', [1, 10]]);

        $this->load($params);
        
        if($this->activation_status == NULL || $this->activation_status ==0){
            $query->andFilterWhere(['in', 'plots.activation_status', [$defaultstatus]]);
        } else if($this->activation_status == 311){
            $query->andFilterWhere(['in', 'plots.activation_status', [31,32,33,34,35,36]]);
        } else {
            $query->andFilterWhere(['in', 'plots.activation_status', [$this->activation_status]]);
        }
        

//        if ($this->ms_status == NULL || $this->ms_status == "") {
//            if ($this->form_no != NULL || $this->ms_no != NULL || $this->ms_status != null || $this->dealer_id != NULL) {
//                
//            } else {
//                $query->andFilterWhere([
//                    'ms_status' => 1,
//                ]);
//            }
//        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ms_id' => $this->ms_id,
            'plot_id' => $this->plot_id,
            'member_id' => $this->member_id,
            'ms_status' => $this->ms_status,
            'created_on' => $this->created_on,
            'modified_on' => $this->modified_on,
            'is_joint' => $this->is_joint,
            'parent_ms_id' => $this->parent_ms_id,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'ms_no', $this->ms_no]);

        if ($this->dealer_id != NULL && $this->dealer_id != 0) {
            $query->andFilterWhere([
                'property_application.dealer_id' => $this->dealer_id,
            ]);
        }

        if ($this->form_no != NULL && $this->form_no != "") {
            $query->andFilterWhere([
                'property_application.application_no' => $this->form_no,
            ]);
        }

        return $dataProvider;
    }
    

    public function searchmergereq($params,$defaultstatus) {
        $query = Propertymemberships::find()->innerJoinWith("currentmembership")->innerJoinWith("currentmembership.application");//->innerJoinWith("plot");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
            //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
            //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);

//        $query->andWhere('ifnull(parent_ms_id,0) > 0');
        //$query->andFilterWhere(['!=', 'parent_ms_id', 0]);
        //$query->andFilterWhere(['in', 'property_application.application_status', [1, 10]]);

        $this->load($params);
        
        if($this->activation_status == NULL || $this->activation_status ==0){
            $query->andFilterWhere(['in', 'plots.activation_status', [$defaultstatus]]);
        } else if($this->activation_status == 211){
            $query->andFilterWhere(['in', 'plots.activation_status', [21,22,23,24,25,26]]);
        } else {
            $query->andFilterWhere(['in', 'plots.activation_status', [$this->activation_status]]);
        }
        

//        if ($this->ms_status == NULL || $this->ms_status == "") {
//            if ($this->form_no != NULL || $this->ms_no != NULL || $this->ms_status != null || $this->dealer_id != NULL) {
//                
//            } else {
//                $query->andFilterWhere([
//                    'ms_status' => 1,
//                ]);
//            }
//        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ms_id' => $this->ms_id,
            'plot_id' => $this->plot_id,
            'member_id' => $this->member_id,
            'ms_status' => $this->ms_status,
            'created_on' => $this->created_on,
            'modified_on' => $this->modified_on,
            'is_joint' => $this->is_joint,
            'parent_ms_id' => $this->parent_ms_id,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'ms_no', $this->ms_no]);

        if ($this->dealer_id != NULL && $this->dealer_id != 0) {
            $query->andFilterWhere([
                'property_application.dealer_id' => $this->dealer_id,
            ]);
        }

        if ($this->form_no != NULL && $this->form_no != "") {
            $query->andFilterWhere([
                'property_application.application_no' => $this->form_no,
            ]);
        }

        return $dataProvider;
    }
}
