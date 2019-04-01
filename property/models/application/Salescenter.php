<?php

namespace app\models\application;

use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "sales_center".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $detail
 */
class Salescenter extends \yii\db\ActiveRecord {

    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'sales_center';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'detail'], 'required'],
            [['name', 'image'], 'string', 'max' => 255],
            [['detail'], 'string', 'max' => 500],
            [['name'], 'unique','message'=>'Another Sales center with same name already exist.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            'detail' => 'Detail',
        ];
    }

    public function getVouchers() {
        return $this->hasMany(Fmsvoucher::className(), ['sales_center_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitorBookings() {
        return $this->hasMany(\app\models\application\Interestbooking::className(), ['id' => 'center_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissions() {
        return $this->hasMany(\app\models\application\Centerspermissions::className(), ['center_id' => 'id']);
    }
    
    public function getFinancialtrans()
    {
        return $this->hasMany(Fmstransmaster::className(), ['sales_center_id' => 'id']);
    }

    public function updaterecord() {
        if ($this->id == 0 && $this->file == NULL) {
             $this->addError('file', 'Image is missing');
             return FALSE;
        }
        
        if ($this->save()) {
            if ($this->file != null) {
                $this->file->saveAs('uploads/property/config/salescenter/' . $this->id . '.' . $this->file->extension);

                $this->image = $this->id . "." . $this->file->extension;
                $this->save(FALSE);
            }
            return TRUE;
        }
        if (Yii::$app->user->identity->rawerrors == 1) {
            echo "<h3>" . $this->className() . " Model: updaterecord</h3>";
            print_r($this->errors);
        }

        return FALSE;
    }

}
