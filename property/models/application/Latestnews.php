<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "latest_news".
 *
 * @property integer $id
 * @property string $teaser
 * @property string $details
 * @property string $status
 * @property string $create_date
 * @property string $update_date
 */
class Latestnews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'latest_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teaser', 'details', 'status', 'create_date', 'update_date'], 'required'],
            [['teaser', 'details'], 'string'],
            [['create_date', 'update_date'], 'safe'],
            [['status'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'teaser' => 'Teaser',
            'details' => 'Details',
            'status' => 'Status',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
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
