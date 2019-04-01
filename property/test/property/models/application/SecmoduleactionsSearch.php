<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Secmoduleactions;

/**
 * SecmoduleactionsSearch represents the model behind the search form about `app\modules\security\models\Secmoduleactions`.
 */
class SecmoduleactionsSearch extends Secmoduleactions
{
    public $controllerName;
    
    private $_module_id;

    public function getModule_id() {
        return $this->_module_id;
    }

    public function setModule_id($value) {
        $this->_module_id = $value;
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action_id', 'action_so','module_id','for_admin'], 'integer'],
            [['action_title', 'action_code','controllerName', 'module_id', 'controller_id','view_name'], 'safe'],
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
        $query = Secmoduleactions::find()->joinWith(['controller'])->joinWith('controller.module');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        
        $dataProvider->setSort([
            //'defaultOrder' => [
              //  ['action_code'=>SORT_ASC],
            //],
            'attributes' => [
                'controller_name' => [
                    'asc' => ['controller_name' => SORT_ASC, 'controller_name' => SORT_ASC],
                    'desc' => ['controller_name' => SORT_DESC, 'controller_name' => SORT_DESC],
                    'default' => SORT_ASC
                ],  
                'action_title' => [
                    'asc' => ['action_title' => SORT_ASC, 'action_title' => SORT_ASC],
                    'desc' => ['action_title' => SORT_DESC, 'action_title' => SORT_DESC],
                    'label' => 'Action',
                    'default' => SORT_ASC
                ],                
                'action_so' => [
                    'asc' => ['action_so' => SORT_ASC, 'action_so' => SORT_ASC],
                    'desc' => ['action_so' => SORT_DESC, 'action_so' => SORT_DESC],
                    'label' => 'Sort Order',
                    'default' => SORT_ASC
                ],                
                'action_code' => [
                    'asc' => ['action_code' => SORT_ASC, 'action_code' => SORT_ASC],
                    'desc' => ['action_code' => SORT_DESC, 'action_code' => SORT_DESC],
                    'label' => 'Code',
                    'default' => SORT_ASC
                ],                
                'module_title' => [
                    'asc' => ['module_title' => SORT_ASC, 'module_title' => SORT_ASC],
                    'desc' => ['module_title' => SORT_DESC, 'module_title' => SORT_DESC],
                    'label' => 'Module',
                    'default' => SORT_ASC
                ],                
                'view_name' => [
                    'asc' => ['view_name' => SORT_ASC, 'view_name' => SORT_ASC],
                    'desc' => ['view_name' => SORT_DESC, 'view_name' => SORT_DESC],
                    'label' => 'View',
                    'default' => SORT_ASC
                ],                
                'for_admin' => [
                    'asc' => ['for_admin' => SORT_ASC, 'for_admin' => SORT_ASC],
                    'desc' => ['for_admin' => SORT_DESC, 'for_admin' => SORT_DESC],
                    'label' => 'Admin',
                    'default' => SORT_ASC
                ],                
            ],
        'defaultOrder' => ['module_title' => SORT_ASC,'controller_name' => SORT_ASC,'action_title' => SORT_ASC]
        ]);        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'action_id' => $this->action_id,
            'sec_controller.controller_id' => $this->controller_id,
            //'module_id' => ($this->controller ==NULL ? 0 : $this->controller->module_id),
            'action_so' => $this->action_so,
            'for_admin' => $this->for_admin,
        ]);
        
        //print_r($this);
        if($this->module_id!=0)
        {
            $query->andFilterWhere([
                'sec_controller.module_id' => $this->module_id,
            ]);
            
            //echo "sdf";
        }

        $query->andFilterWhere(['like', 'action_title', $this->action_title])
            ->andFilterWhere(['=', 'action_code', $this->action_code]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchforscreen()
    {
        $query = Secmoduleactions::find()->joinWith(['controller']);//->joinWith(['controller.module']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder'=>[
                    //'module_title'=>SORT_ASC,
                    //'controllerName'=>SORT_ASC,
                    'action_title'=>SORT_ASC
                ],
            ],
        ]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
