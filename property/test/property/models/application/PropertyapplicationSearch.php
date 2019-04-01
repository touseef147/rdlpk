<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Propertyapplication;

/**
 * PropertyapplicationSearch represents the model behind the search form about `app\modules\finance\models\Propertyapplication`.
 */
class PropertyapplicationSearch extends Propertyapplication {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['application_id', 'project_id', 'sales_center_id', 'member_id', 'property_type', 'property_size', 'dealer_id', 'nominee_id', 'voucher_id', 'property_against', 'application_status'], 'integer'],
            [['application_no', 'application_date'], 'safe'],
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
        $query = Propertyapplication::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                'defaultOrder' => ['application_no' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->application_status == NULL) {
            if ($this->application_no != NULL || $this->project_id != NULL || $this->sales_center_id != NULL || $this->property_against != NULL || $this->property_size != NULL || $this->property_type != NULL) {
                
            } else {
                $query->andFilterWhere([
                    'application_status' => 0,
                ]);
            }
        }

        $query->andFilterWhere([
            'application_id' => $this->application_id,
            'project_id' => $this->project_id,
            'sales_center_id' => $this->sales_center_id,
            'member_id' => $this->member_id,
            'property_type' => $this->property_type,
            'property_size' => $this->property_size,
            'dealer_id' => $this->dealer_id,
            'nominee_id' => $this->nominee_id,
            'voucher_id' => $this->voucher_id,
            'property_against' => $this->property_against,
            'application_status' => $this->application_status,
        ]);

        $query->andFilterWhere(['like', 'application_no', $this->application_no]);
//        $query->andFilterWhere(['application_date', $this->application_date]);

        return $dataProvider;
    }

    public function loadparams($params) {
        $this->load($params);
    }

    public function getsummary($params, $intervalcolumn = "property_application.application_date", $interval = 1, $intervaltype = "DAY") {
        $this->load($params);

        $datecolumn = "";
        $enddate = "";
        //$datecol2 = ",'' as datevalue2";
        //$datecol2title = "";

        if ($intervalcolumn == "") {
            $intervalcolumn = "property_application.application_date";
        }

        if (strtoupper($intervaltype) == "DAY") {
            if ($interval == 1) {
                $datecolumn = $intervalcolumn . " as datevalue";
                $enddate = $intervalcolumn;
            } else {
                $datecolumn = "floor(datediff(" . $intervalcolumn . ", CURDATE()) / " . $interval . ") * " . $interval . " as datevalue";
                $enddate = $intervalcolumn . " +  INTERVAL " . $interval . " DAY";
            }
        } elseif (strtoupper($intervaltype) == "WEEK") {
            if ($interval == 1) {
                
            } else {
                
            }
        } elseif (strtoupper($intervaltype) == "MONTH") {
            if ($interval == 1) {
                $datecolumn = "CONVERT(MONTH(" . $intervalcolumn . "), CHAR(2)) as datevalue";
                $enddate = "min(" . $intervalcolumn . ") +  INTERVAL " . $interval . " MONTH";
                //$datecol2 = ", CONVERT(year(".$intervalcolumn."), CHAR(4)) as datevalue2"; 
                //$datecol2title = ", datevalue2";
            } else {
                $datecolumn = "CEIL(MONTH(" . $intervalcolumn . ")/" . $interval . ") as datevalue";
                $enddate = "min(" . $intervalcolumn . ") +  INTERVAL " . $interval . " MONTH";
                //$datecol2 = ", CONVERT(year(".$intervalcolumn."), CHAR(4)) as datevalue2"; 
                //$datecol2title = ", datevalue2";
            }
        } elseif (strtoupper($intervaltype) == "YEAR") {
            if ($interval == 1) {
                $datecolumn = "year(" . $intervalcolumn . ") as datevalue";
            } else {
                $datecolumn = "CEIL(YEAR(" . $intervalcolumn . ")/" . $interval . ") as datevalue";
                $enddate = "min(" . $intervalcolumn . ") +  INTERVAL " . $interval . " YEAR";
            }
        }

        $sql = "Select
  " . $datecolumn . ", min(" . $intervalcolumn . ") as spanfrom, max(" . $intervalcolumn . ") as spanto, " . $enddate . " as spanend,
  property_application.property_type,
  property_application.dealer_id,
  property_application.property_size,
  property_application.property_against,
  Count(property_application.application_id) as no_of_apps
From
  property_application
Group By
  datevalue, property_application.property_type,
  property_application.dealer_id, property_application.property_size,
  property_application.property_against";
        echo $sql;

        $connection = Yii::$app->getDb();
        $cmd = $connection->createCommand($sql);
        return $cmd->queryAll();
    }

}
