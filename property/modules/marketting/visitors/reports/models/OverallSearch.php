<?php

namespace app\modules\marketting\visitors\reports\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

//use app\modules\visits\models\Dailyvisitors;

/**
 * DailyvisitorsSearch represents the model behind the search form about `app\modules\visits\models\Dailyvisitors`.
 */
class OverallSearch extends Overall {

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
            [['fromdate','todate'], 'safe'],
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
    public function salescenterwisesummary($params) {
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

        $sqlrow = "Select  sales_center.id,  sales_center.name "
                . "From  centers_permissions "
                . "Inner Join   sales_center On centers_permissions.center_id = sales_center.id " 
                . $usercrit . 
                "  Group By   sales_center.id";

        $sqlvisits = "Select  mkt_visit_details.center_id,  Count(mkt_visit_details.id) as visits "
                . "From   mkt_visit_details "
                . "Where   mkt_visit_details.visit_type = 'visitor' " 
                . $visitcrit .                 
                " Group By   mkt_visit_details.center_id";
        

        $sqlcalls = "Select  mkt_visit_details.center_id,  Count(mkt_visit_details.id) as calls "
                . "From   mkt_visit_details "
                . "Where   mkt_visit_details.visit_type = 'caller' " 
                . $callcrit .                 
                " Group By   mkt_visit_details.center_id";
        
        $sqlinterests = "Select  mkt_interest_booking.center_id,  "
                . "Count(mkt_interest_booking.id) as interests "
                . "From   mkt_interest_booking "
                . "Where   mkt_interest_booking.type = 'Interest'  "
                . "Group By   mkt_interest_booking.center_id";
        
        $sqlbookings = "Select  mkt_interest_booking.center_id,  "
                . "Count(mkt_interest_booking.id) as bookings "
                . "From   mkt_interest_booking "
                . "Where   mkt_interest_booking.type = 'Booking'  "
                . "Group By   mkt_interest_booking.center_id";

        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqlrow);
        $rows = $cmdrow->queryAll();

        $cmdvisits = $connection->createCommand($sqlvisits);
        $visits = $cmdvisits->queryAll();

        $cmdcalls = $connection->createCommand($sqlcalls);
        $calls = $cmdcalls->queryAll();

        $sqlinterests = $connection->createCommand($sqlinterests);
        $interests = $sqlinterests->queryAll();

        $sqlbookings = $connection->createCommand($sqlbookings);
        $bookings = $sqlbookings->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\modules\visits\reports\models\Overall();

            $model[$count]->center_id = $row["id"];
            $model[$count]->center_name = $row["name"];

            foreach ($visits as $visit) {
                if ($model[$count]->center_id == $visit["center_id"]) {
                    $model[$count]->no_of_visits = $visit["visits"];
                }
            }

            foreach ($calls as $call) {
                if ($model[$count]->center_id == $call["center_id"]) {
                    $model[$count]->no_of_calls = $call["calls"];
                }
            }
            foreach ($interests as $interest) {
                if ($model[$count]->center_id == $interest["center_id"]) {
                    $model[$count]->no_of_interests = $interest["interests"];
                }
            }
            foreach ($bookings as $booking) {
                if ($model[$count]->center_id == $booking["center_id"]) {
                    $model[$count]->no_of_bookings = $booking["bookings"];
                }
            }
        }

        return $model;
    }
    
    public function salesexecutivewisesummary($params) {
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
            {
                $usercrit = " where centers_permissions.center_id=" . $this->center;
            }
            else
            {
                $usercrit.=" and centers_permissions.center_id=" . $this->center;
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
                $visitcrit = " and mkt_visit_details.visit_date<='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date<='" . date("Y-m-d",strtotime($this->todate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date<='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date<='" . date("Y-m-d",strtotime($this->todate))."'";
            }
        }

        $sqlrow = "Select  centers_permissions.user_id,  user.firstname, user.middelname, user.lastname, sales_center.name as center_name "
                . "From  centers_permissions "
                . "Inner Join   user On centers_permissions.user_id = user.id " 
                . "Inner Join   sales_center On sales_center.id = centers_permissions.center_id " 
                . $usercrit . 
                "  Group By   centers_permissions.user_id";

        $sqlvisits = "Select  mkt_visit_details.deal_by,  Count(mkt_visit_details.id) as visits "
                . "From   mkt_visit_details "
                . "Where   mkt_visit_details.visit_type = 'visitor' " 
                . $visitcrit .                 
                " Group By   mkt_visit_details.deal_by";

        $sqlcalls = "Select  mkt_visit_details.deal_by,  Count(mkt_visit_details.id) as calls "
                . "From   mkt_visit_details "
                . "Where   mkt_visit_details.visit_type = 'caller' " 
                . $callcrit .                 
                " Group By   mkt_visit_details.deal_by";
        
        $sqlinterests = "Select  mkt_interest_booking.deal_by,  "
                . "Count(mkt_interest_booking.id) as interests "
                . "From   mkt_interest_booking "
                . "Where   mkt_interest_booking.type = 'Interest'  "
                . "Group By   mkt_interest_booking.deal_by";
        
        $sqlbookings = "Select  mkt_interest_booking.deal_by,  "
                . "Count(mkt_interest_booking.id) as bookings "
                . "From   mkt_interest_booking "
                . "Where   mkt_interest_booking.type = 'Booking'  "
                . "Group By   mkt_interest_booking.deal_by";

        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqlrow);
        $rows = $cmdrow->queryAll();

        $cmdvisits = $connection->createCommand($sqlvisits);
        $visits = $cmdvisits->queryAll();

        $cmdcalls = $connection->createCommand($sqlcalls);
        $calls = $cmdcalls->queryAll();

        $sqlinterests = $connection->createCommand($sqlinterests);
        $interests = $sqlinterests->queryAll();

        $sqlbookings = $connection->createCommand($sqlbookings);
        $bookings = $sqlbookings->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\modules\visits\reports\models\Overall();

            $model[$count]->userid = $row["user_id"];
            $model[$count]->username = $row["firstname"] . " " . $row["middelname"];
            $model[$count]->center_name = $row["center_name"];

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
            foreach ($interests as $interest) {
                if ($model[$count]->userid == $interest["deal_by"]) {
                    $model[$count]->no_of_interests = $interest["interests"];
                }
            }
            foreach ($bookings as $booking) {
                if ($model[$count]->userid == $booking["deal_by"]) {
                    $model[$count]->no_of_bookings = $booking["bookings"];
                }
            }
        }

        return $model;
    }

    public function salescenterwisefollowupsummary($params) {
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return null;
        }

        $usercrit = "";
        $pendingcrit = "";
        $closedcrit = "";
        $cancelledcrit = "";
        $visitagaincrit = "";

        if ($this->center > 0) {
            if ($usercrit == "")
            {
                $usercrit = " where sales_center.id=" . $this->center;
            }
            else
            {
                $usercrit.=" and sales_center.id=" . $this->center;
            }

            if ($pendingcrit == "")
            {
                $pendingcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $pendingcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }

            if ($closedcrit == "")
            {
                $closedcrit = " and mkt_visit_details.center_id=" . $this->center;
            }
            else
            {
                $closedcrit.=" and mkt_visit_details.center_id=" . $this->center;
            }
        }
        
        if($this->fromdate != "")
        {
            if ($pendingcrit == "")
            {
                $pendingcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $pendingcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }

            if ($closedcrit == "")
            {
                $closedcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
            else
            {
                $closedcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->fromdate))."'";
            }
        }
        
        if($this->todate != "")
        {
            if ($pendingcrit == "")
            {
                $pendingcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $pendingcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }

            if ($closedcrit == "")
            {
                $closedcrit = " and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $closedcrit.=" and mkt_visit_details.visit_date>='" . date("Y-m-d",strtotime($this->todate))."'";
            }
        }

        $sqlrow = "Select  sales_center.id,  sales_center.name "
                . "From  centers_permissions "
                . "Inner Join   sales_center On centers_permissions.center_id = sales_center.id " 
                . $usercrit . 
                "  Group By   sales_center.id";

        $sqlpending = "Select  mkt_visit_details.center_id,  Count(mkt_visit_details.id) as visits "
                . "From   mkt_visit_details "
                . "Where   mkt_visit_details.visit_type = 'visitor' " 
                . $pendingcrit .                 
                " Group By   mkt_visit_details.center_id";
        

        $sqlclosed = "Select  mkt_visit_details.center_id,  Count(mkt_visit_details.id) as calls "
                . "From   mkt_visit_details "
                . "Where   mkt_visit_details.visit_type = 'caller' " 
                . $closedcrit .                 
                " Group By   mkt_visit_details.center_id";
        
        $sqlcancelled = "Select  mkt_interest_booking.center_id,  "
                . "Count(mkt_interest_booking.id) as interests "
                . "From   mkt_interest_booking "
                . "Where   mkt_interest_booking.type = 'Interest'  "
                . "Group By   mkt_interest_booking.center_id";
        
        $sqlvisitagain = "Select  mkt_interest_booking.center_id,  "
                . "Count(mkt_interest_booking.id) as bookings "
                . "From   mkt_interest_booking "
                . "Where   mkt_interest_booking.type = 'Booking'  "
                . "Group By   mkt_interest_booking.center_id";

        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqlrow);
        $rows = $cmdrow->queryAll();

        $cmdpending = $connection->createCommand($sqlpending);
        $pendings = $cmdpending->queryAll();

        $cmdlosed = $connection->createCommand($sqlclosed);
        $closed = $cmdlosed->queryAll();

/*        $sqlinterests = $connection->createCommand($sqlinterests);
        $interests = $sqlinterests->queryAll();

        $sqlbookings = $connection->createCommand($sqlbookings);
        $bookings = $sqlbookings->queryAll();
*/
        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\modules\visits\reports\models\Overall();

            $model[$count]->center_id = $row["id"];
            $model[$count]->center_name = $row["name"];

            foreach ($pendings as $pending) {
                if ($model[$count]->center_id == $pending["center_id"]) {
                    $model[$count]->no_of_visits = $pending["visits"];
                }
            }

            foreach ($calls as $call) {
                if ($model[$count]->center_id == $call["center_id"]) {
                    $model[$count]->no_of_calls = $call["calls"];
                }
            }
            foreach ($interests as $interest) {
                if ($model[$count]->center_id == $interest["center_id"]) {
                    $model[$count]->no_of_interests = $interest["interests"];
                }
            }
            foreach ($bookings as $booking) {
                if ($model[$count]->center_id == $booking["center_id"]) {
                    $model[$count]->no_of_bookings = $booking["bookings"];
                }
            }
        }

        return $model;
    }
    
    public function salesexecutivewisefollowupsummary($params) {
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
            {
                $usercrit = " where centers_permissions.center_id=" . $this->center;
            }
            else
            {
                $usercrit.=" and centers_permissions.center_id=" . $this->center;
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
                $visitcrit = " and mkt_visit_details.visit_date<='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $visitcrit.=" and mkt_visit_details.visit_date<='" . date("Y-m-d",strtotime($this->todate))."'";
            }

            if ($callcrit == "")
            {
                $callcrit = " and mkt_visit_details.visit_date<='" . date("Y-m-d",strtotime($this->todate))."'";
            }
            else
            {
                $callcrit.=" and mkt_visit_details.visit_date<='" . date("Y-m-d",strtotime($this->todate))."'";
            }
        }

        $sqlrow = "Select  centers_permissions.user_id,  user.firstname, user.middelname, user.lastname, sales_center.name as center_name "
                . "From  centers_permissions "
                . "Inner Join   user On centers_permissions.user_id = user.id " 
                . "Inner Join   sales_center On sales_center.id = centers_permissions.center_id " 
                . $usercrit . 
                "  Group By   centers_permissions.user_id";

        $sqlvisits = "Select  mkt_visit_details.deal_by,  Count(mkt_visit_details.id) as visits "
                . "From   mkt_visit_details "
                . "Where   mkt_visit_details.visit_type = 'visitor' " 
                . $visitcrit .                 
                " Group By   mkt_visit_details.deal_by";

        $sqlcalls = "Select  mkt_visit_details.deal_by,  Count(mkt_visit_details.id) as calls "
                . "From   mkt_visit_details "
                . "Where   mkt_visit_details.visit_type = 'caller' " 
                . $callcrit .                 
                " Group By   mkt_visit_details.deal_by";
        
        $sqlinterests = "Select  mkt_interest_booking.deal_by,  "
                . "Count(mkt_interest_booking.id) as interests "
                . "From   mkt_interest_booking "
                . "Where   mkt_interest_booking.type = 'Interest'  "
                . "Group By   mkt_interest_booking.deal_by";
        
        $sqlbookings = "Select  mkt_interest_booking.deal_by,  "
                . "Count(mkt_interest_booking.id) as bookings "
                . "From   mkt_interest_booking "
                . "Where   mkt_interest_booking.type = 'Booking'  "
                . "Group By   mkt_interest_booking.deal_by";

        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqlrow);
        $rows = $cmdrow->queryAll();

        $cmdvisits = $connection->createCommand($sqlvisits);
        $visits = $cmdvisits->queryAll();

        $cmdcalls = $connection->createCommand($sqlcalls);
        $calls = $cmdcalls->queryAll();

        $sqlinterests = $connection->createCommand($sqlinterests);
        $interests = $sqlinterests->queryAll();

        $sqlbookings = $connection->createCommand($sqlbookings);
        $bookings = $sqlbookings->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\modules\visits\reports\models\Overall();

            $model[$count]->userid = $row["user_id"];
            $model[$count]->username = $row["firstname"] . " " . $row["middelname"];
            $model[$count]->center_name = $row["center_name"];

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
            foreach ($interests as $interest) {
                if ($model[$count]->userid == $interest["deal_by"]) {
                    $model[$count]->no_of_interests = $interest["interests"];
                }
            }
            foreach ($bookings as $booking) {
                if ($model[$count]->userid == $booking["deal_by"]) {
                    $model[$count]->no_of_bookings = $booking["bookings"];
                }
            }
        }

        return $model;
    }
    
    
}
