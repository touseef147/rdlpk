<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Fmsvoucher;

/**
 * FmsvoucherSearch represents the model behind the search form about `app\modules\finance\models\Fmsvoucher`.
 */
class FmsvoucherSearch extends Fmsvoucher
{
    private $_fileno;
    private $_msno;
    private $_formno;
    
    private $_receiptno;
    private $_jvno;
    private $_depositslipno;
    private $_targetbankid;
    
    private $_date_criteria_type;
    private $_from_date;
    private $_to_date;
    private $_date_month;
    private $_date_year;
    
    private $_deposit_criteria_type;
    private $_deposit_from_date;
    private $_deposit_to_date;
    private $_deposit_month;
    private $_deposit_year;
    
    private $_clearance_criteria_type;
    private $_clearance_from_date;
    private $_clearance_to_date;
    private $_clearance_month;
    private $_clearance_year;

    public function getFormno() {
        return $this->_formno;
    }

    public function setFormno($value) {
        $this->_formno= $value;
    }

    public function getMsno() {
        return $this->_msno;
    }

    public function setMsno($value) {
        $this->_msno= $value;
    }

    public function getFileno() {
        return $this->_fileno;
    }

    public function setFileno($value) {
        $this->_fileno = $value;
    }

    public function getReceiptno() {
        return $this->_receiptno;
    }

    public function setReceiptno($value) {
        $this->_receiptno = $value;
    }

    public function getJvno() {
        return $this->_jvno;
    }

    public function setJvno($value) {
        $this->_jvno = $value;
    }

    public function getDepositslipno() {
        return $this->_depositslipno;
    }

    public function setDepositslipno($value) {
        $this->_depositslipno = $value;
    }

    public function getTargetbankid() {
        return $this->_targetbankid;
    }

    public function setTargetbankid($value) {
        $this->_targetbankid = $value;
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

    
    //deposit date
    public function getDeposit_from_date() {
        return $this->_deposit_from_date;
    }

    public function setDeposit_from_date($value) {
        $this->_deposit_from_date = $value;
    }

    public function getDeposit_to_date() {
        return $this->_deposit_to_date;
    }

    public function setDeposit_to_date($value) {
        $this->_deposit_to_date = $value;
    }

    public function getDeposit_criteria_type() {
        return $this->_deposit_criteria_type;
    }

    public function setDeposit_criteria_type($value) {
        $this->_deposit_criteria_type = $value;
    }

    public function getDeposit_month() {
        return $this->_deposit_month;
    }

    public function setDeposit_month($value) {
        $this->_deposit_month = $value;
    }

    public function getDeposit_year() {
        return $this->_deposit_year;
    }

    public function setDeposit_year($value) {
        $this->_deposit_year = $value;
    }

    
    //clearance date
    public function getClearance_from_date() {
        return $this->_clearance_from_date;
    }

    public function setClearance_from_date($value) {
        $this->_clearance_from_date = $value;
    }

    public function getClearance_to_date() {
        return $this->_clearance_to_date;
    }

    public function setClearance_to_date($value) {
        $this->_clearance_to_date = $value;
    }

    public function getClearance_criteria_type() {
        return $this->_clearance_criteria_type;
    }

    public function setClearance_criteria_type($value) {
        $this->_clearance_criteria_type = $value;
    }

    public function getClearance_month() {
        return $this->_clearance_month;
    }

    public function setClearance_month($value) {
        $this->_clearance_month = $value;
    }

    public function getClearance_year() {
        return $this->_clearance_year;
    }

    public function setClearance_year($value) {
        $this->_clearance_year = $value;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['voucher_id', 'bank_id', 'sales_center_id','entry_status','project_id', 'member_id'], 'integer'],
            [['entry_date', 'transaction_date', 'voucher_sr_no', 'folio_no','narration'], 'safe'],
            [['receiptno', 'jvno', 'depositslipno', 'targetbankid', 'formno', 'msno', 'fileno'], 'safe'],
            [['from_date', 'to_date', 'date_criteria_type', 'date_month', 'date_year'], 'safe'],
            [['deposit_from_date', 'deposit_to_date', 'deposit_criteria_type', 'deposit_month', 'deposit_year'], 'safe'],
            [['clearance_from_date', 'clearance_to_date', 'clearance_criteria_type', 'clearance_month', 'clearance_year'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Fmsvoucher::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if((($this->receiptno != NULL) || ($this->jvno != NULL && $this->jvno != "") || ($this->depositslipno != null && $this->depositslipno != "") || ($this->targetbankid != null && $this->targetbankid != "") || ($this->fileno != NULL && $this->fileno != "") || ($this->formno != NULL && $this->formno != "") || ($this->msno != NULL && $this->msno != ""))){
            $query = $query->joinWith("receipts");
        }

        if(($this->fileno != NULL && $this->fileno != "")){
            $query = $query->joinWith("receipts.plot");
        }

        if(($this->formno != NULL && $this->formno != "")){
            $query = $query->joinWith("receipts.application");
        }

        if(($this->msno != NULL && $this->msno != "")){
            $query = $query->joinWith("receipts.plot.memberships");
        }

        $query->andFilterWhere([
            'voucher_id' => $this->voucher_id,
            'bank_id' => $this->bank_id,
            'entry_date' => $this->entry_date,
            'transaction_date' => $this->transaction_date,
            'sales_center_id' => $this->sales_center_id,
            'project_id' => $this->project_id,
            'entry_status' => $this->entry_status,
        ]);

        $query->andFilterWhere(['like', 'voucher_sr_no', $this->voucher_sr_no])
            ->andFilterWhere(['like', 'folio_no', $this->folio_no])
            ->andFilterWhere(['like', 'narration', $this->narration]);
        
        $query->andFilterWhere(['like', 'fms_voucher_plot_detail.receipt_no', $this->receiptno]);
        $query->andFilterWhere(['like', 'fms_voucher_plot_detail.jv_no', $this->jvno]);
        $query->andFilterWhere(['like', 'fms_voucher_plot_detail.deposit_slip_no', $this->depositslipno]);

        $query->andFilterWhere(['like', 'plots.plot_detail_address', $this->fileno]);
        $query->andFilterWhere(['like', 'property_application.application_no', $this->formno]);
        $query->andFilterWhere(['like', 'property_memberships.ms_no', $this->msno]);

        return $dataProvider;
    }
    
    public function searchmembers($params)
    {
        $query = Fmsvoucher::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        
        $query->andFilterWhere(['!=',
            'amount_type', 5
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if((($this->receiptno != NULL) || ($this->jvno != NULL && $this->jvno != "") || ($this->depositslipno != null && $this->depositslipno != "") || ($this->targetbankid != null && $this->targetbankid != ""))){
            $query = $query->joinWith("receipts");
        }

        
        $query->andFilterWhere([
            'voucher_id' => $this->voucher_id,
            'bank_id' => $this->bank_id,
            'entry_date' => $this->entry_date,
            'transaction_date' => $this->transaction_date,
            'sales_center_id' => $this->sales_center_id,
            'project_id' => $this->project_id,
            'entry_status' => $this->entry_status,
        ]);

        $query->andFilterWhere(['like', 'voucher_sr_no', $this->voucher_sr_no])
            ->andFilterWhere(['like', 'folio_no', $this->folio_no])
            ->andFilterWhere(['like', 'narration', $this->narration]);
        
        $query->andFilterWhere(['like', 'fms_voucher_plot_detail.receipt_no', $this->receiptno]);
        $query->andFilterWhere(['like', 'fms_voucher_plot_detail.jv_no', $this->jvno]);
        $query->andFilterWhere(['like', 'fms_voucher_plot_detail.deposit_slip_no', $this->depositslipno]);

        return $dataProvider;
    }
    
    public function searchdealers($params)
    {
        $query = Fmsvoucher::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        
        
        $dataProvider->setSort([
            'attributes' => [
                'entry_date' => [
                    'asc' => ['entry_date' => SORT_ASC, 'entry_date' => SORT_ASC],
                    'desc' => ['entry_date' => SORT_DESC, 'entry_date' => SORT_DESC],
                    'label' => 'Date',
                    'default' => SORT_ASC
                ],  
                'member_id' => [
                    'asc' => ['member_id' => SORT_ASC, 'member_id' => SORT_ASC],
                    'desc' => ['member_id' => SORT_DESC, 'member_id' => SORT_DESC],
                    'label' => 'Dealer',
                    'default' => SORT_ASC
                ],                
                'sales_center_id' => [
                    'asc' => ['sales_center_id' => SORT_ASC, 'sales_center_id' => SORT_ASC],
                    'desc' => ['sales_center_id' => SORT_DESC, 'sales_center_id' => SORT_DESC],
                    'label' => 'Sales Center',
                    'default' => SORT_ASC
                ],                
                'project_id' => [
                    'asc' => ['project_id' => SORT_ASC, 'project_id' => SORT_ASC],
                    'desc' => ['project_id' => SORT_DESC, 'project_id' => SORT_DESC],
                    'label' => 'Project',
                    'default' => SORT_ASC
                ],                
                'amount_type' => [
                    'asc' => ['amount_type' => SORT_ASC, 'amount_type' => SORT_ASC],
                    'desc' => ['amount_type' => SORT_DESC, 'amount_type' => SORT_DESC],
                    'label' => 'Transaction Type',
                    'default' => SORT_ASC
                ],                
                'amount' => [
                    'asc' => ['amount' => SORT_ASC, 'amount' => SORT_ASC],
                    'desc' => ['amount' => SORT_DESC, 'amount' => SORT_DESC],
                    'label' => 'Amount',
                    'default' => SORT_ASC
                ],                
                'entry_status' => [
                    'asc' => ['entry_status' => SORT_ASC, 'entry_status' => SORT_ASC],
                    'desc' => ['entry_status' => SORT_DESC, 'entry_status' => SORT_DESC],
                    'label' => 'Status',
                    'default' => SORT_ASC
                ],                
            ],
        'defaultOrder' => ['entry_date' => SORT_ASC]
        ]);        

        $query->andFilterWhere([
            'amount_type' => 5,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//        if((($this->receiptno != NULL) || ($this->jvno != NULL && $this->jvno != "") || ($this->depositslipno != null && $this->depositslipno != "") || ($this->targetbankid != null && $this->targetbankid != ""))){
//            $query = $query->joinWith("receipts");
//        }

        if((($this->receiptno != NULL) || ($this->jvno != NULL && $this->jvno != "") || ($this->depositslipno != null && $this->depositslipno != "") || ($this->targetbankid != null && $this->targetbankid != "") || ($this->fileno != NULL && $this->fileno != "") || ($this->formno != NULL && $this->formno != "") || ($this->msno != NULL && $this->msno != ""))){
            $query = $query->joinWith("receipts");
        }

        if(($this->fileno != NULL && $this->fileno != "")){
            $query = $query->joinWith("receipts.plot");
        }

        if(($this->formno != NULL && $this->formno != "")){
            $query = $query->joinWith("receipts.application");
        }

        if(($this->msno != NULL && $this->msno != "")){
            $query = $query->joinWith("receipts.plot.memberships");
        }

        $query->andFilterWhere([
            'voucher_id' => $this->voucher_id,
            'bank_id' => $this->bank_id,
            'entry_date' => $this->entry_date,
            'transaction_date' => $this->transaction_date,
            'sales_center_id' => $this->sales_center_id,
            'project_id' => $this->project_id,
            'member_id' => $this->member_id,
            'entry_status' => $this->entry_status,
        ]);

        $query->andFilterWhere(['like', 'voucher_sr_no', $this->voucher_sr_no])
            ->andFilterWhere(['like', 'folio_no', $this->folio_no])
            ->andFilterWhere(['like', 'narration', $this->narration]);
        
        $query->andFilterWhere(['like', 'fms_voucher_plot_detail.receipt_no', $this->receiptno]);
        $query->andFilterWhere(['like', 'fms_voucher_plot_detail.jv_no', $this->jvno]);
        $query->andFilterWhere(['like', 'fms_voucher_plot_detail.deposit_slip_no', $this->depositslipno]);

        $query->andFilterWhere(['like', 'plots.plot_detail_address', $this->fileno]);
        $query->andFilterWhere(['like', 'property_application.application_no', $this->formno]);
        $query->andFilterWhere(['like', 'property_memberships.ms_no', $this->msno]);

        return $dataProvider;
    }
    
    public function searchcenterverification($params)
    {
        $query = Fmsvoucher::find()->innerJoinWith('salescenter')->innerJoinWith('salescenter.permissions');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ],
//            'pagination' => [
//              'pageSize' => 20,  
//            ],
        ]);
        
        $query->andFilterWhere([
            'entry_status' => 2
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if((($this->receiptno != NULL) || ($this->jvno != NULL && $this->jvno != "") || ($this->depositslipno != null && $this->depositslipno != "") || ($this->targetbankid != null && $this->targetbankid != ""))){
            $query = $query->joinWith("receipts");
        }

        $query->andFilterWhere([
            'voucher_id' => $this->voucher_id,
            'bank_id' => $this->bank_id,
            'entry_date' => $this->entry_date,
            'transaction_date' => $this->transaction_date,
            'sales_center_id' => $this->sales_center_id,
            'entry_status' => $this->entry_status,
        ]);

        $query->andFilterWhere(['like', 'voucher_sr_no', $this->voucher_sr_no])
            ->andFilterWhere(['like', 'folio_no', $this->folio_no])
            ->andFilterWhere(['like', 'narration', $this->narration]);
        
        $query->andFilterWhere(['like', 'fms_voucher_plot_detail.receipt_no', $this->receiptno]);
        $query->andFilterWhere(['like', 'fms_voucher_plot_detail.jv_no', $this->jvno]);
        $query->andFilterWhere(['like', 'fms_voucher_plot_detail.deposit_slip_no', $this->depositslipno]);

        return $dataProvider;
    }
    
    public function searchfinanceverification($params)
    {
        $query = Fmsvoucher::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        
        $query->andFilterWhere([
            'entry_status' => 3
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if((($this->receiptno != NULL) || ($this->jvno != NULL && $this->jvno != "") || ($this->depositslipno != null && $this->depositslipno != "") || ($this->targetbankid != null && $this->targetbankid != ""))){
            $query = $query->joinWith("receipts");
        }

        $query->andFilterWhere([
            'voucher_id' => $this->voucher_id,
            'bank_id' => $this->bank_id,
            'entry_date' => $this->entry_date,
            'transaction_date' => $this->transaction_date,
            'sales_center_id' => $this->sales_center_id,
            'entry_status' => $this->entry_status,
        ]);

        $query->andFilterWhere(['like', 'voucher_sr_no', $this->voucher_sr_no])
            ->andFilterWhere(['like', 'folio_no', $this->folio_no])
            ->andFilterWhere(['like', 'narration', $this->narration]);
        
        $query->andFilterWhere(['like', 'fms_voucher_plot_detail.receipt_no', $this->receiptno]);
        $query->andFilterWhere(['like', 'fms_voucher_plot_detail.jv_no', $this->jvno]);
        $query->andFilterWhere(['like', 'fms_voucher_plot_detail.deposit_slip_no', $this->depositslipno]);

        return $dataProvider;
    }
    
    public function searchfinanceapproval($params)
    {
        $query = Fmsvoucher::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        
        $query->andFilterWhere([
            'entry_status' => 4
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'voucher_id' => $this->voucher_id,
            'bank_id' => $this->bank_id,
            'entry_date' => $this->entry_date,
            'transaction_date' => $this->transaction_date,
            'sales_center_id' => $this->sales_center_id,
            'entry_status' => $this->entry_status,
        ]);

        $query->andFilterWhere(['like', 'voucher_sr_no', $this->voucher_sr_no])
            ->andFilterWhere(['like', 'folio_no', $this->folio_no])
            ->andFilterWhere(['like', 'narration', $this->narration]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
