<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "sectors".
 *
 * @property integer $id
 * @property string $project_id
 * @property string $sector_name
 * @property string $details
 * @property string $create_date
 * @property string $modify_date
 */
class Sectors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sectors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'sector_name', 'details', 'create_date', 'modify_date'], 'required'],
            [['sector_name', 'details'], 'string'],
            [['create_date', 'modify_date'], 'safe'],
            [['project_id'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project',
            'sector_name' => 'Sector Name',
            'details' => 'Details',
            'create_date' => 'Create Date',
            'modify_date' => 'Modify Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
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
