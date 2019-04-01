<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "property_memberships".
 *
 * @property integer $ms_id
 * @property integer $plot_id
 * @property integer $member_id
 * @property string $ms_no
 * @property integer $ms_status
 * @property string $created_on
 * @property string $modified_on
 * @property integer $is_joint
 * @property integer $parent_ms_id
 * @property integer $user_id
 * @property integer $is_active
 * @property string $submission_date
 * @property string $submission_remarks
 * @property string $verification_date
 * @property string $verification_remarks
 * @property string $approval_date
 * @property string $approval_remarks
 */
class Propertymemberships extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'property_memberships';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['plot_id', 'member_id', 'ms_no', 'ms_status', 'created_on', 'modified_on', 'user_id', 'is_active'], 'required'],
            [['plot_id', 'member_id', 'ms_status', 'is_joint', 'parent_ms_id', 'user_id', 'is_active'], 'integer'],
            [['created_on', 'modified_on', 'submission_date', 'submission_remarks', 'verification_date', 'verification_remarks', 'approval_date', 'approval_remarks'], 'safe'],
            [['ms_no'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ms_id' => 'Ms ID',
            'plot_id' => 'File/Plot No.',
            'member_id' => 'Member Name',
            'ms_no' => 'Ms No',
            'ms_status' => 'Ms Status',
            'created_on' => 'Created On',
            'modified_on' => 'Modified On',
            'is_joint' => 'Joint',
            'parent_ms_id' => 'Parent Ms ID',
            'user_id' => 'User ID',
            'is_active' => 'Is Active',
            'submission_date' => 'Submission Date',
            'submission_remarks' => 'Submission Remarks',
            'verification_date' => 'Verification Date',
            'verification_remarks' => 'Verification Remarks',
            'is_active' => 'approval_date',
            'approval_remarks' => 'Approval Remarks',
        ];
    }

    public static function statuslist() {
        return [
            1 => "Submitted",
            2 => "Forwarded",
            3 => "Verified",
            4 => "Hold",
            5 => "Cancelled",
            10 => "Allotted",
            20 => "Transferred",
        ];
    }

    public function getMembershipstatustitle() {
        if ($this->ms_status == 1) {
            return "Submitted";
        } elseif ($this->ms_status == 2) {
            return "Forwarded";
        } elseif ($this->ms_status == 3) {
            return "Verified";
        } elseif ($this->ms_status == 4) {
            return "Hold";
        } elseif ($this->ms_status == 5) {
            return "Cancelled";
        } elseif ($this->ms_status == 10) {
            return "Allotted";
        } elseif ($this->ms_status == 20) {
            return "Transferred";
        } else {
            return "";
        }
    }

    public function getIsjointtitle() {
        if ($this->is_joint == 1) {
            return "Yes";
        } else {
            return "";
        }
    }

    public function getIsactivetitle() {
        if ($this->is_active == 1) {
            return "Yes";
        } else {
            return "";
        }
    }

    public function getShowsubmissiondate() {
        if ($this->submission_date == NULL || $this->submission_date == "0000-00-00" || $this->submission_date == "1970-01-01") {
            return "";
        }

        return date("d-m-Y", strtotime($this->submission_date));
    }

    public function getShowverificationdate() {
        if ($this->verification_date == NULL || $this->verification_date == "0000-00-00" || $this->verification_date == "1970-01-01") {
            return "";
        }

        return date("d-m-Y", strtotime($this->verification_date));
    }

    public function getShowapprovaldate() {
        if ($this->approval_date == NULL || $this->approval_date == "0000-00-00" || $this->approval_date == "1970-01-01") {
            return "";
        }

        return date("d-m-Y", strtotime($this->approval_date));
    }

    public function getParentmsno() {
        if ($this->parent_ms_id == null || $this->parent_ms_id == 0) {
            return "";
        } else {
            return $this->parent->completecode;
        }
    }

    public function getParentmember() {
        if ($this->parent_ms_id == null || $this->parent_ms_id == 0) {
            return "Yes";
        } else {
            return $this->parent->member->name;
        }
    }

    public function getMembershiptype() {
        if ($this->parent_ms_id == null || $this->parent_ms_id == 0) {
            return "Allottment";
        } else {
            return "Transfer";
        }
    }

    public function getCompletecode() {
        if ($this->ms_no == "" || $this->ms_no == "-" )
            return "";

        $str = $this->plot->project->code . "-" . $this->ms_no . "-";

        if ($this->plot->com_res == "Residential") {
            $str .= "R";
        } elseif ($this->plot->com_res == "Commercial") {
            $str .= "C";
        }

        $str .= $this->plot->sizeCat->code;

        return $str;
    }

    public function getPlot() {
        return $this->hasOne(Plots::className(), ['id' => 'plot_id']);
    }

    public function getMember() {
        return $this->hasOne(Members::className(), ['id' => 'member_id']);
    }

    public function getParent() {
        return $this->hasOne(Propertymemberships::className(), ['parent_ms_id' => 'ms_id']);
    }

    public function getCurrentmembership() {
        return $this->hasOne(Plots::className(), ['ms_id' => 'ms_id']);
    }

    public static function GenerateNewAppMembership(&$app) {
        $file = Plots::find()->where(['application_id' => $app->application_id])->one();

        if ($file == NULL) {
            $app->addError('application_no', 'File does not exist.');
            return FALSE;
        }

        $membership = Propertymemberships::find()->where(['plot_id' => $file->id, 'ms_status' => 1])->all();

        if ($membership != NULL) {
            $app->addError('application_no', 'Ms already exist.');
            return FALSE;
        }

        $newmembership = new Propertymemberships();
        $newmembership->member_id = $app->member_id;
        $newmembership->ms_status = 1;
        $newmembership->parent_ms_id = 0;
        $newmembership->plot_id = $file->id;
        $newmembership->ms_no = "-";
        $newmembership->is_active = 0;

        $newmembership->user_id = Yii::$app->user->identity->id;
        $newmembership->created_on = date("Y-m-d h:i:s");
        $newmembership->modified_on = date("Y-m-d h:i:s");

        if ($newmembership->save() == FALSE) {
            if (Yii::$app->user->identity->rawerrors == 1) {
                echo "<h3>GenerateNewAppMembership Model: generatePlanFromApplication</h3>";
                print_r($newmembership->errors);
            }
            $app->addError('application_no', 'Failed to create Membership.');
            return FALSE;
        }

        $file->ms_id = $newmembership->ms_id;

        if ($file->save() == FALSE) {
            if (Yii::$app->user->identity->rawerrors == 1) {
                echo "<h3>GenerateNewAppMembership Model: generatePlanFromApplication</h3>";
                print_r($newmembership->errors);
            }
            $app->addError('application_no', 'Failed to create Membership.');
            return FALSE;
        }

        return TRUE;
    }

    public function submitallottment() {
        $valid = true;
        
            $temp = Propertymemberships::find()->joinWith("plot")->where(['ms_no' => $this->ms_no, 'plots.project_id' => $this->plot->project_id])->one();
            if ($temp != NULL) {
                $this->addError('ms_no', 'Membership No. already exist.');
                return FALSE;
            }

        $this->ms_status = 1;
        $this->submission_date = date("Y-m-d");

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "allotment");
        }

        if ($valid) {
            $valid = Propertymembershipcomments::updatesystemcomments("Record Submitted.", 1, $this->ms_id) && $valid;
        }

        return $valid;
    }

    public function forwardallottment() {
        $valid = true;

        $this->ms_status = 2;
        $this->submission_date = date("Y-m-d");

        $form = Propertyapplication::find()->where(['application_id' => $this->plot->application_id])->one();

        $form->application_status = 10;

        if (!$form->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "allotment");
        } else {
            if (!$this->save()) {
                $valid = FALSE;
                \app\models\Model::showerrors($this->errors, $this->className(), "allotment");
            }
        }

        if ($valid) {
            $valid = Propertymembershipcomments::updatesystemcomments("Record Forwarded.", 1, $this->ms_id) && $valid;
        }

        return $valid;
    }

    public function verify() {
        $valid = true;

        $this->ms_status = 3;
        $this->verification_date = date("Y-m-d");

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "allotment");
        }

        if ($valid) {
            $valid = Propertymembershipcomments::updatesystemcomments("Record Verified.", 1, $this->ms_id) && $valid;
        }

        return $valid;
    }

    public function hold() {
        $valid = true;

        $this->ms_status = 4;
        $this->verification_date = date("Y-m-d");

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "allotment");
        }

        if ($valid) {
            $valid = Propertymembershipcomments::updatesystemcomments("Record Hold.", 1, $this->ms_id) && $valid;
        }

        return $valid;
    }

    public function approve() {
        $valid = true;

        $this->ms_status = ($this->parent_ms_id == null || $this->parent_ms_id == 0 ? 10 : 20);
        $this->approval_date = date("Y-m-d");

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "allotment");
        }

        if ($valid) {
            $valid = Propertymembershipcomments::updatesystemcomments("Record Approved.", 1, $this->ms_id) && $valid;
        }

        if ($valid) {
            $plot = Plots::find()->where(['id' => $this->plot_id])->one();
            $plot->ms_id = $this->ms_id;

            if (!$plot->save()) {
                $valid = FALSE;
                \app\models\Model::showerrors($plot->errors, $this->className(), "allotment");
            }
        }

        return $valid;
    }

    public function cancel() {
        $valid = true;

        $this->ms_status = 5;
//        $this->verification_date = date("Y-m-d");

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "allotment");
        }

        if ($valid) {
            $valid = Propertymembershipcomments::updatesystemcomments("Record Cancelled.", 1, $this->ms_id) && $valid;
        }

        return $valid;
    }

    public function allotment() {
        $valid = true;

        $this->ms_status = 1;

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "allotment");
        }

        return $valid;
    }

}
