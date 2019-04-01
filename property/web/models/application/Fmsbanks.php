<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "fms_banks".
 *
 * @property integer $bank_id
 * @property string $bank_title
 */
class Fmsbanks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fms_banks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bank_title'], 'required'],
            [['bank_title'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bank_id' => 'Bank ID',
            'bank_title' => 'Bank Title',
        ];
    }

    public function getVouchers() {
        return $this->hasMany(Fmsvoucher::className(), ['bank_id' => 'bank_id']);
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
