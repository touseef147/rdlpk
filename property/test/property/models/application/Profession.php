<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "profession".
 *
 * @property integer $id
 * @property string $profession
 */
class Profession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profession';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profession'], 'required'],
            [['profession'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'profession' => 'Profession',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitors()
    {
        return $this->hasMany(\app\modules\visits\models\Dailyvisitors::className(), ['profession_id' => 'id']);
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
