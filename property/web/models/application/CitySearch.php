<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\City;

/**
 * CitySearch represents the model behind the search form about `app\modules\general\models\City`.
 */
class CitySearch extends City
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country_id'], 'integer'],
            [['city', 'zipcode'], 'safe'],
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
        $query = City::find()->joinWith(['country']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => ['city'=>SORT_ASC]
            ]
        ]);
        
        
        $dataProvider->setSort([
            'attributes' => [
                'city' => [
                    'asc' => ['city' => SORT_ASC, 'city' => SORT_ASC],
                    'desc' => ['city' => SORT_DESC, 'city' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'country' => [
                    'asc' => ['country' => SORT_ASC, 'country' => SORT_ASC],
                    'desc' => ['country' => SORT_DESC, 'country' => SORT_DESC],
                    'label' => 'Country',
                    'default' => SORT_ASC
                ],                
                'zipcode' => [
                    'asc' => ['zipcode' => SORT_ASC, 'zipcode' => SORT_ASC],
                    'desc' => ['zipcode' => SORT_DESC, 'zipcode' => SORT_DESC],
                    'label' => 'Zip Code',
                    'default' => SORT_ASC
                ],                
            ],
            'defaultOrder' => ['city' => SORT_ASC]
        ]);        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'country_id' => $this->country_id,
			
        ]);

        $query->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
