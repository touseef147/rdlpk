<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Centerspermissions;

/**
 * CenterspermissionsSearch represents the model behind the search form about `app\modules\propertyconfig\models\Centerspermissions`.
 */
class CenterspermissionsSearch extends Centerspermissions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'center_id'], 'integer'],
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
        $query = Centerspermissions::find();

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
            'user_id' => $this->user_id,
            'center_id' => $this->center_id,
        ]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
    
    public function centerlist($byuserid=0) {
        $rowcrit = "";

        $rowcrit .= ($rowcrit == "" ? " where " : " and ") . " centers_permissions.user_id=" . $byuserid;
        
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
            $model[$count]->total = 0;
        }

        return $model;
    }
    
    public function userlist($bycenterid=0) {
        $rowcrit = "";

        if($bycenterid>0)
            $rowcrit .= ($rowcrit == "" ? " where " : " and ") . " centers_permissions.center_id=" . $bycenterid;
        
        $sqldata = "Select  users.id,  users.firstname "
                . "From  centers_permissions "
                . "Inner Join   users On centers_permissions.users_id = users.id " 
                . $rowcrit . 
                "  Group By   users.id";

        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\models\Keyvalue();

            $model[$count]->id = $row["id"];
            $model[$count]->value = $row["firstname"];
            $model[$count]->total = 0;
        }

        return $model;
    }
}
