<?php

namespace app\models\application;

use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $title
 * @property string $name
 * @property string $sign
 */
class Categories extends \yii\db\ActiveRecord {

    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'name'], 'required'],
            [['title', 'name', 'sign'], 'string', 'max' => 200],
            [['name'], 'unique','message'=>'Another category with same name already exist.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'name' => 'Name',
            'sign' => 'Sign',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlots() {
        return $this->hasMany(Plots::className(), ['id' => 'category_id']);
    }
 public function updatePicture() {
        if ($this->id != 0 && $this->sign != "" && $this->sign != null) {
            (file_exists('uploads/categories/' . $this->sign) ? unlink('uploads/categories/' . $this->sign) : "");
        }

        if ($this->file != null) {
            $this->file->saveAs('uploads/categories/' . $this->id . '.' . $this->file->extension);

            $this->sign = $this->id . "." . $this->file->extension;
            $this->save(FALSE);
        }
        return TRUE;
    }
    public function updaterecord() {
        
        $valid=true;
        if ($this->save()) {
            if ($this->file != NULL) {
                $valid = $this->updatePicture();
            }
            //$valid = $this->updateCnicPicture() && $valid;

           // if ($new) {
           //     $valid = $this->addDefaultnominee($this);
          //  }
            return $valid;
        }

       // if (Yii::$app->user->identity->rawerrors == 1) {
         //   echo "<h3>" . $this->className() . " Model: updaterecord</h3>";
         //   print_r($this->errors);
       // }

        return FALSE;
    }

}
