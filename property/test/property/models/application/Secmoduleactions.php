<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "sec_module_actions".
 *
 * @property string $action_id
 * @property integer $controller_id
 * @property string $action_title
 * @property integer $action_so
 * @property string $action_detail
 *
 * @property SecModules $module
 * @property SecRoleRights[] $secRoleRights
 */
class Secmoduleactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sec_module_actions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        //,'related_action1','related_action2','related_action3','related_action4','related_action5','related_action6'
        return [
            
            [['controller_id', 'action_title', 'action_so', 'action_code','view_name','for_admin'], 'required'],
            [['controller_id', 'action_so','for_admin'], 'integer'],
            [['action_title'], 'string', 'max' => 300],
            [['action_title'],'string','min'=>3,'tooShort'=>'Action title is too short.'],
            [['action_title'], 'unique', 'targetAttribute' => ['controller_id', 'action_title'],'message'=>'Another Action with same details already exist.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'action_id' => 'Action ID',
            'controller_id' => 'Module',
            'action_title' => 'Action Title',
            'action_so' => 'Sort Order',
            'action_code' => 'Action Code',
            'view_name' => 'View Name',
            'for_admin' => 'For Admin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getController()
    {
        return $this->hasOne(Seccontroller::className(), ['controller_id' => 'controller_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecRoleRights()
    {
        return $this->hasMany(SecRoleRights::className(), ['action_id' => 'action_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControllername()
    {
        return $this->controller->controller_name;
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
