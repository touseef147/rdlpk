<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Propertyapplication;

/**
 * PropertyapplicationSearch represents the model behind the search form about `app\modules\finance\models\Propertyapplication`.
 */
class PropertyapplicationSearch extends Propertyapplication
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application_id', 'project_id', 'sales_center_id', 'member_id', 'property_type', 'property_size', 'dealer_id', 'nominee_id', 'voucher_id','property_against'], 'integer'],
            [['application_no','application_date'], 'safe'],
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
        $query = Propertyapplication::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);
        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'application_id' => $this->application_id,
            'project_id' => $this->project_id,
            'sales_center_id' => $this->sales_center_id,
            'member_id' => $this->member_id,
            'property_type' => $this->property_type,
            'property_size' => $this->property_size,
            'dealer_id' => $this->dealer_id,
            'nominee_id' => $this->nominee_id,
            'voucher_id' => $this->voucher_id,
            'property_against' => $this->property_against,
        ]);

        $query->andFilterWhere(['like', 'application_no', $this->application_no]);
//        $query->andFilterWhere(['application_date', $this->application_date]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
