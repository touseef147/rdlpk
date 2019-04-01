<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "property_documents".
 *
 * @property string $document_id
 * @property integer $category_id
 * @property string $title
 * @property string $file_name
 * @property string $remarks
 * @property integer $project_id
 * @property integer $sales_center_id
 * @property integer $membership_id
 * @property integer $entered_by
 * @property string $entry_date
 * @property integer $application_id
 * @property integer $plot_id
 */
class Propertydocuments extends \yii\db\ActiveRecord {

    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'property_documents';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['category_id', 'title', 'file_name', 'project_id', 'sales_center_id', 'entered_by', 'entry_date'], 'required'],
            [['category_id', 'project_id', 'sales_center_id', 'membership_id', 'entered_by', 'application_id', 'plot_id'], 'integer'],
            [['title'], 'string', 'max' => 500],
            [['image'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'jpg, gif, png'],
            //[['file_name'], 'string', 'max' => 200],
            [['remarks'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'document_id' => 'Document ID',
            'category_id' => 'Category ID',
            'title' => 'Title',
            'file_name' => 'File Name',
            'remarks' => 'Remarks',
            'project_id' => 'Project ID',
            'sales_center_id' => 'Sales Center ID',
            'membership_id' => 'Membership ID',
            'entered_by' => 'Entered By',
            'entry_date' => 'Entry Date',
            'application_id' => 'Application ID',
            'plot_id' => 'Plot ID',
        ];
    }

    public function getCategory() {
        return $this->hasOne(Propertydoccategories::className(), ['category_id' => 'category_id']);
    }

    public function getProject() {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }

    public function getSalecenter() {
        return $this->hasOne(Salescenter::className(), ['id' => 'sales_center_id']);
    }

    /*    public function getMembership() {
      return $this->hasOne(membersh::className(), ['category_id' => 'category_id']);
      }
     */

    public function getEnteredbyuser() {
        return $this->hasOne(User::className(), ['id' => 'entered_by']);
    }

    public function getApplication() {
        return $this->hasOne(Propertyapplication::className(), ['application_id' => 'application_id']);
    }

    public function getPlot() {
        return $this->hasOne(Plots::className(), ['id' => 'plot_id']);
    }

    public function upload() {
        $doc = Propertydocuments::find()->where(['application_id' => $this->application_id, 'category_id' => $this->category_id])->one();
        if ($doc != NULL) {
            if (file_exists('uploads/' . $doc->file_name)) {
                unlink('uploads/' . $doc->file_name);
            }
        }

        $this->entered_by = Yii::$app->user->id;
        $this->entry_date = date("Y-m-d");
        $this->file_name = "new";
        if ($this->validate()) {
            $this->save(FALSE);

            $this->file_name = $this->document_id . '.' . $this->image->extension;
            $this->save(FALSE);

            $categ = ""; //PropertydoccategoriesSearch::getRecord($this->category_id);
            //. $categ->path
            $this->image->saveAs('uploads/' . $this->document_id . '.' . $this->image->extension);
            return true;
        }

        if (Yii::$app->user->identity->rawerrors == 1) {
            echo "<h3>" . $this->className() . " Model: Upload</h3>";
            print_r($this->errors);
        }
        return false;
    }

}
