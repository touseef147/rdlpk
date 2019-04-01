<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Projects;

/**
 * ProjectsSearch represents the model behind the search form about `app\modules\propertyconfig\models\Projects`.
 */
class ProjectsSearch extends Projects
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'membership_fee'], 'integer'],
            [['project_name', 'url', 'code', 'teaser', 'details', 'project_image', 'project_map', 'land_map', 'create_date', 'modify_date'], 'safe'],
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
        $query = Projects::find();

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
            'status' => $this->status,
            'membership_fee' => $this->membership_fee,
            'create_date' => $this->create_date,
            'modify_date' => $this->modify_date,
        ]);

        $query->andFilterWhere(['like', 'project_name', $this->project_name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'teaser', $this->teaser])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'project_image', $this->project_image])
            ->andFilterWhere(['like', 'project_map', $this->project_map])
            ->andFilterWhere(['like', 'land_map', $this->land_map]);

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
            $rowcrit = " where project_permissions.user_id=" . $_SESSION["user_array"]["id"];
        }
        else
        {
            $rowcrit.=" and project_permissions.user_id=" . $_SESSION["user_array"]["id"];
        }
        
        if ($byid > 0) {
            if ($rowcrit == "")
            {
                $rowcrit = " where projects.id=" . $byid;
            }
            else
            {
                $rowcrit.=" and projects.id=" . $byid;
            }
        }
        
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
    
}
