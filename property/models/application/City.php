<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "tbl_city".
 *
 * @property integer $id
 * @property string $city
 * @property integer $country_id
 * @property string $zipcode
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_city';
    }

    /**
     * @inheritdoc
     */
	  /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitorCountry()
    {
        return $this->hasOne(\app\modules\general\models\Country::className(), ['id' => 'country']);
    }
    public function rules()
    {
        return [
		  [['country_id'], 'required'],
           [['city'], 'required'],
            [['zipcode'], 'required'],

			[['country_id'], 'integer'],
            [['city'], 'string', 'max' => 255],
            [['zipcode'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => 'City',
            'country_id' => 'Country ID',
            'zipcode' => 'Zipcode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitors()
    {
        return $this->hasMany(\app\modules\visits\models\Dailyvisitors::className(), ['city' => 'id']);
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
