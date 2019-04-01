<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Dailyvisitors;

/**
 * DailyvisitorsSearch represents the model behind the search form about `app\modules\visits\models\Dailyvisitors`.
 */
class DailyvisitorsSearch extends Dailyvisitors
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'profession_id', 'city'], 'integer'],
            [['name', 'contactno', 'email', 'refered_by', 'reference', 'reg_date'], 'safe'],
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
        $query = Dailyvisitors::find()->joinWith(['profession'])->joinWith(['visitorCity']);

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
            'profession_id' => $this->profession_id,
            'city' => $this->city,
            'reg_date' => $this->reg_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'contactno', $this->contactno])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'refered_by', $this->refered_by])
            ->andFilterWhere(['like', 'reference', $this->reference]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchwopaging($params)
    {
        $query = Dailyvisitors::find()->joinWith(['profession'])->joinWith(['visitorCity']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        

        $this->load($params);
//        if(isset($params//))

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'profession_id' => $this->profession_id,
            'city' => $this->city,
            'reg_date' => $this->reg_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'contactno', $this->contactno])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'refered_by', $this->refered_by])
            ->andFilterWhere(['like', 'reference', $this->reference]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
