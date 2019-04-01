<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Visitdetails;

/**
 * VisitdetailssSearch represents the model behind the search form about `app\modules\visits\models\Visitdetails`.
 */
class VisitdetailssSearch extends Visitdetails {

    private $_bydatecriteria;
    private $_byfromdate;
    private $_bytodate;

    public function getDatecriteria() {
        return $this->_bydatecriteria;
    }

    public function getFromdate() {
        return $this->_byfromdate;
    }

    public function getTodate() {
        return $this->_bytodate;
    }

    public function setDatecriteria($value) {
        $this->_bydatecriteria = $value;
    }

    public function setFromdate($value) {
        $this->_byfromdate = $value;
    }

    public function setTodate($value) {
        $this->_bytodate = $value;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'visitors_id', 'center_id'], 'integer'],
            [['visit_no', 'visit_type', 'visit_date', 'deal_by', 'next_visit', 'followup_status', 'remarks', 'fromdate', 'todate', 'datecriteria'], 'safe'],
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
        $query = Visitdetails::find();

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


        //echo print_r($this);

        $query->andFilterWhere([
            'id' => $this->id,
            'visitors_id' => $this->visitors_id,
            'visit_date' => $this->visit_date,
            'next_visit' => $this->next_visit,
            'center_id' => $this->center_id,
        ]);

        $query->andFilterWhere(['like', 'visit_no', $this->visit_no])
                ->andFilterWhere(['like', 'visit_type', $this->visit_type])
                ->andFilterWhere(['like', 'deal_by', $this->deal_by])
                ->andFilterWhere(['like', 'followup_status', $this->followup_status])
                ->andFilterWhere(['like', 'remarks', $this->remarks]);

        $query->andFilterWhere(['>=', 'visit_date', $this->fromdate]);

        $query->andFilterWhere(['<=', 'visit_date', $this->todate]);



        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchfollowup($params) {
        $query = Visitdetails::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
            //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
            //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);

        $query->andFilterWhere(['!=', 'visit_type', "direct"]);


        $this->load($params);
        
        //print_r(count($params));
        //echo ($_SESSION["user_array"]["id"]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //	print_r($this);
        //echo date("Y-m-d", strtotime($this->fromdate));

        $query->andFilterWhere([
            'id' => $this->id,
            'visitors_id' => $this->visitors_id,
            'visit_date' => $this->visit_date,
            'next_visit' => $this->next_visit,
            'center_id' => $this->center_id,
        ]);

        $query->andFilterWhere(['like', 'visit_no', $this->visit_no])
                ->andFilterWhere(['like', 'visit_type', $this->visit_type])
                ->andFilterWhere(['like', 'deal_by', $this->deal_by])
                ->andFilterWhere(['like', 'followup_status', $this->followup_status])
                ->andFilterWhere(['like', 'remarks', $this->remarks]);

        if ($this->datecriteria == 1) {
            
        } else if ($this->datecriteria == 2 || $this->datecriteria ==0 || $this->datecriteria == null) {
            $query->andFilterWhere(['=', 'next_visit', date("Y-m-d")]);
        } else {
            if ($this->fromdate != '')
                $query->andFilterWhere(['>=', 'next_visit', date("Y-m-d", strtotime($this->fromdate))]);
//            else
  //              $query->andFilterWhere(['=', 'next_visit', date("Y-m-d")]);

            if ($this->todate != '')
                $query->andFilterWhere(['<=', 'next_visit', date("Y-m-d", strtotime($this->todate))]);
    //        else
      //          $query->andFilterWhere(['=', 'next_visit', date("Y-m-d")]);
        }

        //if ($this->fromdate == '' && $this->todate == '')
            $query->andFilterWhere(['=', 'followup_status', $this->followup_status]);

        //echo $query->createCommand()->getRawSql();

        return $dataProvider;
    }

    public function loadparams($params) {
        $this->load($params);
    }

    public function visittypes()
    {
        $model[] = new \app\models\Keyvalue();

        $model[0]->id = 1;
        $model[0]->value = "Visit";
        $model[0]->total = 0;
        
        $model[] = new \app\models\Keyvalue();

        $model[1]->id = 2;
        $model[1]->value = "Call";
        $model[1]->total = 0;
        
        return $model;
    }

}
