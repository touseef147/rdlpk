<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Fmstransdetail;

/**
 * FmstransdetailSearch represents the model behind the search form about `app\models\application\Fmstransdetail`.
 */
class FmstransdetailSearch extends Fmstransdetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['detail_id', 'trans_id', 'acc_id'], 'integer'],
            [['dr_amount', 'cr_amount'], 'number'],
            [['remarks'], 'safe'],
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
        $query = Fmstransdetail::find();

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
            'detail_id' => $this->detail_id,
            'trans_id' => $this->trans_id,
            'acc_id' => $this->acc_id,
            'dr_amount' => $this->dr_amount,
            'cr_amount' => $this->cr_amount,
        ]);

        $query->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
    
    public function searchinstruments($params)
    {
        $query = Fmstransdetail::find();

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
            'acc_id' => 4,
        ]);
        
        $query->andFilterWhere([
            'detail_id' => $this->detail_id,
            'trans_id' => $this->trans_id,
            'acc_id' => $this->acc_id,
            'dr_amount' => $this->dr_amount,
            'cr_amount' => $this->cr_amount,
        ]);

        $query->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
