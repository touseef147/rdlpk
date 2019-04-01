<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "sec_roles".
 *
 * @property integer $role_id
 * @property integer $sec_role_type_id
 * @property integer $sec_role_category_id
 * @property string $role_name
 * @property integer $role_so
 *
 * @property SecRoleRights[] $secRoleRights
 * @property SecRoleTypes $roleType
 * @property SecRoleCategory $roleCategory
 */
class Secroles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sec_roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sec_role_type_id', 'sec_role_category_id', 'role_name', 'role_so'], 'required'],
            [['sec_role_type_id', 'sec_role_category_id', 'role_so'], 'integer'],
            [['role_name'], 'string', 'max' => 300],
            [['role_name'],'string','min'=>3,'tooShort'=>'Role Name is too short.'],
            [['role_name'], 'unique', 'targetAttribute' => ['role_name', 'sec_role_category_id','sec_role_type_id'],'message'=>'Another role with same details already exist.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'sec_role_type_id' => 'Role Type',
            'sec_role_category_id' => 'Role Category',
            'role_name' => 'Role',
            'role_so' => 'Sort Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecRoleRights()
    {
        return $this->hasMany(SecRoleRights::className(), ['role_id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleType()
    {
        return $this->hasOne(Secroletypes::className(), ['role_type_id' => 'sec_role_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleCategory()
    {
        return $this->hasOne(Secrolecategory::className(), ['role_category_id' => 'sec_role_category_id']);
    }

    public function updaterecord() {
        if ($this->save()) {
            return TRUE;
        }
        
        if(Yii::$app->user->identity->rawerrors ==1){
            echo "<h3>".$this->className()." Model: updaterecord</h3>";
            print_r($this->errors);
        }
            
        return FALSE;
    }
}
