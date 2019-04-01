<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Fmsaccounts;

/**
 * FmsaccountsSearch represents the model behind the search form about `app\models\application\Fmsaccounts`.
 */
class FmsaccountsSearch extends Fmsaccounts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acc_id', 'category_id', 'status'], 'integer'],
            [['acc_code', 'acc_title', 'remarks'], 'safe'],
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
        $query = Fmsaccounts::find();

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
            'acc_id' => $this->acc_id,
            'category_id' => $this->category_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'acc_code', $this->acc_code])
            ->andFilterWhere(['like', 'acc_title', $this->acc_title])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
