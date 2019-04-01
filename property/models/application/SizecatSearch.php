<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Sizecat;

/**
 * SizecatSearch represents the model behind the search form about `app\modules\propertyconfig\models\Sizecat`.
 */
class SizecatSearch extends Sizecat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['size', 'code'], 'safe'],
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
        $query = Sizecat::find();

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

        $query->andFilterWhere(['like', 'size', $this->size])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
    
    public function thelist($byid=0) {
        $rowcrit = "";

        if ($byid > 0) {
            if ($rowcrit == "")
            {
                $rowcrit = " where size_cat.id=" . $byid;
            }
            else
            {
                $rowcrit.=" and size_cat.id=" . $byid;
            }
        }
        
        $sqldata = "Select  id,  size as name "
                . "From  size_cat "
                . $rowcrit ;


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
    
}
