<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Fmsvoucher;

/**
 * FmsvoucherSearch represents the model behind the search form about `app\modules\finance\models\Fmsvoucher`.
 */
class FmsvoucherSearch extends Fmsvoucher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['voucher_id', 'bank_id', 'sales_center_id','entry_status','project_id'], 'integer'],
            [['entry_date', 'transaction_date', 'voucher_sr_no', 'folio_no','narration'], 'safe'],
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
        $query = Fmsvoucher::find();

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
            'voucher_id' => $this->voucher_id,
            'bank_id' => $this->bank_id,
            'entry_date' => $this->entry_date,
            'transaction_date' => $this->transaction_date,
            'sales_center_id' => $this->sales_center_id,
            'project_id' => $this->project_id,
            'entry_status' => $this->entry_status,
        ]);

        $query->andFilterWhere(['like', 'voucher_sr_no', $this->voucher_sr_no])
            ->andFilterWhere(['like', 'folio_no', $this->folio_no])
            ->andFilterWhere(['like', 'narration', $this->narration]);

        return $dataProvider;
    }
    
    public function searchcenterverification($params)
    {
        $query = Fmsvoucher::find()->innerJoinWith('salescenter')->innerJoinWith('salescenter.permissions');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        
        $query->andFilterWhere([
            'entry_status' => 2
        ]);

            
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'voucher_id' => $this->voucher_id,
            'bank_id' => $this->bank_id,
            'entry_date' => $this->entry_date,
            'transaction_date' => $this->transaction_date,
            'sales_center_id' => $this->sales_center_id,
            'entry_status' => $this->entry_status,
        ]);

        $query->andFilterWhere(['like', 'voucher_sr_no', $this->voucher_sr_no])
            ->andFilterWhere(['like', 'folio_no', $this->folio_no])
            ->andFilterWhere(['like', 'narration', $this->narration]);

        return $dataProvider;
    }
    
    public function searchfinanceverification($params)
    {
        $query = Fmsvoucher::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        
        $query->andFilterWhere([
            'entry_status' => 3
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'voucher_id' => $this->voucher_id,
            'bank_id' => $this->bank_id,
            'entry_date' => $this->entry_date,
            'transaction_date' => $this->transaction_date,
            'sales_center_id' => $this->sales_center_id,
            'entry_status' => $this->entry_status,
        ]);

        $query->andFilterWhere(['like', 'voucher_sr_no', $this->voucher_sr_no])
            ->andFilterWhere(['like', 'folio_no', $this->folio_no])
            ->andFilterWhere(['like', 'narration', $this->narration]);

        return $dataProvider;
    }
    
    public function searchfinanceapproval($params)
    {
        $query = Fmsvoucher::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        
        $query->andFilterWhere([
            'entry_status' => 4
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'voucher_id' => $this->voucher_id,
            'bank_id' => $this->bank_id,
            'entry_date' => $this->entry_date,
            'transaction_date' => $this->transaction_date,
            'sales_center_id' => $this->sales_center_id,
            'entry_status' => $this->entry_status,
        ]);

        $query->andFilterWhere(['like', 'voucher_sr_no', $this->voucher_sr_no])
            ->andFilterWhere(['like', 'folio_no', $this->folio_no])
            ->andFilterWhere(['like', 'narration', $this->narration]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
