<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "property_application_pchoices".
 *
 * @property string $choice_id
 * @property string $application_id
 * @property integer $category_id
 */
class Propertyapplicationpchoices extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'property_application_pchoices';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['application_id', 'category_id'], 'required'],
            [['application_id', 'category_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'choice_id' => 'Choice ID',
            'application_id' => 'Application ID',
            'category_id' => 'Category ID',
        ];
    }

    public function getApplication() {
        return $this->hasOne(Propertyapplication::className(), ['application_id' => 'application_id']);
    }

    public function getCategory() {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    public static function saveList($list, $parentid) {
        $valid = true;

        if ($list == NULL)
            return TRUE;

        if ($parentid != null && $parentid > 0) {
            //Propertyapplicationpchoices::findAll(['application_id'=>$parentid])->delete();
        }

        foreach ($list as $val) {
            if ($val) {
                $newcat = new \app\models\application\Propertyapplicationpchoices();

                $newcat->category_id = $val;
                $newcat->application_id = $parentid;


                if (!$newcat->save()) {
                    $valid = false;
                    //if (Yii::$app->user->identity->rawerrors == 1) {
                    //  echo "<h3>".$list->className()." Model: savelist</h3>";
//                    print_r($newcat->errors);
                    print_r($newcat);
                    //}
                }
            }
        }
        return $valid;
    }

}
