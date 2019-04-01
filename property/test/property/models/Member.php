<?php

namespace app\models;

use Yii;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

class Member extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'members';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cnic', 'password'], 'required'],
            [['cnic', 'password'], 'string', 'max' => 100]            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Userid',
            'cnic' => 'Login Name',
            'password' => 'Password'
        ];
    }    
/*    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];
*/
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
 /*       foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;*/
        //return static::findOne(['access_token' => $token]);
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        /*foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;*/
        return static::findOne(['cnic' => $username]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsercredentials($username,$password)
    {
        /*foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;*/
        return static::findOne(['cnic' => $username, 'password'=>$password]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        //return $this->id;
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        //return $this->authKey;
        //return $this->auth_key;
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        //return $this->authKey === $authKey;
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
    
// Other code goes here...       
    public function getFullname()
    {
        $profile = \app\models\application\Members::find()->where(['id'=>$this->id])->one();
        if ($profile !==null)
            return $profile->name;
        return false;
    }    
    
    public function getRole()
    {
//        $profile = \app\models\application\User::find()->where(['id'=>$this->id])->one();
//        if ($profile !==null)
//            return $profile->role_id;
        return false;
    }    
    
    public function getRoletype()
    {
//        $profile = \app\models\application\User::find()->where(['id'=>$this->id])->one();
//        if ($profile !==null)
//        {
//            return $profile->role_type;
//        }
        return false;
    }    
    
    public function getPrinterresolution()
    {
//        $profile = \app\models\application\User::find()->where(['id'=>$this->id])->one();
//        if ($profile !==null)
//        {
//            return $profile->printer_rosolution;
//        }
        return false;
    }    
    
    public function getPicture()
    {
        $profile = \app\models\application\Members::find()->where(['id'=>$this->id])->one();
        if ($profile !==null)
        {
            return $profile->image;
        }
        return false;
    }    
    
    public function getIsdeveloper()
    {
        return 0;
    }    
    
    public function getRawerrors()
    {
        return 1;
    }    
    
    public function getSystemcomments()
    {
        return 1;
    }    
}
