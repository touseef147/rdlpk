<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "fms_accounts".
 *
 * @property integer $acc_id
 * @property integer $category_id
 * @property string $acc_code
 * @property string $acc_title
 * @property string $remarks
 * @property integer $status
 */
class Fmsaccounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fms_accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'acc_code', 'acc_title', 'remarks', 'status'], 'required'],
            [['category_id', 'status'], 'integer'],
            [['acc_code'], 'string', 'max' => 10],
            [['acc_title'], 'string', 'max' => 300],
            [['remarks'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'acc_id' => 'Acc ID',
            'category_id' => 'Category ID',
            'acc_code' => 'Acc Code',
            'acc_title' => 'Acc Title',
            'remarks' => 'Remarks',
            'status' => 'Status',
        ];
    }
    
    public function getCategory()
    {
        return $this->hasOne(Fmsacccategories::className(), ['category_id' => 'category_id']);
    }
    
    public function getTransactiondetails()
    {
        return $this->hasMany(Fmstransdetail::className(), ['acc_id' => 'acc_id']);
    }
}
