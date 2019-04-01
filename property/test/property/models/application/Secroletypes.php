<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "sec_role_types".
 *
 * @property integer $role_type_id
 * @property string $role_type_name
 * @property integer $role_type_so
 *
 * @property SecRoles[] $secRoles
 */
class Secroletypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sec_role_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_type_name', 'role_type_so'], 'required'],
            [['role_type_so'], 'integer'],
            [['role_type_name'], 'string', 'max' => 200],
            [['role_type_so'],'default','value'=> 0],
            [['role_type_name'],'string','min'=>3,'tooShort'=>'Role Type Name is too short.'],
            [['role_type_name'], 'unique','message'=>'Another role type with details already exist.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_type_id' => 'Role Type ID',
            'role_type_name' => 'Role Type',
            'role_type_so' => 'Sort Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecRoles()
    {
        return $this->hasMany(SecRoles::className(), ['role_type_id' => 'role_type_id']);
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
