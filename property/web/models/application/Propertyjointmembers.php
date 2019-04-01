<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "property_joint_members".
 *
 * @property string $joint_ms_id
 * @property integer $membership_id
 * @property integer $plot_id
 * @property integer $member_id
 * @property integer $member_status
 * @property integer $nominee_id
 */
class Propertyjointmembers extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'property_joint_members';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            //[['membership_id', 'plot_id', 'member_id','member_status'], 'required'],
            [['membership_id', 'plot_id', 'member_id', 'member_status', 'nominee_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'joint_ms_id' => 'Joint Ms ID',
            'member_status' => 'Status',
            'membership_id' => 'Membership',
            'plot_id' => 'Plot',
            'member_id' => 'Member',
            'nominee_id' => 'Nominee',
        ];
    }

    public function getMember() {
        return $this->hasOne(Members::className(), ['id' => 'member_id']);
    }

    public function getNominee() {
        return $this->hasOne(Members::className(), ['id' => 'nominee_id']);
    }

    public function getPlot() {
        return $this->hasOne(Plots::className(), ['id' => 'plot_id']);
    }

    public function getMembership() {
        return $this->hasOne(Propertymemberships::className(), ['ms_id' => 'membership_id']);
    }

    public function updaterecord($msid) {
        $valid = true;
        if (!$this->save()) {
            $valid = FALSE;

            if (Yii::$app->user->identity->rawerrors == 1) {
                echo "<h3>" . $this->className() . " Model: updaterecord</h3>";
                print_r($this->errors);
            }
        }

        if ($valid) {
            $ms = Propertymemberships::find()->where(['ms_id' => $msid])->one();

            $ms->is_joint = 1;

            if ($ms->save()) {
                return TRUE;
            }

            if (Yii::$app->user->identity->rawerrors == 1) {
                echo "<h3>" . $this->className() . " Model: updaterecord</h3>";
                print_r($ms->errors);
            }
        }

        return FALSE;
    }

}
