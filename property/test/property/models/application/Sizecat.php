<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "size_cat".
 *
 * @property integer $id
 * @property string $size
 * @property string $code
 */
class Sizecat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'size_cat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['size', 'code'], 'required'],
            [['size'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'size' => 'Size',
            'code' => 'Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitorBookings()
    {
        return $this->hasMany(\app\modules\visits\models\Interestbooking::className(), ['id' => 'size2']);
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
