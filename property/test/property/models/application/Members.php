<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "members".
 *
 * @property integer $id
 * @property string $name
 * @property string $mem_id
 * @property string $username
 * @property string $sodowo
 * @property string $cnic
 * @property string $cnic_pic
 * @property string $image
 * @property string $address
 * @property string $city_id
 * @property string $phone
 * @property string $email
 * @property string $country_id
 * @property string $state
 * @property string $rwa
 * @property string $password
 * @property string $status
 * @property string $fp
 * @property string $login_status
 * @property string $user_id
 * @property string $create_date
 * @property string $modify_date
 * @property string $dob
 * @property string $RFM
 * @property int $relation_with_parent
 * @property int $parent_id
 * @property int $dealer_group_id
 * @property string $relation_with_member
 * @property int $is_owner
 */
class Members extends \yii\db\ActiveRecord {

//	 public $image;
    public $picture;
    public $cnicfile;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'members';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'sodowo', 'cnic', 'city_id', 'phone', 'country_id', 'dob', 'address'], 'required'],
            [['parent_id', 'rwa', 'dealer_group_id', 'is_owner', 'acc_activation_method', 'acc_activation_status'], 'integer'],
            [['name', 'sodowo', 'cnic', 'cnic_pic', 'image', 'city_id', 'email', 'country_id', 'dealers_business_title'], 'string', 'max' => 256],
            [['mem_id', 'phone', 'RFM'], 'string', 'max' => 255],
            [['username', 'state'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 2000],
            [['dob'], 'string', 'max' => 200],
            [['password', 'status', 'login_status', 'user_id', 'create_date', 'modify_date'], 'string', 'max' => 128],
            [['fp'], 'string', 'max' => 4000],
            [['relation_with_member', 'acc_activation_key'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'mem_id' => 'Mem ID',
            'username' => 'Username',
            'sodowo' => 'Father/Spouse',
            'cnic' => 'CNIC',
            'cnic_pic' => 'Cnic (Picture)',
            'image' => 'Image',
            'address' => 'Address',
            'city_id' => 'City ',
            'phone' => 'Phone',
            'email' => 'Email',
            'country_id' => 'Country ',
            'state' => 'State',
            'rwa' => 'Relation',
            'password' => 'Password',
            'status' => 'Status',
            'fp' => 'Fp',
            'login_status' => 'Login Status',
            'user_id' => 'User ID',
            'create_date' => 'Create Date',
            'modify_date' => 'Modify Date',
            'dob' => 'Date Of Birth',
            'RFM' => 'Rfm',
            'relation_with_parent' => 'Relation',
            'parent_id' => 'Nominee of',
            'is_dealer' => 'Is Dealer',
            'dealers_business_title' => 'Business Title',
            'dealer_group_id' => 'Group',
            'relation_with_member' => 'Relation With Member',
            'acc_activation_method' => 'Activation Method',
            'acc_activation_key' => 'Key',
            'acc_activation_status' => 'Status',
        ];
    }

    public function getRelationtitle() {
        if ($this->relation_with_parent == 1)
            return "Son";
        elseif ($this->relation_with_parent == 2)
            return "Daughter";
        elseif ($this->relation_with_parent == 3)
            return "Wife";
        elseif ($this->relation_with_parent == 4)
            return "Husband";
        elseif ($this->relation_with_parent == 5)
            return "Father";
        elseif ($this->relation_with_parent == 6)
            return "Mother";
        elseif ($this->relation_with_parent == 7)
            return "Sister";
        elseif ($this->relation_with_parent == 8)
            return "Brother";
        else
            return "";
    }

    public function getRelationname() {
        if ($this->rwa == 1)
            return "s/o";
        elseif ($this->rwa == 2)
            return "d/o";
        elseif ($this->rwa == 3)
            return "w/o";
        else
            return "";
    }

    public function getStatusname() {
        if ($this->rwa == 1)
            return "Active";
        else
            return "In-Active";
    }

    public static function Relationslist() {
        return [
            1 => "s/o",
            2 => "d/o",
            3 => "w/o",
        ];
    }

    public static function Statuslist() {
        return [
            1 => "Active",
            0 => "In-Active",
        ];
    }

    public function getParent() {
        return $this->hasOne(Members::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity() {
        return $this->hasOne(City::className(), ['id' => 'city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry() {
        return $this->hasOne(Country::className(), ['id' => 'country']);
    }

    public function getFinancialtransactions() {
        return $this->hasMany(fmstransdetaildist::className(), ['distributed_to_id' => 'id', 'distributed_to_type' => 'member']);
    }

    public function getNominees() {
        return $this->hasMany(Members::className(), ['parent_id' => 'id']);
    }

//
//    public function getDealergroup() {
//        return $this->hasMany(Membersdealergroups::className(), ['parent_id' => 'id']);
//    }

    public function updatePicture() {
        if ($this->id != 0 && $this->image != "" && $this->picture != null) {
            (file_exists('uploads/members/picture/' . $this->image) ? unlink('uploads/members/picture/' . $this->image) : "");
        }

        if ($this->picture != null) {
            $this->picture->saveAs('uploads/members/pictures/' . $this->id . '.' . $this->picture->extension);

            $this->image = $this->id . "." . $this->picture->extension;
            $this->save(FALSE);
        }
        return TRUE;
    }

    public function updateCnicPicture() {
        if ($this->id != 0 && $this->cnic_pic != "") {
            (file_exists('uploads/members/cnic/' . $this->cnic_pic) ? unlink('uploads/members/cnic/' . $this->cnic_pic) : "");
        }

        if ($this->cnicfile != null) {
            $this->cnicfile->saveAs('uploads/members/cnic/' . $this->id . '.' . $this->cnicfile->extension);

            $this->cnic_pic = $this->id . "." . $this->cnicfile->extension;
            $this->save(FALSE);
        }
        return TRUE;
    }

    public function attachExtraFieldsAndSave($parent) {
        $this->sodowo = $parent->name;
        $this->parent_id = $parent->id;
        $this->address = $parent->address;
        $this->city_id = $parent->city_id;
        $this->country_id = $parent->country_id;
        $this->create_date = date("Y-m-d");
        $this->status = "1";
        $this->is_dealer = 0;

        if ($this->save()) {
            return TRUE;
        }

        if (Yii::$app->user->identity->rawerrors == 1) {
            echo "<h3>Members Model: attachExtraFieldsAndSave</h3>";
            print_r($this->errors);
        }

        return FALSE;
    }

    public function registerNewNominee($parent, $data) {
        $this->name = $data["name"];
        $this->cnic = $data["cnic"];
        $this->phone = $data["phone"];
        if (!$this->attachExtraFieldsAndSave($parent)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function addDefaultnominee($member) {
        $nominee = new Members();

        $nominee->address = $member->address;
        $nominee->city_id = $member->city_id;
        $nominee->country_id = $member->country_id;
        $nominee->create_date = date("Y-m-d");
        $nominee->name = "---";
        $nominee->parent_id = $member->id;
        $nominee->sodowo = $member->name;
        $nominee->relation_with_parent = 1;
        //$nominee->state = $member->state;
        $nominee->status = "1";

        $nominee->cnic = "n/a";
        $nominee->phone = "n/a";
        $nominee->email = "n/a";
        $nominee->dob = date("Y-m-d");

        if ($nominee->save()) {
            return true;
        }

        if (Yii::$app->user->identity->rawerrors == 1) {
            echo "<h3>" . $this->className() . " Model: addDefaultnominee</h3>";
            print_r($nominee->errors);
        }

        return false;
    }

    public function updaterecord($addnominee = true) {
        $new = $this->isNewRecord;
        $valid = true;
        if ($this->email != null && $this->email != "") {
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->addError("email", "Email Format is invalid.");
                return FALSE;
            }
        }

        if ($this->is_owner == 0) {
            $this->cnic = str_replace("-", "", $this->cnic);
            if (strlen($this->cnic) < 13) {
                $this->addError("cnic", "CNIC is invalid.");
                return FALSE;
            }
        }

        $cniccheck = \app\models\application\Members::find()->where(['cnic' => $this->cnic]);

        if ($this->is_owner == 0) {
            if ($this->id != 0) {
                $cniccheck->andFilterWhere(['!=', 'id', $this->id]);
            }
        } else {
            $cniccheck->andFilterWhere(['<', 'id', 0]);
        }
        $cniccheck = $cniccheck->one();

        if (count($cniccheck) != NULL) {
            if ($this->parent_id == $cniccheck->parent_id) {
                $this->addError("cnic", "CNIC is already registered.");
                return FALSE;
            }
        }

        if ($new) {
            $this->status = "1";
        }

        if ($this->save()) {
            if ($this->picture != NULL) {
                $valid = $this->updatePicture();
            }
            //$valid = $this->updateCnicPicture() && $valid;

            if ($new && $addnominee) {
                $valid = $this->addDefaultnominee($this);
            }
            return $valid;
        }
        if (Yii::$app->user->identity->rawerrors == 1) {
            //  echo "<h3>" . $this->className() . " Model: updaterecord</h3>";
            // print_r($this->errors);
        }

        return FALSE;
    }

    public function updatenomineerecord() {
        $new = $this->isNewRecord;
        $valid = true;
//		if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
//           $this->addError("email", "Email Format is invalid.");
//            return FALSE;
//         }
//        $this->cnic = str_replace("-", "", $this->cnic);
//        if (strlen($this->cnic) < 13) {
//            $this->addError("cnic", "CNIC is invalid.");
//            return FALSE;
//        }
//        
//        $cniccheck = \app\models\application\Members::find()->where(['cnic' => $this->cnic]);
//
//        if ($this->id != 0) {
//            $cniccheck->andFilterWhere(['!=', 'id', $this->id]);
//        }
//        $cniccheck = $cniccheck->one();
//        
//        if(count($cniccheck) != NULL){
//            $this->addError("cnic", "CNIC is already registered.");
//            return FALSE;
//        }

        if ($new) {
            $this->status = "1";
        }

        if ($this->save(FALSE)) {
            if ($this->picture != NULL) {
                $valid = $this->updatePicture();
            }
            //$valid = $this->updateCnicPicture() && $valid;
//            if ($new) {
//                $valid = $this->addDefaultnominee($this);
//            }
            return $valid;
        }
        if (Yii::$app->user->identity->rawerrors == 1) {
            //  echo "<h3>" . $this->className() . " Model: updaterecord</h3>";
            // print_r($this->errors);
        }

        return FALSE;
    }

    public function updatepwd() {

        if ($this->save()) {
            return TRUE;
        }
        if (Yii::$app->user->identity->rawerrors == 1) {
            //  echo "<h3>" . $this->className() . " Model: updaterecord</h3>";
            // print_r($this->errors);
        }

        return FALSE;
    }

    public function register() {
        if ($this->save()) {
            $valid = $this->updatePicture();
            $valid = $this->updateCnicPicture() && $valid;
            return $valid;
        }
        if (Yii::$app->user->identity->rawerrors == 1) {
            echo "<h3>" . $this->className() . " Model: updaterecord</h3>";
            print_r($this->errors);
        }


        return FALSE;
    }

}
