<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "sec_page_categories".
 *
 * @property integer $category_id
 * @property integer $category_title
 * @property integer $sort_order
 * @property integer $module_id
 */
class Secpagecategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sec_page_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_title', 'sort_order', 'page_type'], 'required'],
            [['sort_order', 'module_id','page_type'], 'integer'],
            [['category_title'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_title' => 'Category Title',
            'sort_order' => 'Sort Order',
            'module_id' => 'Module ID',
            'page_type' => 'Type',
        ];
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
