<?php

namespace app\models\application;

use Yii;
use app\models\Model;

/**
 * This is the model class for table "installment_plan_master".
 *
 * @property integer $plan_id
 * @property integer $project_id
 * @property integer $category_id
 * @property string $description
 * @property double $total_amount
 * @property integer $no_of_installments
 * @property integer $plan_land_type
 * @property integer $plan_development_type
 */
class Installmentplanmaster extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'installment_plan_master';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['project_id', 'category_id', 'description', 'total_amount', 'no_of_installments', 'plan_land_type', 'plan_development_type'], 'required'],
            [['project_id', 'category_id', 'no_of_installments', 'plan_land_type', 'plan_development_type'], 'integer'],
            [['total_amount'], 'number'],
            [['description'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'plan_id' => 'Plan ID',
            'project_id' => 'Project',
            'category_id' => 'Plot Size',
            'description' => 'Description',
            'total_amount' => 'Total Amount',
            'no_of_installments' => 'Installments',
            'plan_land_type' => 'Plot Type',
            'plan_development_type' => 'Plan For',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanDetail() {
        return $this->hasMany(Installmentplandetail::className(), ['plan_id' => 'plan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject() {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasOne(Sizecat::className(), ['id' => 'category_id']);
    }

    public function generatePlan() {
        $transaction = \Yii::$app->db->beginTransaction();
        $valid = $this->save();

        for ($i = 0; $i < intval($this->no_of_installments); $i++) {
            $valid = \app\models\application\Installmentplandetail::generatenewrow($this->plan_id, $i) && $valid;;
        }

        if ($valid) {
            $transaction->commit();
            return true;
        } else {
            $transaction->rollBack();
            return FALSE;
        }
    }

    public function updatePlan(&$prevdata, &$newdata) {
        $transaction = \Yii::$app->db->beginTransaction();
        $valid = true;
        $count = 0;
        
        Installmentplandetail::updateList($prevdata, $newdata, $count,$valid,$this->plan_id);

        $this->no_of_installments = $count;
        $valid=$this->save() & $valid;

        if ($valid) {
            $transaction->commit();
            return true;
        } else {
            $transaction->rollBack();
            return FALSE;
        }
    }

}
