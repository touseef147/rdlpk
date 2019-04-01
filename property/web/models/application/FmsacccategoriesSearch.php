<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Fmsacccategories;

/**
 * FmsacccategoriesSearch represents the model behind the search form about `app\models\application\Fmsacccategories`.
 */
class FmsacccategoriesSearch extends Fmsacccategories
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'head_id', 'status'], 'integer'],
            [['category_code', 'category_title', 'remarks'], 'safe'],
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
        $query = Fmsacccategories::find();

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
            'category_id' => $this->category_id,
            'head_id' => $this->head_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'category_code', $this->category_code])
            ->andFilterWhere(['like', 'category_title', $this->category_title])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
