<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Fmsvoucherplotdetail;

/**
 * FmsvoucherplotdetailSearch represents the model behind the search form about `app\models\application\Fmsvoucherplotdetail`.
 */
class FmsvoucherplotdetailSearch extends Fmsvoucherplotdetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['voucher_plot_detail_id', 'voucher_id', 'member_id', 'plot_id', 'membership_id', 'serial_no'], 'integer'],
            [['amount', 'project_id'], 'number'],
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
        $query = Fmsvoucherplotdetail::find();

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
            'voucher_plot_detail_id' => $this->voucher_plot_detail_id,
            'voucher_id' => $this->voucher_id,
            'member_id' => $this->member_id,
            'plot_id' => $this->plot_id,
            'membership_id' => $this->membership_id,
            'serial_no' => $this->serial_no,
            'amount' => $this->amount,
            'project_id' => $this->project_id,
        ]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
