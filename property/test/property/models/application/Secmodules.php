<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "sec_modules".
 *
 * @property integer $module_id
 * @property string $module_title
 * @property integer $module_so
 *
 * @property SecModuleActions[] $secModuleActions
 */
class Secmodules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sec_modules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_title', 'module_so','module_code'], 'required'],
            [['module_so','parent_module_id','for_reports'], 'integer'],
            [['module_title','module_code'], 'string', 'max' => 300],
            [['module_title'],'string','min'=>3,'tooShort'=>'Module Name is too short.'],
            [['module_title'], 'unique', 'message'=>'Another Module with details already exist.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'module_id' => 'Module ID',
            'module_code' => 'Module Code',
            'module_title' => 'Module Title',
            'module_so' => 'Sort Order',
            'parent_module_id' => 'Parent Module',
            'for_reports' => 'Use For Reports',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecModuleControllers()
    {
        return $this->hasMany(SecController::className(), ['module_id' => 'module_id']);
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
