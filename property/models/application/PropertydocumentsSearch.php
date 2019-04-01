<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Propertydocuments;

/**
 * PropertydocumentsSearch represents the model behind the search form about `app\models\application\Propertydocuments`.
 */
class PropertydocumentsSearch extends Propertydocuments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['document_id', 'category_id', 'project_id', 'sales_center_id', 'membership_id', 'entered_by', 'application_id', 'plot_id'], 'integer'],
            [['title', 'file_name', 'remarks', 'entry_date'], 'safe'],
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
        $query = Propertydocuments::find();

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
            'document_id' => $this->document_id,
            'category_id' => $this->category_id,
            'project_id' => $this->project_id,
            'sales_center_id' => $this->sales_center_id,
            'membership_id' => $this->membership_id,
            'entered_by' => $this->entered_by,
           // 'entry_date' => $this->entry_date,
            'application_id' => $this->application_id,
            'plot_id' => $this->plot_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'file_name', $this->file_name])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
