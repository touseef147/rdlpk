<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Secroletypes;

/**
 * SecroletypesSearch represents the model behind the search form about `app\modules\security\models\Secroletypes`.
 */
class SecroletypesSearch extends Secroletypes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_type_id', 'role_type_so'], 'integer'],
            [['role_type_name'], 'safe'],
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
        $query = Secroletypes::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
              //          'defaultOrder' => ['role_type_so'=>SORT_ASC,'role_type_name'=>SORT_ASC]
            //]
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'role_type_name' => [
                    'asc' => ['role_type_name' => SORT_ASC, 'role_type_name' => SORT_ASC],
                    'desc' => ['role_type_name' => SORT_DESC, 'role_type_name' => SORT_DESC],
                    'label' => 'Role Type',
                    'default' => SORT_ASC
                ],                
                'role_type_so' => [
                    'asc' => ['role_type_so' => SORT_ASC, 'role_type_so' => SORT_ASC],
                    'desc' => ['role_type_so' => SORT_DESC, 'role_type_so' => SORT_DESC],
                    'label' => 'Sort Order',
                    'default' => SORT_ASC
                ],                
            ],
        'defaultOrder' => ['role_type_name' => SORT_ASC]
        ]);        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'role_type_id' => $this->role_type_id,
            'role_type_so' => $this->role_type_so,
        ]);

        $query->andFilterWhere(['like', 'role_type_name', $this->role_type_name]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
