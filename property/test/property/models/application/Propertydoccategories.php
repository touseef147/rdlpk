<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "property_doc_categories".
 *
 * @property integer $category_id
 * @property string $category_title
 * @property integer $sort_order
 * @property string $path
 */
class Propertydoccategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'property_doc_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_title', 'sort_order', 'path'], 'required'],
            [['sort_order'], 'integer'],
            [['category_title'], 'string', 'max' => 200],
            [['path'], 'string', 'max' => 300]
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
            'path' => 'Path',
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
