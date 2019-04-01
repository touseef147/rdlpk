<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "sec_role_rights".
 *
 * @property string $right_id
 * @property integer $role_id
 * @property string $action_id
 * @property integer $right_status
 *
 * @property SecRoles $role
 * @property SecModuleActions $action
 */
class Secrolerights extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sec_role_rights';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'action_id', 'right_status'], 'required'],
            [['role_id', 'action_id', 'right_status'], 'integer'],
            [['role_id'], 'unique', 'targetAttribute' => ['role_id', 'action_id'],'message'=>'Another right with same details already exist.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'right_id' => 'Right ID',
            'role_id' => 'Role',
            'action_id' => 'Action',
            'right_status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(SecRoles::className(), ['role_id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction()
    {
        return $this->hasOne(SecModuleActions::className(), ['action_id' => 'action_id']);
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
