<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Sectargetscreens;

/**
 * SectargetscreensSearch represents the model behind the search form about `app\modules\security\models\Sectargetscreens`.
 */
class SectargetscreensSearch extends Sectargetscreens
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['target_id', 'parent_screen_id', 'target_screen_id', 'status'], 'integer'],
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
        $query = Sectargetscreens::find();

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
            'target_id' => $this->target_id,
            'parent_screen_id' => $this->parent_screen_id,
            'target_screen_id' => $this->target_screen_id,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
    
    public function loadparams($params)
    {
        $this->load($params);
    }
}
