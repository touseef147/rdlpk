<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property integer $id
 * @property string $project_name
 * @property string $url
 * @property string $code
 * @property string $teaser
 * @property string $details
 * @property string $project_image
 * @property string $project_map
 * @property string $land_map
 * @property integer $status
 * @property string $create_date
 * @property string $modify_date
 * @property integer $membership_fee
 * @property string $report_title_line1
 * @property string $report_title_line2
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_name', 'url', 'code', 'teaser', 'details', 'project_image', 'project_map', 'land_map', 'status', 'create_date', 'modify_date'], 'required'],
            [['teaser', 'details'], 'string'],
            [['status', 'membership_fee'], 'integer'],
            [['create_date', 'modify_date', 'report_title_line1', 'report_title_line2'], 'safe'],
            [['project_name', 'url', 'code', 'project_image', 'project_map', 'land_map'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_name' => 'Project Name',
            'url' => 'Url',
            'code' => 'Code',
            'teaser' => 'Teaser',
            'details' => 'Details',
            'project_image' => 'Project Image',
            'project_map' => 'Project Map',
            'land_map' => 'Land Map',
            'status' => 'Status',
            'create_date' => 'Create Date',
            'modify_date' => 'Modify Date',
            'membership_fee' => 'Membership Fee',
            'report_title_line1' => 'Report Title 1',
            'report_title_line2' => 'Report Title 2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStreets()
    {
        return $this->hasMany(Streets::className(), ['id' => 'project_id']);
    }
	

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectors()
    {
        return $this->hasMany(Sectors::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitorBookings()
    {
        return $this->hasMany(\app\models\application\Interestbooking::className(), ['id' => 'project_id']);
    }
	  public function getPermissions()
    {
        return $this->hasMany(\app\models\application\Projectpermissions::className(), ['project_id' => 'id']);
    }
    
    public function getFinancialtrans()
    {
        return $this->hasMany(Fmstransmaster::className(), ['project_id' => 'id']);
    }
    
    public function getInstruments()
    {
        return $this->hasMany(Fmsvoucher::className(), ['project_id' => 'id']);
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
