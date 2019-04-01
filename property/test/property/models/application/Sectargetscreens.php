<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "sec_target_screens".
 *
 * @property string $target_id
 * @property integer $parent_screen_id
 * @property integer $target_screen_id
 * @property integer $status
 */
class Sectargetscreens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sec_target_screens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_screen_id', 'target_screen_id', 'status'], 'required'],
            [['parent_screen_id', 'target_screen_id', 'status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'target_id' => 'Target ID',
            'parent_screen_id' => 'Parent Screen ID',
            'target_screen_id' => 'Target Screen ID',
            'status' => 'Status',
        ];
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
