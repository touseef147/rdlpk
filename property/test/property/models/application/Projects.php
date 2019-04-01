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
    public $pimage;
    public $pmap;
    public $lmap;
    
    
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
            [['project_name', 'url', 'code', 'teaser', 'details', 'status', 'create_date'], 'required'],
            [['teaser', 'details'], 'string'],
            [['status', 'membership_fee'], 'integer'],
            [['create_date', 'report_title_line1', 'report_title_line1'], 'safe'],
            [['project_name', 'url', 'code'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    
    public static function Statuslist() {
        return [
            1 => "Active",
            0 => "In-Active",
        ];
    }
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
            'report_title_line1' => "Report Title",
            'report_title_line2' => "Report Title 2",
          
            'membership_fee' => 'Membership Fee',
           
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
  public function updatePicture() {
	   if ($this->id != 0 && $this->project_image != "" && $this->project_image != null) {
            (file_exists('uploads/projects/' . $this->project_image) ? unlink('uploads/projects/' . $this->project_image) : "");
        }
        if ($this->pimage != null) {
            $this->pimage->saveAs('uploads/projects/' . $this->id . '.' . $this->pimage->extension);
            $this->project_image = $this->id . "." . $this->pimage->extension;
            $this->save(FALSE);
        }
		////////////////////
		/*   if ($this->id != 0 && $this->project_map != "" && $this->project_map != null) {
            (file_exists('uploads/projects/' . $this->project_map) ? unlink('uploads/projects/' . $this->project_map) : "");
        }
        if ($this->pmap != null) {
            $this->pmap->saveAs('uploads/projects/' . $this->id . '.' . $this->pmap->extension);
            $this->project_map = $this->id . "." . $this->pmap->extension;
            $this->save(FALSE);
        }*/
		///////////////////
       if ($this->id != 0 && $this->land_map != "" && $this->land_map != null) {
            (file_exists('uploads/projects/' . $this->land_map) ? unlink('uploads/projects/' . $this->land_map) : "");
        }
        if ($this->lmap != null) {
            $this->lmap->saveAs('uploads/projects/' . $this->lmap . '.' . $this->lmap->extension);
            $this->land_map = $this->lmap . "." . $this->lmap->extension;
            $this->save(FALSE);
        }
	   
	    return TRUE;
	  
           }
    public function updaterecord() {
       $valid = true;
	   $valid2=true;
	   $valid3=true;

     
       
       if ($this->save()) {
                if ($this->pimage != NULL) {
                $valid = $this->updatePicture();
            }
			if ($this->pmap != NULL) {
                $valid1 = $this->updatePicture();
            }
			if ($this->lmap != NULL) {
                $valid2 = $this->updatePicture();
            }
            //$valid = $this->updateCnicPicture() && $valid;

          
            return $valid;
			return $valid1;
			return $valid2;
        }
        if(Yii::$app->user->identity->rawerrors ==1){
            echo "<h3>".$this->className()." Model: updaterecord</h3>";
            print_r($this->errors);
        }
            
        return FALSE;
    }
}
