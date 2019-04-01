<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Installpayment;

/**
 * InstallpaymentSearch represents the model behind the search form about `app\modules\finance\models\Installpayment`.
 */
class InstallpaymentSearch extends Installpayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ref', 'fid', 'voucher_plot_detail_id', 'trans_type'], 'integer'],
            [['plot_id', 'payment_type', 'paidamount', 'dueamount', 'discount', 'surcharge', 'lab', 'paidsurcharge', 'mem_id', 'paidas', 'detail', 'date', 'remarks', 'others', 'due_date', 'paid_date', 'fstatus'], 'safe'],
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
        $query = Installpayment::find();

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
            'ref' => $this->ref,
            'fid' => $this->fid,
            'voucher_plot_detail_id' => $this->voucher_plot_detail_id,
            'trans_type' => $this->trans_type,
        ]);

        $query->andFilterWhere(['like', 'plot_id', $this->plot_id])
            ->andFilterWhere(['like', 'payment_type', $this->payment_type])
            ->andFilterWhere(['like', 'paidamount', $this->paidamount])
            ->andFilterWhere(['like', 'dueamount', $this->dueamount])
            ->andFilterWhere(['like', 'discount', $this->discount])
            ->andFilterWhere(['like', 'surcharge', $this->surcharge])
            ->andFilterWhere(['like', 'lab', $this->lab])
            ->andFilterWhere(['like', 'paidsurcharge', $this->paidsurcharge])
            ->andFilterWhere(['like', 'mem_id', $this->mem_id])
            ->andFilterWhere(['like', 'paidas', $this->paidas])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'others', $this->others])
            ->andFilterWhere(['like', 'due_date', $this->due_date])
            ->andFilterWhere(['like', 'paid_date', $this->paid_date])
            ->andFilterWhere(['like', 'fstatus', $this->fstatus]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
