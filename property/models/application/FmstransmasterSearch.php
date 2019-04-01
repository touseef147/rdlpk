<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Fmstransmaster;

/**
 * FmstransmasterSearch represents the model behind the search form about `app\models\application\Fmstransmaster`.
 */
class FmstransmasterSearch extends Fmstransmaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trans_id', 'trans_type', 'entered_by', 'project_id', 'sales_center_id'], 'integer'],
            [['serial_no', 'trans_date', 'remarks', 'ref_no'], 'safe'],
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
        $query = Fmstransmaster::find();

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
            'trans_id' => $this->trans_id,
            'trans_type' => $this->trans_type,
            'trans_date' => $this->trans_date,
            'entered_by' => $this->entered_by,
            'project_id' => $this->project_id,
            'sales_center_id' => $this->sales_center_id,
        ]);

        $query->andFilterWhere(['like', 'serial_no', $this->serial_no])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'ref_no', $this->ref_no]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
