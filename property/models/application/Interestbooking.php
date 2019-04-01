<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "mkt_interest_booking".
 *
 * @property integer $id
 * @property integer $visitors_id
 * @property integer $project_id
 * @property string $com_res
 * @property string $size2
 * @property string $booking_date
 * @property string $no_of_plots
 * @property string $type
 * @property integer $deal_by
 * @property integer $center_id
 */
class Interestbooking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mkt_interest_booking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['visitors_id', 'com_res', 'size2', 'booking_date', 'no_of_plots', 'type', 'deal_by', 'center_id','project_id'], 'required'],
            [['visitors_id', 'deal_by', 'center_id','project_id'], 'integer'],
            [['com_res', 'size2', 'booking_date', 'no_of_plots', 'type'], 'string', 'max' => 255]
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
            'com_res' => 'Com Res',
            'size2' => 'Size2',
            'booking_date' => 'Booking Date',
            'no_of_plots' => 'No Of Plots',
            'type' => 'Type',
            'deal_by' => 'Deal By',
            'center_id' => 'Center ID',
            'project_id' => 'Project',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlotSize()
    {
        return $this->hasOne(\app\modules\propertyconfig\models\Sizecat::className(), ['id' => 'size2']);
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
    public function getProject()
    {
        return $this->hasOne(\app\modules\propertyconfig\models\Projects::className(), ['id' => 'project_id']);
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
