<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "sec_role_category".
 *
 * @property integer $role_category_id
 * @property string $role_category_name
 * @property integer $role_category_so
 *
 * @property SecRoles[] $secRoles
 */
class Secrolecategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sec_role_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_category_name', 'role_category_so'], 'required'],
            [['role_category_so'], 'integer'],
            [['role_category_name'], 'string', 'max' => 200],
            [['role_category_name'],'string','min'=>3,'tooShort'=>'Category Name is too short.'],
            [['role_category_name'], 'unique', 'message'=>'Another Category with details already exist.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_category_id' => 'Role Category ID',
            'role_category_name' => 'Category Name',
            'role_category_so' => 'Sort Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecRoles()
    {
        return $this->hasMany(SecRoles::className(), ['role_category_id' => 'role_category_id']);
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
