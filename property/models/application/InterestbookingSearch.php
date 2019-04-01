<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Interestbooking;

/**
 * InterestbookingSearch represents the model behind the search form about `app\modules\visits\models\Interestbooking`.
 */
class InterestbookingSearch extends Interestbooking
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'visitors_id', 'deal_by', 'center_id','project_id'], 'integer'],
            [['com_res', 'size2', 'booking_date', 'no_of_plots', 'type'], 'safe'],
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
        $query = Interestbooking::find();

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
            'visitors_id' => $this->visitors_id,
            'deal_by' => $this->deal_by,
            'center_id' => $this->center_id,
            'project_id' => $this->project_id
        ]);

        $query->andFilterWhere(['like', 'com_res', $this->com_res])
            ->andFilterWhere(['like', 'size2', $this->size2])
            ->andFilterWhere(['like', 'booking_date', $this->booking_date])
            ->andFilterWhere(['like', 'no_of_plots', $this->no_of_plots])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
