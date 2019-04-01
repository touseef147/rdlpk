<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Secrolecategory;

/**
 * SecrolecategorySearch represents the model behind the search form about `app\modules\security\models\Secrolecategory`.
 */
class SecrolecategorySearch extends Secrolecategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_category_id', 'role_category_so'], 'integer'],
            [['role_category_name'], 'safe'],
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
        $query = Secrolecategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort' => [
              //          'defaultOrder' => ['role_category_so'=>SORT_ASC,'role_category_name'=>SORT_ASC]
           // ]
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'role_category_name' => [
                    'asc' => ['role_category_name' => SORT_ASC, 'role_category_name' => SORT_ASC],
                    'desc' => ['role_category_name' => SORT_DESC, 'role_category_name' => SORT_DESC],
                    'label' => 'Title',
                    'default' => SORT_ASC
                ],  
                'role_category_so' => [
                    'asc' => ['role_category_so' => SORT_ASC, 'role_category_so' => SORT_ASC],
                    'desc' => ['role_category_so' => SORT_DESC, 'role_category_so' => SORT_DESC],
                    'label' => 'Sort Order',
                    'default' => SORT_ASC
                ],                
            ],
        'defaultOrder' => ['role_category_name' => SORT_ASC]
        ]);        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'sec_role_category.role_category_id' => $this->role_category_id,
            'role_category_so' => $this->role_category_so,
        ]);

        $query->andFilterWhere(['like', 'role_category_name', $this->role_category_name]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
