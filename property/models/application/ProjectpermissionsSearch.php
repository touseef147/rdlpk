<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Projectpermissions;

/**
 * ProjectpermissionsSearch represents the model behind the search form about `app\modules\propertyconfig\models\Projectpermissions`.
 */
class ProjectpermissionsSearch extends Projectpermissions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'project_id'], 'integer'],
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
        $query = Projectpermissions::find();

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
            'project_id' => $this->project_id,
        ]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
    
    public function projectlist($byuserid=0) {
        $rowcrit = "";

        $rowcrit .= ($rowcrit == "" ? " where " : " and ") . " project_permissions.user_id=" . $byuserid;
        
        $sqldata = "Select  projects.id,  projects.project_name "
                . "From  project_permissions "
                . "Inner Join   projects On project_permissions.project_id = projects.id " 
                . $rowcrit . 
                "  Group By   projects.id";

        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\models\Keyvalue();

            $model[$count]->id = $row["id"];
            $model[$count]->value = $row["project_name"];
            $model[$count]->total = 0;
        }

        return $model;
    }
    
    public function userlist($byprojid=0) {
        $rowcrit = "";

        if($byprojid>0)
            $rowcrit .= ($rowcrit == "" ? " where " : " and ") . " project_permissions.project_id=" . $byprojid;
        
        $sqldata = "Select  projects.user_id,  users.firstname "
                . "From  project_permissions "
                . "Inner Join   users On project_permissions.users_id = users.id " 
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
