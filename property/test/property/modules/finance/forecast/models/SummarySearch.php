<?php

namespace app\modules\finance\forecast\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
//use app\modules\finance\models\Dailyvisitors;

/**
 * DailyvisitorsSearch represents the model behind the search form about `app\modules\visits\models\Dailyvisitors`.
 */
class SummarySearch extends Users {

    private $_byfromdate;
    private $_bycenter;

    public function getFromdate() {
        return $this->_byfromdate;
    }

    public function setFromdate($value) {
        $this->_byfromdate = $value;
    }

    public function getCenter() {
        return $this->_bycenter;
    }

    public function setCenter($value) {
        $this->_bycenter = $value;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['center'], 'integer'],
                //[['center', 'contactno', 'email', 'refered_by', 'reference', 'reg_date'], 'safe'],
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
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return null;
        }

        $usercrit = "";
        $visitcrit = "";
        $callcrit = "";

        if ($this->center > 0) {
            if ($usercrit == "")
                $usercrit = " where sales_center.id=" . $this->center;
            else
                $usercrit.=" and sales_center.id=" . $this->center;

            if ($visitcrit == "")
                $visitcrit = " and mkt_visit_details.id=" . $this->center;
            else
                $visitcrit.=" and mkt_visit_details.id=" . $this->center;

            if ($callcrit == "")
                $callcrit = " and mkt_visit_details.id=" . $this->center;
            else
                $callcrit.=" and mkt_visit_details.id=" . $this->center;
        }

        $sqlusers = "Select
  user.id,
  user.firstname,
  sales_center.name
From
  user Inner Join
  centers_permissions On centers_permissions.user_id = user.id Inner Join
  sales_center On centers_permissions.center_id = sales_center.id " . $usercrit;

        $sqlvisits = "Select
  mkt_visit_details.deal_by,
  Count(mkt_visit_details.id) as visits
From
  mkt_visit_details
Where
  mkt_visit_details.visit_type = 'visitor' " . $visitcrit .
                " Group By
  mkt_visit_details.deal_by";

        $sqlcalls = "Select
  mkt_visit_details.deal_by,
  Count(mkt_visit_details.id) as calls
From
  mkt_visit_details
Where
  mkt_visit_details.visit_type = 'caller' " . $callcrit .
                " Group By
  mkt_visit_details.deal_by";
        //$tempval= \app\models\Keyvalue();
        /* $sql = 'Select
          Count(mkt_visit_details.id) As value,
          mkt_visit_details.visitors_id as id
          From
          mkt_visit_details
          Group By
          mkt_visit_details.visit_type, mkt_visit_details.visitors_id';
          $tempval = Yii::$app()->db->createCommand($sql)->queryAll();//\app\models\Keyvalue::findBySql($sql)->all();
          print_r($tempval); */
        /* $rows = (new \yii\db\Query())
          ->select(['Count(id)', 'visitors_id'])
          ->from('mkt_visit_details')
          ->groupBy(['visit_type', 'visitors_id'])
          ->all();
          print_r($rows); */
        $connection = Yii::$app->getDb();
        $cmdusers = $connection->createCommand($sqlusers);
        $users = $cmdusers->queryAll();

        $cmdvisits = $connection->createCommand($sqlvisits);
        $visits = $cmdvisits->queryAll();

        $cmdcalls = $connection->createCommand($sqlcalls);
        $calls = $cmdcalls->queryAll();
//print_r($result);

        $model = [];
        $count = -1;

        foreach ($users as $user) {
            $count++;

            $model[] = new \app\modules\visits\reports\models\Users();

            $model[$count]->userid = $user["id"];
            $model[$count]->username = $user["firstname"];
            $model[$count]->center_name = $user["name"];

            foreach ($visits as $visit) {
                if ($model[$count]->userid == $visit["deal_by"]) {
                    $model[$count]->no_of_visits = $visit["visits"];
                }
            }

            foreach ($calls as $call) {
                if ($model[$count]->userid == $call["deal_by"]) {
                    $model[$count]->no_of_calls = $call["calls"];
                }
            }
        }

        return $model;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
}
