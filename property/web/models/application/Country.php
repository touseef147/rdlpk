<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "tbl_country".
 *
 * @property integer $id
 * @property string $country
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_country';
    }

    /**
     * @inheritdoc
     */
   public function rules()
    {
        return [
		  [['country'], 'required'],
            [['country'], 'string', 'max' => 255]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Country',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasMany(City::className(), ['id' => 'country_id']);
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
