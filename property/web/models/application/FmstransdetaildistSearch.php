<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Fmstransdetaildist;

/**
 * FmstransdetaildistSearch represents the model behind the search form about `app\models\application\Fmstransdetaildist`.
 */
class FmstransdetaildistSearch extends Fmstransdetaildist
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['distribution_id', 'trans_id', 'distributed_to_id'], 'integer'],
            [['distributed_to_type', 'remarks'], 'safe'],
            [['dr_amount', 'cr_amount'], 'number'],
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
        $query = Fmstransdetaildist::find();

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
            'distribution_id' => $this->distribution_id,
            'trans_id' => $this->trans_id,
            'distributed_to_id' => $this->distributed_to_id,
            'dr_amount' => $this->dr_amount,
            'cr_amount' => $this->cr_amount,
        ]);

        $query->andFilterWhere(['like', 'distributed_to_type', $this->distributed_to_type])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
    
    public function searchinstruments($params)
    {
        $query = Fmstransdetaildist::find()->joinWith(['transaction']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            //'defaultOrder' => [
              //  ['action_code'=>SORT_ASC],
            //],
            'attributes' => [
                'serial_no' => [
                    'asc' => ['serial_no' => SORT_ASC, 'serial_no' => SORT_ASC],
                    'desc' => ['serial_no' => SORT_DESC, 'serial_no' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'trans_type' => [
                    'asc' => ['trans_type' => SORT_ASC, 'trans_type' => SORT_ASC],
                    'desc' => ['trans_type' => SORT_DESC, 'trans_type' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'trans_date' => [
                    'asc' => ['trans_date' => SORT_ASC, 'trans_date' => SORT_ASC],
                    'desc' => ['trans_date' => SORT_DESC, 'trans_date' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'name' => [
                    'asc' => ['members.name' => SORT_ASC, 'members.name' => SORT_ASC],
                    'desc' => ['members.name' => SORT_DESC, 'members.name' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'bank_title' => [
                    'asc' => ['bank_title' => SORT_ASC, 'bank_title' => SORT_ASC],
                    'desc' => ['bank_title' => SORT_DESC, 'bank_title' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'bank_trans_no' => [
                    'asc' => ['bank_trans_no' => SORT_ASC, 'bank_trans_no' => SORT_ASC],
                    'desc' => ['bank_trans_no' => SORT_DESC, 'bank_trans_no' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'cr_amount' => [
                    'asc' => ['cr_amount' => SORT_ASC, 'cr_amount' => SORT_ASC],
                    'desc' => ['cr_amount' => SORT_DESC, 'cr_amount' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'remarks' => [
                    'asc' => ['fms_trans_master.remarks' => SORT_ASC, 'fms_trans_master.remarks' => SORT_ASC],
                    'desc' => ['fms_trans_master.remarks' => SORT_DESC, 'fms_trans_master.remarks' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
            ],
        'defaultOrder' => ['trans_date' => SORT_DESC,'trans_type' => SORT_DESC,'serial_no' => SORT_DESC]
        ]);        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'against' => 4,
            'distributed_to_type' => 'Dealer',
        ]);

//        $query->andFilterWhere([
  //          '>', 'cr_amount' , 0,
    //    ]);

        $query->andFilterWhere([
            'distribution_id' => $this->distribution_id,
            'trans_id' => $this->trans_id,
            'distributed_to_id' => $this->distributed_to_id,
            'dr_amount' => $this->dr_amount,
            'cr_amount' => $this->cr_amount,
        ]);

        $query->andFilterWhere(['like', 'distributed_to_type', $this->distributed_to_type])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
    
    public function searchcommissions($params)
    {
        $query = Fmstransdetaildist::find()->joinWith(['transaction']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            //'defaultOrder' => [
              //  ['action_code'=>SORT_ASC],
            //],
            'attributes' => [
                'serial_no' => [
                    'asc' => ['serial_no' => SORT_ASC, 'serial_no' => SORT_ASC],
                    'desc' => ['serial_no' => SORT_DESC, 'serial_no' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'trans_type' => [
                    'asc' => ['trans_type' => SORT_ASC, 'trans_type' => SORT_ASC],
                    'desc' => ['trans_type' => SORT_DESC, 'trans_type' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'trans_date' => [
                    'asc' => ['trans_date' => SORT_ASC, 'trans_date' => SORT_ASC],
                    'desc' => ['trans_date' => SORT_DESC, 'trans_date' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'name' => [
                    'asc' => ['members.name' => SORT_ASC, 'members.name' => SORT_ASC],
                    'desc' => ['members.name' => SORT_DESC, 'members.name' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'bank_title' => [
                    'asc' => ['bank_title' => SORT_ASC, 'bank_title' => SORT_ASC],
                    'desc' => ['bank_title' => SORT_DESC, 'bank_title' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'bank_trans_no' => [
                    'asc' => ['bank_trans_no' => SORT_ASC, 'bank_trans_no' => SORT_ASC],
                    'desc' => ['bank_trans_no' => SORT_DESC, 'bank_trans_no' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'cr_amount' => [
                    'asc' => ['cr_amount' => SORT_ASC, 'cr_amount' => SORT_ASC],
                    'desc' => ['cr_amount' => SORT_DESC, 'cr_amount' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'remarks' => [
                    'asc' => ['fms_trans_master.remarks' => SORT_ASC, 'fms_trans_master.remarks' => SORT_ASC],
                    'desc' => ['fms_trans_master.remarks' => SORT_DESC, 'fms_trans_master.remarks' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
            ],
        'defaultOrder' => ['trans_date' => SORT_DESC,'trans_type' => SORT_DESC,'serial_no' => SORT_DESC]
        ]);        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'against' => 2,
            'distributed_to_type' => 'Dealer',
        ]);

        $query->andFilterWhere([
            '>', 'cr_amount' , 0,
        ]);

        $query->andFilterWhere([
            'distribution_id' => $this->distribution_id,
            'trans_id' => $this->trans_id,
            'distributed_to_id' => $this->distributed_to_id,
            'dr_amount' => $this->dr_amount,
            'cr_amount' => $this->cr_amount,
        ]);

        $query->andFilterWhere(['like', 'distributed_to_type', $this->distributed_to_type])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
    
    public function searchledger($params)
    {
        $query = Fmstransdetaildist::find()->joinWith(['transaction']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            //'defaultOrder' => [
              //  ['action_code'=>SORT_ASC],
            //],
            'attributes' => [
                'serial_no' => [
                    'asc' => ['serial_no' => SORT_ASC, 'serial_no' => SORT_ASC],
                    'desc' => ['serial_no' => SORT_DESC, 'serial_no' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'trans_type' => [
                    'asc' => ['trans_type' => SORT_ASC, 'trans_type' => SORT_ASC],
                    'desc' => ['trans_type' => SORT_DESC, 'trans_type' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'trans_date' => [
                    'asc' => ['trans_date' => SORT_ASC, 'trans_date' => SORT_ASC],
                    'desc' => ['trans_date' => SORT_DESC, 'trans_date' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'name' => [
                    'asc' => ['members.name' => SORT_ASC, 'members.name' => SORT_ASC],
                    'desc' => ['members.name' => SORT_DESC, 'members.name' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'bank_title' => [
                    'asc' => ['bank_title' => SORT_ASC, 'bank_title' => SORT_ASC],
                    'desc' => ['bank_title' => SORT_DESC, 'bank_title' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'bank_trans_no' => [
                    'asc' => ['bank_trans_no' => SORT_ASC, 'bank_trans_no' => SORT_ASC],
                    'desc' => ['bank_trans_no' => SORT_DESC, 'bank_trans_no' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'cr_amount' => [
                    'asc' => ['cr_amount' => SORT_ASC, 'cr_amount' => SORT_ASC],
                    'desc' => ['cr_amount' => SORT_DESC, 'cr_amount' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'remarks' => [
                    'asc' => ['fms_trans_master.remarks' => SORT_ASC, 'fms_trans_master.remarks' => SORT_ASC],
                    'desc' => ['fms_trans_master.remarks' => SORT_DESC, 'fms_trans_master.remarks' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
            ],
        'defaultOrder' => ['trans_date' => SORT_DESC,'trans_type' => SORT_DESC,'serial_no' => SORT_DESC]
        ]);        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'against' => 2,
        ]);

        $query->andFilterWhere([
            '>', 'cr_amount' , 0,
        ]);

        $query->andFilterWhere([
            '!=', 'distributed_to_type' => 'Cash',
        ]);

        $query->andFilterWhere([
            '!=', 'distributed_to_type' => 'Bank',
        ]);

        $query->andFilterWhere([
            'distribution_id' => $this->distribution_id,
            'trans_id' => $this->trans_id,
            'distributed_to_id' => $this->distributed_to_id,
            'dr_amount' => $this->dr_amount,
            'cr_amount' => $this->cr_amount,
        ]);

        $query->andFilterWhere(['like', 'distributed_to_type', $this->distributed_to_type])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
