<?php

namespace app\models\application;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\application\User;

/**
 * UserSearch represents the model behind the search form about `app\modules\security\models\User`.
 */
class UserSearch extends User
{
    private $_fullname;
    
    public function getFullname()
    {
        return $this->firstname." ".$this->middelname." ".$this->lastname;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'per12', 'per13', 'per14', 'per15', 'per16', 'per17'], 'integer'],
            [['person_name', 'pic', 'sodowo', 'cnic', 'address', 'city', 'email', 'state', 'zip', 'country', 'mobile', 'username', 'password', 'per1', 'per2', 'per3', 'per4', 'per5', 'per6', 'per7', 'per8', 'per9', 'per10', 'per11', 'status', 'fp', 'login_status', 'user_id', 'create_date', 'modify_date'], 'safe'],
    //        [['fullname','safe']]
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort' => [
                        //'attributes' => [$columns],             /* format: 'role_type_name', 'role_type_so' */
                        //'defaultOrder' => [$columns=>SORT_ASC]
            //]
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'person_name' => [
                    'asc' => ['person_name' => SORT_ASC, 'person_name' => SORT_ASC],
                    'desc' => ['person_name' => SORT_DESC, 'person_name' => SORT_DESC],
                    'label' => 'Name',
                    'default' => SORT_ASC
                ],                
                'pic' => [
                    'asc' => ['pic' => SORT_ASC, 'pic' => SORT_ASC],
                    'desc' => ['pic' => SORT_DESC, 'pic' => SORT_DESC],
                    'label' => 'Picture',
                    'default' => SORT_ASC
                ],                
                'sodowo' => [
                    'asc' => ['sodowo' => SORT_ASC, 'sodowo' => SORT_ASC],
                    'desc' => ['sodowo' => SORT_DESC, 'sodowo' => SORT_DESC],
                    'label' => 'S/o D/o',
                    'default' => SORT_ASC
                ],                
                'username' => [
                    'asc' => ['username' => SORT_ASC, 'username' => SORT_ASC],
                    'desc' => ['username' => SORT_DESC, 'username' => SORT_DESC],
                    'label' => 'User Name',
                    'default' => SORT_ASC
                ],                
                'status' => [
                    'asc' => ['status' => SORT_ASC, 'status' => SORT_ASC],
                    'desc' => ['status' => SORT_DESC, 'status' => SORT_DESC],
                    'label' => 'Status',
                    'default' => SORT_ASC
                ],                
                'create_date' => [
                    'asc' => ['create_date' => SORT_ASC, 'create_date' => SORT_ASC],
                    'desc' => ['create_date' => SORT_DESC, 'create_date' => SORT_DESC],
                    'label' => 'Date Created',
                    'default' => SORT_ASC
                ],                
            ],
        'defaultOrder' => ['person_name' => SORT_ASC]
        ]);        
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'per12' => $this->per12,
            'per13' => $this->per13,
            'per14' => $this->per14,
            'per15' => $this->per15,
            'per16' => $this->per16,
            'per17' => $this->per17,
        ]);

        $query->andFilterWhere(['like', 'person_name', $this->person_name])
            ->andFilterWhere(['like', 'pic', $this->pic])
            ->andFilterWhere(['like', 'sodowo', $this->sodowo])
            ->andFilterWhere(['like', 'cnic', $this->cnic])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'per1', $this->per1])
            ->andFilterWhere(['like', 'per2', $this->per2])
            ->andFilterWhere(['like', 'per3', $this->per3])
            ->andFilterWhere(['like', 'per4', $this->per4])
            ->andFilterWhere(['like', 'per5', $this->per5])
            ->andFilterWhere(['like', 'per6', $this->per6])
            ->andFilterWhere(['like', 'per7', $this->per7])
            ->andFilterWhere(['like', 'per8', $this->per8])
            ->andFilterWhere(['like', 'per9', $this->per9])
            ->andFilterWhere(['like', 'per10', $this->per10])
            ->andFilterWhere(['like', 'per11', $this->per11])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'fp', $this->fp])
            ->andFilterWhere(['like', 'login_status', $this->login_status])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'modify_date', $this->modify_date]);

        return $dataProvider;
    }
    
    public function projuserlist($byid=0, $byproject=0) {
        $rowcrit = "";

        /*if ($rowcrit == "")
        {
            $rowcrit = " where centers_permissions.user_id=" . $_SESSION["user_array"]["id"];
        }
        else
        {
            $rowcrit.=" and centers_permissions.user_id=" . $_SESSION["user_array"]["id"];
        }*/
        
        if ($byid > 0) {
            if ($rowcrit == "")
            {
                $rowcrit = " where user.id=" . $byid;
            }
            else
            {
                $rowcrit.=" and user.id=" . $byid;
            }
        }
        
        if ($byproject > 0) {
            if ($rowcrit == "")
            {
                $rowcrit = " where project_permissions.project_id=" . $byproject;
            }
            else
            {
                $rowcrit.=" and project_permissions.project_id=" . $byproject;
            }
        }
        
        $sqldata = "Select  user.id,  user.person_name "
                . "From  project_permissions "
                . "Inner Join   user On project_permissions.user_id = user.id " 
                . $rowcrit ;


        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\models\Keyvalue();

            $model[$count]->id = $row["id"];
            $model[$count]->value = $row["person_name"];
        }

        return $model;
    }
    
    public function salecenteruserlist($byid=0, $bycenter=0) {
        $rowcrit = "";

        if ($byid > 0) {
            if ($rowcrit == "")
            {
                $rowcrit = " where user.id=" . $byid;
            }
            else
            {
                $rowcrit.=" and user.id=" . $byid;
            }
        }
        
        if ($bycenter > 0) {
            if ($rowcrit == "")
            {
                $rowcrit = " where centers_permissions.project_id=" . $bycenter;
            }
            else
            {
                $rowcrit.=" and centers_permissions.project_id=" . $bycenter;
            }
        }
        
        $sqldata = "Select  user.id,  user.person_name "
                . "From  centers_permissions "
                . "Inner Join   user On centers_permissions.user_id = user.id " 
                . $rowcrit .
                " group by user.id,  user.person_name";


        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\models\Keyvalue();

            $model[$count]->id = $row["id"];
            $model[$count]->value = $row["person_name"];
            $model[$count]->tag = "";//$row["firstname"]." ".$row["middelname"]." ".$row["lastname"];
        }

        return $model;
    }
    
    public function userlist($byid=0) {
        $rowcrit = "";

        /*if ($rowcrit == "")
        {
            $rowcrit = " where centers_permissions.user_id=" . $_SESSION["user_array"]["id"];
        }
        else
        {
            $rowcrit.=" and centers_permissions.user_id=" . $_SESSION["user_array"]["id"];
        }
        
        if ($byid > 0) {
            if ($rowcrit == "")
            {
                $rowcrit = " where sales_center.id=" . $byid;
            }
            else
            {
                $rowcrit.=" and sales_center.id=" . $byid;
            }
        }*/
        
        $sqldata = "Select  sales_center.id,  sales_center.name "
                . "From  centers_permissions "
                . "Inner Join   sales_center On centers_permissions.center_id = sales_center.id " 
                . $rowcrit . 
                "  Group By   sales_center.id";


        $connection = Yii::$app->getDb();
        $cmdrow = $connection->createCommand($sqldata);
        $rows = $cmdrow->queryAll();

        $model = [];
        $count = -1;

        foreach ($rows as $row) {
            $count++;

            $model[] = new \app\models\Keyvalue();

            $model[$count]->id = $row["id"];
            $model[$count]->value = $row["name"];
            $model[$count]->total = 0;
        }

        return $model;
    }
    
}
