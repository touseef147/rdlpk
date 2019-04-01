<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "fms_acc_categories".
 *
 * @property integer $category_id
 * @property integer $head_id
 * @property string $category_code
 * @property string $category_title
 * @property string $remarks
 * @property integer $status
 */
class Fmsacccategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fms_acc_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['head_id', 'category_code', 'category_title', 'remarks', 'status'], 'required'],
            [['head_id', 'status'], 'integer'],
            [['category_code'], 'string', 'max' => 30],
            [['category_title'], 'string', 'max' => 300],
            [['remarks'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'head_id' => 'Head ID',
            'category_code' => 'Category Code',
            'category_title' => 'Category Title',
            'remarks' => 'Remarks',
            'status' => 'Status',
        ];
    }
    
    public function getAccounts()
    {
        return $this->hasMany(Fmsaccounts::className(), ['category_id' => 'category_id']);
    }
}
