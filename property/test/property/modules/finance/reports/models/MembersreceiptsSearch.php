<?php

namespace app\modules\finance\reports\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
//use app\modules\visits\models\Dailyvisitors;

/**
 * DailyvisitorsSearch represents the model behind the search form about `app\modules\visits\models\Dailyvisitors`.
 */
class MembersreceiptsSearch extends Membersreceipts {

 

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['userid','date'], 'integer'],
              
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

        $membercrit = "";
        $chargescrit = "";
        $installmentscrit = "";

        //if ($this->center > 0) {
            /*if ($usercrit == "")
                $usercrit = " where sales_center.id=" . $this->center;
            else
                $usercrit.=" and sales_center.id=" . $this->center;*/

            if ($chargescrit == "")
                $chargescrit = " where str_to_date(plotpayment.duedate,'%d-%m-%Y') <= str_to_date ('" . date("d-m-Y")."','%d-%m-%Y')";
            else
                $chargescrit = " and str_to_date(plotpayment.duedate,'%d-%m-%Y') <= str_to_date('" . date("d-m-Y")."','%d-%m-%Y')";

            if ($installmentscrit == "")
                $installmentscrit = " where str_to_date(installpayment.due_date,'%d-%m-%Y') <= str_to_date ('" . date("d-m-Y")."','%d-%m-%Y')";
            else
                $installmentscrit = " and str_to_date(installpayment.due_date,'%d-%m-%Y') <= str_to_date ('" . date("d-m-Y")."','%d-%m-%Y')";
        //}

        $sqlmembers = "Select
  members.id,
  members.name
From
  members Inner Join
  memberplot On memberplot.member_id = members.id " . $membercrit."  Group By
  members.id, members.name";

        $sqlcharges = "Select
  plotpayment.mem_id,
  sum(plotpayment.amount) as totalcharges,
  sum(plotpayment.paidamount) as paidcharges
From
  plotpayment

  " . $chargescrit .
                " Group By
  plotpayment.mem_id";

        $sqlinstallments = "Select
  installpayment.mem_id,
  sum(installpayment.dueamount) as dueamount,
  sum(installpayment.paidamount) as paidamount
From
  installpayment
 " . $installmentscrit .
                " Group By
  installpayment.mem_id";
        
//        echo $sqlinstallments;

        $connection = Yii::$app->getDb();
        $cmdmembers = $connection->createCommand($sqlmembers);
        $members = $cmdmembers->queryAll();

        $cmdcharges = $connection->createCommand($sqlcharges);
        $charges = $cmdcharges->queryAll();

        $cmdinstallments = $connection->createCommand($sqlinstallments);
        $installments = $cmdinstallments->queryAll();
		
        $model = [];
        $count = -1;
        
        foreach ($members as $rec) {
            $chargesdue=0;
            $chargespaid=0;
            $instdue=0;
            $instpaid=0;
            
            foreach ($charges as $c) {
                if ($rec["id"] == $c["mem_id"]) {
                    $chargesdue = $c["totalcharges"];
                    $chargespaid = $c["paidcharges"];
                }
            }

            foreach ($installments as $i) {
                if ($rec["id"] == $i["mem_id"]) {
                    $instdue = $i["dueamount"];
                    $instpaid = $i["paidamount"];
                }
            }
            
            if($chargesdue>$chargespaid || $instdue > $instpaid)
            {
                $count++;

                $model[] = new \app\modules\finance\reports\models\Membersreceipts();

                $model[$count]->member_id = $rec["id"];
                $model[$count]->member_name = $rec["name"];

                $model[$count]->charges_due = $chargesdue;
                $model[$count]->charges_received = $chargespaid;

                $model[$count]->installment_due = $instdue;
                $model[$count]->installment_received = $instpaid;
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
