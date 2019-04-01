<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Seccontroller;

/**
 * SeccontrollerSearch represents the model behind the search form about `app\modules\security\models\Seccontroller`.
 */
class SeccontrollerSearch extends Seccontroller
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['controller_id', 'module_id', 'sort_order'], 'integer'],
            [['controller_code', 'controller_name'], 'safe'],
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
        $query = Seccontroller::find()->joinWith('module');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
                //'defaultOrder' => ['module_title' => SORT_ASC,'controller_name' => SORT_ASC]
            //]
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'controller_name' => [
                    'asc' => ['controller_name' => SORT_ASC, 'controller_name' => SORT_ASC],
                    'desc' => ['controller_name' => SORT_DESC, 'controller_name' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'controller_code' => [
                    'asc' => ['controller_code' => SORT_ASC, 'controller_code' => SORT_ASC],
                    'desc' => ['controller_code' => SORT_DESC, 'controller_code' => SORT_DESC],
                    'label' => 'Code',
                    'default' => SORT_ASC
                ],                
                'sort_order' => [
                    'asc' => ['sort_order' => SORT_ASC, 'sort_order' => SORT_ASC],
                    'desc' => ['sort_order' => SORT_DESC, 'sort_order' => SORT_DESC],
                    'label' => 'Sort Order',
                    'default' => SORT_ASC
                ],                
                'module_title' => [
                    'asc' => ['module_title' => SORT_ASC, 'module_title' => SORT_ASC],
                    'desc' => ['module_title' => SORT_DESC, 'module_title' => SORT_DESC],
                    'label' => 'Module',
                    'default' => SORT_ASC
                ],                
            ],
        'defaultOrder' => ['module_title' => SORT_ASC,'controller_name' => SORT_ASC]
        ]);        
        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'controller_id' => $this->controller_id,
            'sec_controller.module_id' => $this->module_id,
            'sec_controller.sort_order' => $this->sort_order,
        ]);

        $query->andFilterWhere(['like', 'controller_code', $this->controller_code])
            ->andFilterWhere(['like', 'controller_name', $this->controller_name]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
