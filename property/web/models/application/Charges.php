<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "charges".
 *
 * @property integer $id
 * @property string $name
 * @property string $note
 * @property string $monthly
 * @property string $total
 * @property string $type
 * @property string $project_id
 */
class Charges extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'charges';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'note', 'monthly', 'total', 'type', 'project_id'], 'required'],
            [['name', 'note'], 'string', 'max' => 255],
            [['monthly', 'total'], 'string', 'max' => 200],
            [['type'], 'string', 'max' => 256],
            [['project_id'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'note' => 'Note',
            'monthly' => 'Monthly',
            'total' => 'Total',
            'type' => 'Type',
            'project_id' => 'Project ID',
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
