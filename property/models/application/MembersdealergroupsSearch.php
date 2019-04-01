<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Membersdealergroups;

/**
 * MembersdealergroupsSearch represents the model behind the search form about `app\models\application\Membersdealergroups`.
 */
class MembersdealergroupsSearch extends Membersdealergroups
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'default_dealer'], 'integer'],
            [['group_title'], 'safe'],
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
        $query = Membersdealergroups::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        
        
        $query->andFilterWhere([
            'group_for' => 1,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'group_id' => $this->group_id,
            'default_dealer' => $this->default_dealer,
        ]);

        $query->andFilterWhere(['like', 'group_title', $this->group_title]);

        return $dataProvider;
    }
    
    public function searchfamilies($params)
    {
        $query = Membersdealergroups::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        
        $query->andFilterWhere([
            'group_for' => 2,
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'group_id' => $this->group_id,
            'default_dealer' => $this->default_dealer,
        ]);

        $query->andFilterWhere(['like', 'group_title', $this->group_title]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
