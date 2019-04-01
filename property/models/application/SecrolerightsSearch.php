<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Secrolerights;

/**
 * SecrolerightsSearch represents the model behind the search form about `app\modules\security\models\Secrolerights`.
 */
class SecrolerightsSearch extends Secrolerights
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['right_id', 'role_id', 'action_id', 'right_status'], 'integer'],
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
        $query = Secrolerights::find()->joinWith(['role'])->joinWith(['action'])->joinWith(['action.controller'])->joinWith(['action.controller.module']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            //]
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'role_name' => [
                    'asc' => ['role_name' => SORT_ASC, 'role_name' => SORT_ASC],
                    'desc' => ['role_name' => SORT_DESC, 'role_name' => SORT_DESC],
                    'label' => 'Role',
                    'default' => SORT_ASC
                ],  
                'action_title' => [
                    'asc' => ['action_title' => SORT_ASC, 'action_title' => SORT_ASC],
                    'desc' => ['action_title' => SORT_DESC, 'action_title' => SORT_DESC],
                    'label' => 'Action',
                    'default' => SORT_ASC
                ],                
                'module_title' => [
                    'asc' => ['module_title' => SORT_ASC, 'module_title' => SORT_ASC],
                    'desc' => ['module_title' => SORT_DESC, 'module_title' => SORT_DESC],
                    'label' => 'Module',
                    'default' => SORT_ASC
                ],                
                'controller_name' => [
                    'asc' => ['controller_name' => SORT_ASC, 'controller_name' => SORT_ASC],
                    'desc' => ['controller_name' => SORT_DESC, 'controller_name' => SORT_DESC],
                    'label' => 'Controller',
                    'default' => SORT_ASC
                ],                
                'right_status' => [
                    'asc' => ['right_status' => SORT_ASC, 'right_status' => SORT_ASC],
                    'desc' => ['right_status' => SORT_DESC, 'right_status' => SORT_DESC],
                    'label' => 'Status',
                    'default' => SORT_ASC
                ],                
            ],
        'defaultOrder' => ['module_title' => SORT_ASC, 'controller_name' => SORT_ASC, 'action_title' => SORT_ASC,'role_name' => SORT_ASC]
        ]);        
        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'right_id' => $this->right_id,
            'sec_role_rights.role_id' => $this->role_id,
            'action_id' => $this->action_id,
            'right_status' => $this->right_status,
        ]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
