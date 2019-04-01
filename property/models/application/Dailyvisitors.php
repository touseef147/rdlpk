<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "mkt_daily_visitors_report".
 *
 * @property integer $id
 * @property string $name
 * @property integer $profession_id
 * @property integer $city
 * @property string $contactno
 * @property string $email
 * @property string $refered_by
 * @property string $reference
 * @property string $reg_date
 */
class Dailyvisitors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mkt_daily_visitors_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'profession_id', 'city', 'contactno', 'email', 'refered_by', 'reference', 'reg_date'], 'required'],
            [['profession_id', 'city'], 'integer'],
            [['reg_date'], 'safe'],
            [['name', 'contactno', 'email', 'refered_by', 'reference'], 'string', 'max' => 255]
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
            'profession_id' => 'Profession',
            'city' => 'City',
            'contactno' => 'Contactno',
            'email' => 'Email',
            'refered_by' => 'Refered By',
            'reference' => 'Reference',
            'reg_date' => 'Reg Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitorCity()
    {
        return $this->hasOne(\app\modules\general\models\City::className(), ['id' => 'city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfession()
    {
        return $this->hasOne(\app\modules\general\models\Profession::className(), ['id' => 'profession_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitDetails()
    {
        return $this->hasMany(Visitdetails::className(), ['visitors_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingDetails()
    {
        return $this->hasMany(Interestbooking::className(), ['visitors_id' => 'id']);
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
