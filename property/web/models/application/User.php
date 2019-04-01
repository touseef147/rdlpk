<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $person_name
 * @property string $pic
 * @property string $sodowo
 * @property string $cnic
 * @property string $address
 * @property string $city
 * @property string $email
 * @property string $state
 * @property string $zip
 * @property string $country
 * @property string $mobile
 * @property string $username
 * @property string $password
 * @property string $per1
 * @property string $per2
 * @property string $per3
 * @property string $per4
 * @property string $per5
 * @property string $per6
 * @property string $per7
 * @property string $per8
 * @property string $per9
 * @property string $per10
 * @property string $per11
 * @property integer $per12
 * @property integer $per13
 * @property integer $per14
 * @property integer $per15
 * @property integer $per16
 * @property integer $per17
 * @property string $status
 * @property string $fp
 * @property string $login_status
 * @property string $user_id
 * @property string $create_date
 * @property string $modify_date
 */
class User extends \yii\db\ActiveRecord
{
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //, 'email', 'state', 'zip', 'country', 'mobile', 'username', 'password', 'per1', 'per2', 'per3', 'per4', 'per5', 'per9', 'per10', 'per11', 'per12', 'per13', 'per14', 'per15', 'per16', 'per17', 'status', 'fp', 'login_status', 'user_id', 'create_date', 'modify_date'
            [['person_name', 'pic', 'sodowo', 'cnic', 'city'], 'required'],
            [['person_name', 'pic', 'sodowo', 'cnic', 'city','mobile','email','address','state','zip'], 'safe'],
            [['role_id', 'role_type', 'printer_rosolution'], 'integer'],
            //[['firstname', 'middelname', 'lastname', 'sodowo', 'cnic', 'city', 'email', 'state', 'zip', 'country'], 'string', 'max' => 256],
            //[['pic'], 'string', 'max' => 100],
            //[['address'], 'string', 'max' => 2000],
            //[['mobile'], 'string', 'max' => 200],
            //[['username', 'password', 'per1', 'per2', 'per3', 'per4', 'per5', 'per6', 'per7', 'per8', 'per9', 'per10', 'per11', 'status', 'login_status', 'user_id', 'create_date', 'modify_date'], 'string', 'max' => 128],
            //[['fp'], 'string', 'max' => 4000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person_name' => 'Name',
            'pic' => 'Pic',
            'sodowo' => 'Sodowo',
            'cnic' => 'Cnic',
            'address' => 'Address',
            'city' => 'City',
            'email' => 'Email',
            'state' => 'State',
            'zip' => 'Zip',
            'country' => 'Country',
            'mobile' => 'Mobile',
            'username' => 'Username',
            'password' => 'Password',
            'per1' => 'Per1',
            'per2' => 'Per2',
            'per3' => 'Per3',
            'per4' => 'Per4',
            'per5' => 'Per5',
            'per6' => 'Per6',
            'per7' => 'Per7',
            'per8' => 'Per8',
            'per9' => 'Per9',
            'per10' => 'Per10',
            'per11' => 'Per11',
            'per12' => 'Per12',
            'per13' => 'Per13',
            'per14' => 'Per14',
            'per15' => 'Per15',
            'per16' => 'Per16',
            'per17' => 'Per17',
            'status' => 'Status',
            'fp' => 'Fp',
            'login_status' => 'Login Status',
            'user_id' => 'User ID',
            'create_date' => 'Create Date',
            'modify_date' => 'Modify Date',
            'role_id' => 'User Role',
            'role_type' => 'Account Type',
            'printer_rosolution' => 'Printer Resolution',
        ];
    }

    public function updaterecord($projects, $centers) {
        $transaction = \Yii::$app->db->beginTransaction();
        $valid = true;
        
        if (!$this->save()) {
            if(Yii::$app->user->identity->rawerrors ==1){
                echo "<h3>".$this->className()." Model: updaterecord</h3>";
                print_r($this->errors);
            }
            
            $valid =FALSE;
        }

        if ($valid) {
            $valid = \app\models\application\Projectpermissions::saveuserList($projects, $this->id) && $valid;
        }

        if ($valid) {
            $valid = \app\models\application\Centerspermissions::saveuserList($centers, $this->id) && $valid;
        }

        if ($valid) {
            $transaction->commit();
        } else {
            $transaction->rollBack();
        }
            
        return $valid;
    }

    public function updateaccount() {
        $valid = true;
        
        if (!$this->save()) {
            \app\models\Model::showerrors($this->errors, $this->className(), "updateaccount");
            
            $valid =FALSE;
        }
            
        return $valid;
    }

    public function changepassword() {
        $valid = true;
        
        if (!$this->save()) {
            \app\models\Model::showerrors($this->errors, $this->className(), "changepassword");
            
            $valid =FALSE;
        }
            
        return $valid;
    }
}
