<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\Members;

/**
 * MembersSearch represents the model behind the search form about `app\modules\members\models\Members`.
 */
class MembersSearch extends Members {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['name', 'mem_id', 'username', 'sodowo', 'cnic', 'image', 'address', 'city_id', 'phone', 'email', 'country_id', 'state', 'rwa', 'password', 'status', 'fp', 'login_status', 'user_id', 'create_date', 'modify_date', 'dob', 'RFM'], 'safe'],
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
        $query = Members::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
            //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
            //'defaultOrder' => [$columns=>SORT_ASC]
            ]
        ]);


//        $query->andFilterWhere([
//            'or', 
//                ['=', 'parent_id', 'NULL'], 
//                ['=', 'parent_id', '0']
//        ]);

        $query->andWhere([
            'or', 
                ['parent_id' => NULL], 
                ['parent_id' => '0']
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'mem_id', $this->mem_id])
                ->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'sodowo', $this->sodowo])
                ->andFilterWhere(['like', 'cnic', $this->cnic])
                ->andFilterWhere(['like', 'image', $this->image])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'city_id', $this->city_id])
                ->andFilterWhere(['like', 'phone', $this->phone])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'country_id', $this->country_id])
                ->andFilterWhere(['like', 'state', $this->state])
                ->andFilterWhere(['like', 'rwa', $this->rwa])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andFilterWhere(['like', 'fp', $this->fp])
                ->andFilterWhere(['like', 'login_status', $this->login_status])
                ->andFilterWhere(['like', 'user_id', $this->user_id])
                ->andFilterWhere(['like', 'create_date', $this->create_date])
                ->andFilterWhere(['like', 'modify_date', $this->modify_date])
                ->andFilterWhere(['like', 'dob', $this->dob])
                ->andFilterWhere(['like', 'RFM', $this->RFM]);

        return $dataProvider;
    }

    public function searchdealers($params) {
        $query = Members::find();

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
        ]);

        $query->andFilterWhere([
            'is_dealer' => 1,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'mem_id', $this->mem_id])
                ->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'sodowo', $this->sodowo])
                ->andFilterWhere(['like', 'cnic', $this->cnic])
                ->andFilterWhere(['like', 'image', $this->image])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'city_id', $this->city_id])
                ->andFilterWhere(['like', 'phone', $this->phone])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'country_id', $this->country_id])
                ->andFilterWhere(['like', 'state', $this->state])
                ->andFilterWhere(['like', 'rwa', $this->rwa])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andFilterWhere(['like', 'fp', $this->fp])
                ->andFilterWhere(['like', 'login_status', $this->login_status])
                ->andFilterWhere(['like', 'user_id', $this->user_id])
                ->andFilterWhere(['like', 'create_date', $this->create_date])
                ->andFilterWhere(['like', 'modify_date', $this->modify_date])
                ->andFilterWhere(['like', 'dob', $this->dob])
                ->andFilterWhere(['like', 'RFM', $this->RFM]);

        return $dataProvider;
    }

    public function searchowners($params) {
        $query = Members::find();

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
        ]);

        $query->andFilterWhere([
            'is_owner' => 1,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'mem_id', $this->mem_id])
                ->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'sodowo', $this->sodowo])
                ->andFilterWhere(['like', 'cnic', $this->cnic])
                ->andFilterWhere(['like', 'image', $this->image])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'city_id', $this->city_id])
                ->andFilterWhere(['like', 'phone', $this->phone])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'country_id', $this->country_id])
                ->andFilterWhere(['like', 'state', $this->state])
                ->andFilterWhere(['like', 'rwa', $this->rwa])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andFilterWhere(['like', 'fp', $this->fp])
                ->andFilterWhere(['like', 'login_status', $this->login_status])
                ->andFilterWhere(['like', 'user_id', $this->user_id])
                ->andFilterWhere(['like', 'create_date', $this->create_date])
                ->andFilterWhere(['like', 'modify_date', $this->modify_date])
                ->andFilterWhere(['like', 'dob', $this->dob])
                ->andFilterWhere(['like', 'RFM', $this->RFM]);

        return $dataProvider;
    }

    public function loadparams($params) {
        $this->load($params);
    }

}
