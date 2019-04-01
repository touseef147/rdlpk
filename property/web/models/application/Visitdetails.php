<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "mkt_visit_details".
 *
 * @property integer $id
 * @property integer $visitors_id
 * @property string $visit_no
 * @property string $visit_type
 * @property string $visit_date
 * @property string $deal_by
 * @property string $next_visit
 * @property string $followup_status
 * @property string $remarks
 * @property integer $center_id
 */
class Visitdetails extends \yii\db\ActiveRecord
{
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mkt_visit_details';
    }

          
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['visitors_id', 'visit_no', 'visit_type', 'visit_date', 'deal_by',  'followup_status', 'remarks', 'center_id'], 'required'],
            [['visitors_id', 'center_id'], 'integer'],
            [['visit_date', 'next_visit'], 'safe'],
            [['visit_no', 'visit_type', 'deal_by', 'followup_status', 'remarks'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'visitors_id' => 'Visitors ID',
            'visit_no' => 'Visit No',
            'visit_type' => 'Visit Type',
            'visit_date' => 'Visit Date',
            'deal_by' => 'Deal By',
            'next_visit' => 'Next Visit',
            'followup_status' => 'Followup Status',
            'remarks' => 'Remarks',
            'center_id' => 'Center ID',
        ];
    }
	 /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleCenter()
    {
        return $this->hasOne(\app\modules\propertyconfig\models\Salescenter::className(), ['id' => 'center_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitor()
    {
        return $this->hasOne(Dailyvisitors::className(), ['id' => 'visitors_id']);
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
