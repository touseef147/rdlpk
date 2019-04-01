<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "sec_controller".
 *
 * @property integer $controller_id
 * @property integer $module_id
 * @property string $controller_code
 * @property string $controller_name
 * @property integer $sort_order
 */
class Seccontroller extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sec_controller';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id', 'controller_code', 'controller_name', 'sort_order'], 'required'],
            [['module_id', 'sort_order'], 'integer'],
            [['controller_code'], 'string', 'max' => 100],
            [['controller_name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'controller_id' => 'Controller ID',
            'module_id' => 'Module ID',
			'module_title' => 'Module Name',
            'controller_code' => 'Controller Code',
            'controller_name' => 'Controller Name',
            'sort_order' => 'Sort Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Secmodules::className(), ['module_id' => 'module_id']);
    }
    
    public function getCompleteName(){
        return $this->module->module_title.": ".$this->controller_name;
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
