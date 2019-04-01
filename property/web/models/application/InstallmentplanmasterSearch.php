<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Installmentplanmaster;

/**
 * InstallmentplanmasterSearch represents the model behind the search form about `app\models\application\Installmentplanmaster`.
 */
class InstallmentplanmasterSearch extends Installmentplanmaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plan_id', 'project_id', 'category_id', 'no_of_installments', 'plan_land_type', 'plan_development_type'], 'integer'],
            [['description'], 'safe'],
            [['total_amount'], 'number'],
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
        $query = Installmentplanmaster::find();

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
            'plan_id' => $this->plan_id,
            'project_id' => $this->project_id,
            'category_id' => $this->category_id,
            'total_amount' => $this->total_amount,
            'no_of_installments' => $this->no_of_installments,
            'plan_land_type' => $this->plan_land_type,
            'plan_development_type' => $this->plan_development_type,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
