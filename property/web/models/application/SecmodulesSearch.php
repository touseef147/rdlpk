<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Secmodules;

/**
 * SecmodulesSearch represents the model behind the search form about `app\modules\security\models\Secmodules`.
 */
class SecmodulesSearch extends Secmodules
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id', 'module_so', 'parent_module_id', 'for_reports'], 'integer'],
            [['module_title','module_code'], 'safe'],
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
        $query = Secmodules::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            //]
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'module_title' => [
                    'asc' => ['module_title' => SORT_ASC, 'module_title' => SORT_ASC],
                    'desc' => ['module_title' => SORT_DESC, 'module_title' => SORT_DESC],
                    'label' => 'Module',
                    'default' => SORT_ASC
                ],  
                'module_code' => [
                    'asc' => ['module_code' => SORT_ASC, 'module_code' => SORT_ASC],
                    'desc' => ['module_code' => SORT_DESC, 'module_code' => SORT_DESC],
                    'label' => 'Code',
                    'default' => SORT_ASC
                ],                
                'module_so' => [
                    'asc' => ['module_so' => SORT_ASC, 'module_so' => SORT_ASC],
                    'desc' => ['module_so' => SORT_DESC, 'module_so' => SORT_DESC],
                    'label' => 'Sort Order',
                    'default' => SORT_ASC
                ],                
            ],
        'defaultOrder' => ['module_title' => SORT_ASC]
        ]);        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'module_id' => $this->module_id,
            'module_so' => $this->module_so,
            'parent_module_id' => $this->parent_module_id,
            'for_reports' => $this->for_reports,
        ]);

        $query->andFilterWhere(['like', 'module_title', $this->module_title]);
        $query->andFilterWhere(['like', 'module_code', $this->module_code]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
