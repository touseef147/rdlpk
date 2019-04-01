<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Propertytransferfees;

/**
 * PropertytransferfeesSearch represents the model behind the search form about `app\models\application\Propertytransferfees`.
 */
class PropertytransferfeesSearch extends Propertytransferfees
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transfer_fee_id', 'project_id', 'plot_size'], 'integer'],
            [['amount'], 'number'],
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
        $query = Propertytransferfees::find();

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
            'transfer_fee_id' => $this->transfer_fee_id,
            'project_id' => $this->project_id,
            'plot_size' => $this->plot_size,
            'amount' => $this->amount,
        ]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
