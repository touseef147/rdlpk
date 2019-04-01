<?php

namespace app\modules\marketting\visitors\reports\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

//use app\modules\visits\models\Dailyvisitors;

/**
 * DailyvisitorsSearch represents the model behind the search form about `app\modules\visits\models\Dailyvisitors`.
 */
class PropertySearch extends Overall {

    private $_byfromdate;
    private $_bytodate;
    private $_bycenter;

    public function getFromdate() {
        return $this->_byfromdate;
    }

    public function setFromdate($value) {
        $this->_byfromdate = $value;
    }

    public function getTodate() {
        return $this->_bytodate;
    }

    public function setTodate($value) {
        $this->_bytodate = $value;
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
    public function projectwisedata($params) {
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return null;
        }

        $rowcrit = "";

        /*if ($this->center > 0) {
            if ($usercrit == "")
            {
                $usercrit = " where sales_center.id=" . $this->center;
            }
            else
            {
                $usercrit.=" and sales_center.id=" . $this->center;
            }

            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $callcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }
        }
        
        if($this->fromdate != "")
        {
            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
        }
        
        if($this->todate != "")
        {
            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
        }
*/
        
        $sqldata = "Select  mkt_interest_booking.size2 As coldata,  " .
                " mkt_interest_booking.project_id As rowdata,  " .
                " Sum(mkt_interest_booking.no_of_plots) As total From  " .
                " mkt_interest_booking Inner Join  project_permissions On " .
                " mkt_interest_booking.project_id =    project_permissions.id " .
                " Where  project_permissions.user_id = 1 " .
                " Group By  mkt_interest_booking.size2, mkt_interest_booking.project_id,  " .
                " mkt_interest_booking.no_of_plots, project_permissions.user_id";


        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\models\Crosstab();

            $model[$count]->columnid = $row["coldata"];
            $model[$count]->rowid = $row["rowdata"];
            $model[$count]->value = $row["total"];
        }

        return $model;
    }
    
    public function salescenterwisedata($params) {
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return null;
        }

        $rowcrit = "";

        /*if ($this->center > 0) {
            if ($usercrit == "")
            {
                $usercrit = " where sales_center.id=" . $this->center;
            }
            else
            {
                $usercrit.=" and sales_center.id=" . $this->center;
            }

            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $callcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }
        }
        
        if($this->fromdate != "")
        {
            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
        }
        
        if($this->todate != "")
        {
            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
        }
*/
        
        $sqldata = "Select  mkt_interest_booking.size2 As coldata,  " .
                " mkt_interest_booking.center_id As rowdata,  " .
                " Sum(mkt_interest_booking.no_of_plots) As total From  " .
                " mkt_interest_booking" .// Inner Join  project_permissions On " .
                //" mkt_interest_booking.project_id =    project_permissions.id " .
                //" Where  project_permissions.user_id = " .
                " Group By  mkt_interest_booking.size2, mkt_interest_booking.center_id  ";

//echo $sqldata;
        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\models\Crosstab();

            $model[$count]->columnid = $row["coldata"];
            $model[$count]->rowid = $row["rowdata"];
            $model[$count]->value = $row["total"];
        }

        return $model;
    }
    
    public function salescenterwisefdata($params) {
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return null;
        }

        $rowcrit = "";

        /*if ($this->center > 0) {
            if ($usercrit == "")
            {
                $usercrit = " where sales_center.id=" . $this->center;
            }
            else
            {
                $usercrit.=" and sales_center.id=" . $this->center;
            }

            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $callcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }
        }
        
        if($this->fromdate != "")
        {
            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
        }
        
        if($this->todate != "")
        {
            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
        }
*/
        
        $sqldata = "Select  mkt_visit_details.followup_status As coldata,  " .
                " mkt_visit_details.deal_by As rowdata,  " .
                " count(mkt_visit_details.id) As total From  " .
                " mkt_visit_details" .// Inner Join  project_permissions On " .
                //" mkt_interest_booking.project_id =    project_permissions.id " .
                //" Where  project_permissions.user_id = " .
                " Group By  mkt_visit_details.followup_status, mkt_visit_details.deal_by  ";

//echo $sqldata;
        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\models\Crosstab();

            $model[$count]->columnid = $row["coldata"];
            $model[$count]->rowid = $row["rowdata"];
            $model[$count]->value = $row["total"];
        }

        return $model;
    }
    
    public function salesexecutivewisedailydata($params) {
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return null;
        }

        $rowcrit = "";

        /*if ($this->center > 0) {
            if ($usercrit == "")
            {
                $usercrit = " where sales_center.id=" . $this->center;
            }
            else
            {
                $usercrit.=" and sales_center.id=" . $this->center;
            }

            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $callcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }
        }
        
        if($this->fromdate != "")
        {
            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
        }
        
        if($this->todate != "")
        {
            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
        }
*/
        
        $sqldata = "Select  day(mkt_interest_booking.booking_date) As coldata,  " .
                " mkt_interest_booking.deal_by As rowdata,  " .
                " Sum(mkt_interest_booking.no_of_plots) As total From  " .
                " mkt_interest_booking" .// Inner Join  project_permissions On " .
                //" mkt_interest_booking.project_id =    project_permissions.id " .
                //" Where  project_permissions.user_id = " .
                " Group By  mkt_interest_booking.booking_date, mkt_interest_booking.deal_by  ";

//echo $sqldata;
        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\models\Crosstab();

            $model[$count]->columnid = $row["coldata"];
            $model[$count]->rowid = $row["rowdata"];
            $model[$count]->value = $row["total"];
        }

        return $model;
    }
    
    public function salesexecutivewisedata($params) {
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return null;
        }

        $rowcrit = "";

        /*if ($this->center > 0) {
            if ($usercrit == "")
            {
                $usercrit = " where sales_center.id=" . $this->center;
            }
            else
            {
                $usercrit.=" and sales_center.id=" . $this->center;
            }

            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $callcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }
        }
        
        if($this->fromdate != "")
        {
            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
        }
        
        if($this->todate != "")
        {
            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
        }
*/
        
        $sqldata = "Select  mkt_interest_booking.size2 As coldata,  " .
                " mkt_interest_booking.project_id As rowdata,  " .
                " Sum(mkt_interest_booking.no_of_plots) As total From  " .
                " mkt_interest_booking" .// Inner Join  project_permissions On " .
                //" mkt_interest_booking.project_id =    project_permissions.id " .
                //" Where  project_permissions.user_id = " .
                " Group By  mkt_interest_booking.size2, mkt_interest_booking.project_id  ";

//echo $sqldata;
        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\models\Crosstab();

            $model[$count]->columnid = $row["coldata"];
            $model[$count]->rowid = $row["rowdata"];
            $model[$count]->value = $row["total"];
        }

        return $model;
    }
    
    public function salesexecutivewisedailyfdata($params) {
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return null;
        }

        $rowcrit = "";

        /*if ($this->center > 0) {
            if ($usercrit == "")
            {
                $usercrit = " where sales_center.id=" . $this->center;
            }
            else
            {
                $usercrit.=" and sales_center.id=" . $this->center;
            }

            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $callcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }
        }
        
        if($this->fromdate != "")
        {
            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
        }
        
        if($this->todate != "")
        {
            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
        }
*/
        
        $sqldata = "Select  day(mkt_visit_details.visit_date) As coldata,  " .
                " mkt_visit_details.deal_by As rowdata,  " .
                " count(mkt_visit_details.id) As total From  " .
                " mkt_visit_details" .// Inner Join  project_permissions On " .
                //" mkt_interest_booking.project_id =    project_permissions.id " .
                //" Where  project_permissions.user_id = " .
                " Group By  mkt_visit_details.deal_by, mkt_visit_details.visit_date  ";

//echo $sqldata;
        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\models\Crosstab();

            $model[$count]->columnid = $row["coldata"];
            $model[$count]->rowid = $row["rowdata"];
            $model[$count]->value = $row["total"];
        }

        return $model;
    }
    
    public function salesexecutivewisefdata($params) {
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return null;
        }

        $rowcrit = "";

        /*if ($this->center > 0) {
            if ($usercrit == "")
            {
                $usercrit = " where sales_center.id=" . $this->center;
            }
            else
            {
                $usercrit.=" and sales_center.id=" . $this->center;
            }

            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $callcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }
        }
        
        if($this->fromdate != "")
        {
            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
        }
        
        if($this->todate != "")
        {
            if ($visitcrit == "")
            {
                $visitcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
        }
*/
        
        $sqldata = "Select  mkt_visit_details.followup_status As coldata,  " .
                " mkt_visit_details.deal_by As rowdata,  " .
                " count(mkt_visit_details.id) As total From  " .
                " mkt_visit_details" .// Inner Join  project_permissions On " .
                //" mkt_interest_booking.project_id =    project_permissions.id " .
                //" Where  project_permissions.user_id = " .
                " Group By  mkt_visit_details.deal_by, mkt_visit_details.followup_status  ";

//echo $sqldata;
        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\models\Crosstab();

            $model[$count]->columnid = $row["coldata"];
            $model[$count]->rowid = $row["rowdata"];
            $model[$count]->value = $row["total"];
        }

        return $model;
    }
    
    
}
