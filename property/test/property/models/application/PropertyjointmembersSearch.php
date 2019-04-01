<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Propertyjointmembers;

/**
 * PropertyjointmembersSearch represents the model behind the search form about `app\models\application\Propertyjointmembers`.
 */
class PropertyjointmembersSearch extends Propertyjointmembers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['joint_ms_id', 'membership_id', 'plot_id', 'member_id'], 'integer'],
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
        $query = Propertyjointmembers::find();

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
            'joint_ms_id' => $this->joint_ms_id,
            'member_status' => $this->member_status,
            'membership_id' => $this->membership_id,
            'plot_id' => $this->plot_id,
            'member_id' => $this->member_id,
        ]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
