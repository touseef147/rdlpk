<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Propertymemberships;

/**
 * PropertymembershipsSearch represents the model behind the search form about `app\models\application\Propertymemberships`.
 */
class PropertymembershipsSearch extends Propertymemberships
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ms_id', 'plot_id', 'member_id', 'ms_status', 'is_joint', 'parent_ms_id', 'user_id', 'is_active'], 'integer'],
            [['ms_no', 'created_on', 'modified_on'], 'safe'],
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
        $query = Propertymemberships::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        
        $query->andWhere('ifnull(parent_ms_id,0) = 0');
//        $query->andFilterWhere([
//            'parent_ms_id' => 0,
//            ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ms_id' => $this->ms_id,
            'plot_id' => $this->plot_id,
            'member_id' => $this->member_id,
            'ms_status' => $this->ms_status,
            'created_on' => $this->created_on,
            'modified_on' => $this->modified_on,
            'is_joint' => $this->is_joint,
            'parent_ms_id' => $this->parent_ms_id,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'ms_no', $this->ms_no]);

        return $dataProvider;
    }
    
    public function searchtransfers($params)
    {
        $query = Propertymemberships::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        
        $query->andWhere('ifnull(parent_ms_id,0) > 0');
        //$query->andFilterWhere(['!=', 'parent_ms_id', 0]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ms_id' => $this->ms_id,
            'plot_id' => $this->plot_id,
            'member_id' => $this->member_id,
            'ms_status' => $this->ms_status,
            'created_on' => $this->created_on,
            'modified_on' => $this->modified_on,
            'is_joint' => $this->is_joint,
            'parent_ms_id' => $this->parent_ms_id,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'ms_no', $this->ms_no]);

        return $dataProvider;
    }
    
    public function searchmemberships($params)
    {
        $query = Propertymemberships::find()->innerJoinWith("currentmembership");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        
//        $query->andWhere('ifnull(parent_ms_id,0) > 0');
        //$query->andFilterWhere(['!=', 'parent_ms_id', 0]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ms_id' => $this->ms_id,
            'plot_id' => $this->plot_id,
            'member_id' => $this->member_id,
            'ms_status' => $this->ms_status,
            'created_on' => $this->created_on,
            'modified_on' => $this->modified_on,
            'is_joint' => $this->is_joint,
            'parent_ms_id' => $this->parent_ms_id,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'ms_no', $this->ms_no]);

        return $dataProvider;
    }
    
    public function searchfinanceverification($params)
    {
        $query = Propertymemberships::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        
//        $query->andWhere('ifnull(parent_ms_id,0) > 0');
        $query->andFilterWhere(['=', 'ms_status', 2]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ms_id' => $this->ms_id,
            'plot_id' => $this->plot_id,
            'member_id' => $this->member_id,
            'ms_status' => $this->ms_status,
            'created_on' => $this->created_on,
            'modified_on' => $this->modified_on,
            'is_joint' => $this->is_joint,
            'parent_ms_id' => $this->parent_ms_id,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'ms_no', $this->ms_no]);

        return $dataProvider;
    }
    
    public function searchapproval($params)
    {
        $query = Propertymemberships::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        
//        $query->andWhere('ifnull(parent_ms_id,0) > 0');
        $query->andFilterWhere(['=', 'ms_status', 3]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ms_id' => $this->ms_id,
            'plot_id' => $this->plot_id,
            'member_id' => $this->member_id,
            'ms_status' => $this->ms_status,
            'created_on' => $this->created_on,
            'modified_on' => $this->modified_on,
            'is_joint' => $this->is_joint,
            'parent_ms_id' => $this->parent_ms_id,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'ms_no', $this->ms_no]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
