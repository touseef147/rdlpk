<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Secroles;

/**
 * SecrolesSearch represents the model behind the search form about `app\modules\security\models\Secroles`.
 */
class SecrolesSearch extends Secroles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'role_type_id', 'role_category_id', 'role_so'], 'integer'],
            [['role_name'], 'safe'],
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
        $query = Secroles::find()->joinWith(['roleType'])->joinWith(['roleCategory']);
//print_r($query);
//return;
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        
        
        $dataProvider->setSort([
            'attributes' => [
                'role_category_name' => [
                    'asc' => ['role_category_name' => SORT_ASC, 'role_category_name' => SORT_ASC],
                    'desc' => ['role_category_name' => SORT_DESC, 'role_category_name' => SORT_DESC],
                    'label' => 'Role Category',
                    'default' => SORT_ASC
                ],  
                'role_type_name' => [
                    'asc' => ['role_type_name' => SORT_ASC, 'role_type_name' => SORT_ASC],
                    'desc' => ['role_type_name' => SORT_DESC, 'role_type_name' => SORT_DESC],
                    'label' => 'Role Type',
                    'default' => SORT_ASC
                ],                
                'role_name' => [
                    'asc' => ['role_name' => SORT_ASC, 'role_name' => SORT_ASC],
                    'desc' => ['role_name' => SORT_DESC, 'role_name' => SORT_DESC],
                    'label' => 'Role',
                    'default' => SORT_ASC
                ],                
                'role_so' => [
                    'asc' => ['role_so' => SORT_ASC, 'role_so' => SORT_ASC],
                    'desc' => ['role_so' => SORT_DESC, 'role_so' => SORT_DESC],
                    'label' => 'Sort Order',
                    'default' => SORT_ASC
                ],                
            ],
        'defaultOrder' => ['role_category_name' => SORT_ASC,'role_type_name' => SORT_ASC,'role_name' => SORT_ASC]
        ]);        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'role_id' => $this->role_id,
            'sec_roles.role_type_id' => $this->role_type_id,
            'sec_role_category.role_category_id' => $this->role_category_id,
            'role_so' => $this->role_so,
        ]);

        $query->andFilterWhere(['like', 'role_name', $this->role_name]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
