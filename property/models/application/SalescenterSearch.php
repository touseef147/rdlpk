<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Salescenter;

/**
 * SalescenterSearch represents the model behind the search form about `app\modules\propertyconfig\models\Salescenter`.
 */
class SalescenterSearch extends Salescenter
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'image', 'detail'], 'safe'],
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
        $query = Salescenter::find();

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

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'detail', $this->detail]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
    
    public function thelist($byid=0) {
        $rowcrit = "";

        if ($rowcrit == "")
        {
            $rowcrit = " where centers_permissions.user_id=" . $_SESSION["user_array"]["id"];
        }
        else
        {
            $rowcrit.=" and centers_permissions.user_id=" . $_SESSION["user_array"]["id"];
        }
        
        if ($byid > 0) {
            if ($rowcrit == "")
            {
                $rowcrit = " where sales_center.id=" . $byid;
            }
            else
            {
                $rowcrit.=" and sales_center.id=" . $byid;
            }
        }
        
        $sqldata = "Select  sales_center.id,  sales_center.name "
                . "From  centers_permissions "
                . "Inner Join   sales_center On centers_permissions.center_id = sales_center.id " 
                . $rowcrit . 
                "  Group By   sales_center.id";


        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\models\Keyvalue();

            $model[$count]->id = $row["id"];
            $model[$count]->value = $row["name"];
        }

        return $model;
    }
    
}
