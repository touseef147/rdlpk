<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "streets".
 *
 * @property integer $id
 * @property integer $project_id
 * @property string $sector_id
 * @property string $street
 * @property string $create_date
 * @property string $modify_date
 */
class Streets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'streets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'sector_id', 'street', 'create_date', 'modify_date'], 'required'],
            [['project_id'], 'integer'],
            [['create_date', 'modify_date'], 'safe'],
            [['sector_id', 'street'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'sector_id' => 'Sector ID',
            'street' => 'Street',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSector()
    {
        return $this->hasOne(Sectors::className(), ['id' => 'sector_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlots()
    {
        return $this->hasMany(Plots::className(), ['id' => 'plot_id']);
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
