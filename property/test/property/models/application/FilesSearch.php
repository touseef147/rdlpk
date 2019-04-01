<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Plots;

/**
 * PlotsSearch represents the model behind the search form about `app\modules\propertyconfig\models\Plots`.
 */
class FilesSearch extends Plots {

    private $_plotno;
    private $_msstatus;

    public function getPlotno() {
        return $this->_plotno;
    }

    public function setPlotno($value) {
        $this->_plotno = $value;
    }

    public function getMsstatus() {
        return $this->_msstatus;
    }

    public function setMsstatus($value) {
        $this->_msstatus = $value;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'project_id', 'installment', 'category_id', 'shap_id', 'msstatus'], 'integer'],
            [['type', 'street_id', 'plot_detail_address', 'plot_size', 'size2', 'price', 'plotno', 'create_date', 'modify_date', 'com_res', 'sector', 'image', 'cstatus', 'status', 'fstatus', 'rstatus', 'bstatus', 'bid', 'atype', 'rownumber'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Plots::find()->joinWith("project")->joinWith("street")->joinWith("sizeCat")->joinwith("currentmembership");

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
            'id' => $this->id,
            'streets.project_id' => $this->project_id,
            'plots.size2' => $this->size2,
//			  'plots.status' => $this->status,
//			  'plot_detail_address' => $this->plot_detail_address,
            'installment' => $this->installment,
            'create_date' => $this->create_date,
            'modify_date' => $this->modify_date,
            'category_id' => $this->category_id,
            'shap_id' => $this->shap_id,
        ]);

        $query->andFilterWhere(['=', 'type', 'file'])
                ->andFilterWhere(['like', 'street_id', $this->street_id])
                ->andFilterWhere(['like', 'plot_detail_address', $this->plot_detail_address])
                ->andFilterWhere(['like', 'plot_size', $this->plot_size])
                ->andFilterWhere(['like', 'size2', $this->size2])
                ->andFilterWhere(['like', 'price', $this->price])
                ->andFilterWhere(['like', 'com_res', $this->com_res])
                ->andFilterWhere(['like', 'sector', $this->sector])
                ->andFilterWhere(['like', 'image', $this->image])
                ->andFilterWhere(['like', 'cstatus', $this->cstatus])
                ->andFilterWhere(['like', 'fstatus', $this->fstatus])
                ->andFilterWhere(['like', 'rstatus', $this->rstatus])
                ->andFilterWhere(['like', 'bstatus', $this->bstatus])
                ->andFilterWhere(['like', 'bid', $this->bid])
                ->andFilterWhere(['like', 'atype', $this->atype])
//                ->andFilterWhere(['like', 'status', $this->status])

//		  ->andFilterWhere(['like', 'plotno', $this->status])
                ->andFilterWhere(['like', 'rownumber', $this->rownumber]);

        if ($this->plotno != null && $this->plotno != "") {
            $query->andFilterWhere([
                'like', 'property_memberships.ms_no', $this->plotno
            ]);
            //echo $this->plotno;
            //print_r($query);
        }

        if ($this->msstatus != null && $this->msstatus != 0) {
            $query->andFilterWhere([
                'property_memberships.ms_status' => $this->msstatus
            ]);
        }

        return $dataProvider;
    }

    public function loadparams($params) {
        $this->load($params);
    }

}
