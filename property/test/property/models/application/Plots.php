<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "plots".
 *
 * @property integer $id
 * @property string $type
 * @property integer $project_id
 * @property string $street_id
 * @property string $plot_detail_address
 * @property string $plot_size
 * @property string $size2
 * @property integer $installment
 * @property string $price
 * @property string $create_date
 * @property string $modify_date
 * @property string $com_res
 * @property integer $category_id
 * @property string $sector
 * @property string $image
 * @property integer $shap_id
 * @property string $cstatus
 * @property string $status
 * @property string $fstatus
 * @property string $rstatus
 * @property string $bstatus
 * @property string $bid
 * @property string $atype
 * @property string $rownumber
 * @property integer $application_id
 * @property integer $ms_member_id
 * @property string $ms_creation_date
 * @property string $ms_modification_date
 * @property integer $ms_status
 * @property string $ms_no
 * @property string $ms_type
 * @property integer $parent_id
 * @property integer $reserved_plot_id
 * @property string $plot_no
 * @property integer $is_reserved
 */
class Plots extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'plots';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type', 'project_id', 'street_id', 'plot_detail_address', 'plot_size', 'size2', 'price', 'com_res', 'sector'], 'required'],
            [['project_id', 'installment', 'category_id', 'shap_id', 'application_id', 'ms_id', 'parent_id', 'activation_status', 'refund_amount', 'parent_file_id', 'reserved_plot_id', 'is_reserved'], 'integer'],
            [['create_date', 'modify_date', 'activation_remarks', 'activation_fin_remarks', 'activation_ver_remarks', 'plot_no'], 'safe'],
            [['type', 'plot_detail_address', 'plot_size', 'bstatus', 'atype'], 'string', 'max' => 256],
            [['street_id'], 'string', 'max' => 11],
            [['size2', 'image'], 'string', 'max' => 100],
            [['price', 'fstatus', 'rstatus', 'bid'], 'string', 'max' => 255],
            [['com_res', 'rownumber'], 'string', 'max' => 123],
            [['sector', 'cstatus', 'status'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'type' => 'Location Status',
            'project_id' => 'Project Name',
            'street_id' => 'Street Name',
            'plot_detail_address' => 'File No',
            'plot_size' => 'Dimensions',
            'size2' => 'Size',
            'installment' => 'Installment',
            'price' => 'Price',
            'create_date' => 'Create Date',
            'modify_date' => 'Modify Date',
            'com_res' => 'Type',
            'category_id' => 'Category ID',
            'sector' => 'Sector',
            'image' => 'Image',
            'shap_id' => 'Shap ID',
            'cstatus' => 'Construction Status',
            'status' => 'Status',
            'fstatus' => 'Financial Status',
            'rstatus' => 'Rstatus',
            'bstatus' => 'Bstatus',
            'bid' => 'Bid',
            'atype' => 'Atype',
            'rownumber' => 'Rownumber',
            'application_id' => 'Application',
            'ms_id' => 'Membership',
            'parent_id' => 'Land Details',
            'activation_status' => 'File Status',
            'activation_remarks' => 'Remarks',
            'refund_amount' => 'Refund Amount',
            'activation_fin_remarks' => 'Remarks',
            'activation_ver_remarks' => 'Remarks',
            'parent_file_id' => 'Prev. File',
            'reserved_plot_id' => 'Reserved',
            'plot_no' => 'Plot No.',
            'is_reserved' => 'Reserved',
        ];
    }

    /* PROPERTIES */

    public static function cancillationstatuslist() {
        return [
            111 => "All",
            11 => "Pending",
            12 => "Submitted",
            13 => "Verified",
            14 => "Hold",
            15 => "Rejected",
            16 => "Cancelled",
        ];
    }

    public static function mergestatuslist() {
        return [
            211 => "All",
            21 => "Pending",
            22 => "Submitted",
            23 => "Verified",
            24 => "Hold",
            25 => "Rejected",
            26 => "Merged",
        ];
    }

    public static function conversionstatuslist() {
        return [
            311 => "All",
            31 => "Pending",
            32 => "Submitted",
            33 => "Verified",
            34 => "Hold",
            35 => "Rejected",
            36 => "Cancelled",
        ];
    }

    public function getTypetitle() {
        if ($this->type == "Plot" || $this->type == "1") {
            return "Plot";
        } elseif ($this->type == "file" || $this->type == "2") {
            return "File";
        } elseif ($this->type == "building" || $this->type == "3") {
            return "Building";
        } else {
            return "";
        }
    }

    public function getActivationstatustitle() {
        if ($this->activation_status == 11 || $this->activation_status == 21 || $this->activation_status == 31) {
            return "Request Generated";
        } elseif ($this->activation_status == 12 || $this->activation_status == 22 || $this->activation_status == 32) {
            return "Submitted";
        } elseif ($this->activation_status == 13 || $this->activation_status == 23 || $this->activation_status == 33) {
            return "Verified";
        } elseif ($this->activation_status == 14 || $this->activation_status == 24 || $this->activation_status == 34) {
            return "Hold";
        } elseif ($this->activation_status == 15 || $this->activation_status == 25 || $this->activation_status == 35) {
            return "Rejected";
        } elseif ($this->activation_status == 16) {
            return "Cancelled";
        } elseif ($this->activation_status == 26) {
            return "Merged";
        } elseif ($this->activation_status == 36) {
            return "Converted";
        } else {
            return "";
        }
    }

    public function getComrestitle() {
        if ($this->type == "Residential" || $this->type == "1") {
            return "Residential";
        } elseif ($this->type == "Commercial" || $this->type == "2") {
            return "Commercial";
        } else {
            return "";
        }
    }

    public function getAtypetitle() {
        if ($this->type == "Against Land" || $this->type == "1") {
            return "Against Land";
        } elseif ($this->type == "On Payment" || $this->type == "2") {
            return "On Payment";
        } else {
            return "";
        }
    }

    public function getCompletecode() {
        $str = "F-" . $this->plot_detail_address . "-";

        if ($this->com_res == "Residential") {
            $str .= "R";
        } elseif ($this->com_res == "Commercial") {
            $str .= "C";
        }

        $str .= $this->sizeCat->code;

        return $str;
    }

    /* END OF PROPERTIES */

    /* RELATIONS */

    public function getParent() {
        return $this->hasOne(Plots::className(), ['id' => 'parent_id']);
    }

    public function getReservedplot() {
        return $this->hasOne(Plots::className(), ['id' => 'reserved_plot_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject() {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }

    public function getMemberplot() {
        return $this->hasOne(Memberplot::className(), ['plot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStreet() {
        return $this->hasOne(Streets::className(), ['id' => 'street_id']);
    }

    public function getPlotsector() {
        return $this->hasOne(Sectors::className(), ['id' => 'sector']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSizeCat() {
        return $this->hasOne(Sizecat::className(), ['id' => 'size2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberships() {
        return $this->hasMany(Propertymemberships::className(), ['plot_id' => 'id']);
    }

    public function getJointmembers() {
        return $this->hasMany(Propertyjointmembers::className(), ['plot_id' => 'id']);
    }

    public function getCurrentmembership() {
        return $this->hasOne(Propertymemberships::className(), ['ms_id' => 'ms_id']);
    }

    public function getApplication() {
        return $this->hasOne(Propertyapplication::className(), ['application_id' => 'application_id']);
    }

    public function getInstallmentplan() {
        return $this->hasMany(Installpayment::className(), ['plot_id' => 'id']);
    }

    public function getFinancialreceipts() {
        return $this->hasMany(Fmsvoucherplotdetail::className(), ['plot_id' => 'id']);
    }

    public function getPropertydocuments() {
        return $this->hasMany(Propertydocuments::className(), ['plot_id' => 'id']);
    }

    /* END OF RELATIONS */

    public function updaterecord() {
        if ($this->save()) {
            return TRUE;
        }

        if (Yii::$app->user->identity->rawerrors == 1) {
            echo "<h3>" . $this->className() . " Model: updaterecord</h3>";
            print_r($this->errors);
        }

        return FALSE;
    }

    public static function updatePlotReservation(&$app, $reservedplotno) {
        $valid = true;

        $file = Plots::find()->where(['application_id' => $app->application_id])->one();
        
        if ($valid) {
            if (intval($file->reserved_plot_id) != intval($reservedplotno)) {
                if ($file->reserved_plot_id != null && $file->reserved_plot_id != 0) {
                    $reserved = Plots::find()->where(['id' => $file->reserved_plot_id])->one();
                    $reserved->is_reserved = 0;

                    if (!$reserved->save()) {
                        if (Yii::$app->user->identity->rawerrors == 1) {
                            echo "<h3>" . $reserved->className() . " Model: updatePlotReservation</h3>";
                            print_r($reserved->errors);
                        }
                        $valid = FALSE;
                    }
                }
            }
        }

        if ($valid) {
            $file->reserved_plot_id = ($reservedplotno == null || $reservedplotno == 0 ? 0 : $reservedplotno);

            if (!$file->save()) {
                if (Yii::$app->user->identity->rawerrors == 1) {
                    echo "<h3>" . $this->className() . " Model: register</h3>";
                    print_r($file->errors);
                }
                $valid = FALSE;
            }

            if ($reservedplotno != null && $reservedplotno != 0 && $valid) {
                $resplot = Plots::find()->where(['id' => $reservedplotno])->one();
                $resplot->is_reserved = 1;

                if (!$resplot->save()) {
                    if (Yii::$app->user->identity->rawerrors == 1) {
                        echo "<h3>" . $resplot->className() . " Model: register</h3>";
                        print_r($resplot->errors);
                    }
                    $valid = FALSE;
                }
            }
        }

        return $valid;
    }

    public static function attachFilewithApplication(&$app, $resetprev = false) {
        $filealreadyattached = Plots::find()->where(['application_id' => $app->application_id])->one();

        if ($resetprev) {            
            if (!$filealreadyattached->save()) {
                if (Yii::$app->user->identity->rawerrors == 1) {
                    echo "<h3>" . $this->className() . " Model: attachFilewithApplication</h3>";
                    print_r($filealreadyattached->errors);
                }
                return FALSE;
            }
        } else {
            if ($filealreadyattached != NULL) {
                $app->addError('application_no', 'File is already attached with this form.');
                return FALSE;
            }
        }

        $newfile = Plots::find()->where(
                ['project_id' => $app->project_id,
                    'size2' => $app->property_size,
                    'com_res' => ($app->property_type == 1 ? "Residential" : ($app->property_type == 2 ? "Commercial" : "")),
        ]);

        $newfile->andWhere('application_id is NULL or application_id = 0');
        $newfile = $newfile->one();

        if ($newfile == NULL) {
            $app->addError('application_no', 'No File is available.');
            return FALSE;
        }

        $newfile->application_id = $app->application_id;
        $newfile->atype = $app->property_against;
        $newfile->status = "Requested";

        if (!$newfile->save()) {
            if (Yii::$app->user->identity->rawerrors == 1) {
                echo "<h3>" . $this->className() . " Model: attachFilewithApplication</h3>";
                print_r($this->errors);
            }
            return FALSE;
        }
        return TRUE;
    }

    public function updatePlan($prevdata, $newdata) {
        $transaction = \Yii::$app->db->beginTransaction();
        $valid = true;
        $count = 0;

        $valid = Installpayment::updateList($prevdata, $newdata, $count, $valid, $this->id);

//        $this->no_of_installments = $count;
//        $valid=$this->save() & $valid;

        if ($valid) {
            $transaction->commit();
            return true;
        } else {
            $transaction->rollBack();
            return FALSE;
        }
    }

    public function cancelFilereq() {
        $valid = true;

        $this->activation_status = 11;
        //$this->submission_date = date("Y-m-d");

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "allotment");
        }

        return $valid;
    }

    public function cancelFilesubmit() {
        $valid = true;

        $this->activation_status = 12;
        //$this->submission_date = date("Y-m-d");

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "allotment");
        }

        return $valid;
    }

    public function cancelFileverify() {
        $valid = true;

        $this->activation_status = 13;
        //$this->refund_amount = date("Y-m-d");

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "allotment");
        }

        return $valid;
    }

    public function cancelFilehold() {
        $valid = true;

        $this->activation_status = 14;
        //$this->refund_amount = date("Y-m-d");

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "allotment");
        }

        return $valid;
    }

    public function cancelFilereject() {
        $valid = true;

        $this->activation_status = 15;
        //$this->refund_amount = date("Y-m-d");

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "allotment");
        }

        return $valid;
    }

    public function cancelFileapprove() {
        $valid = true;

        $this->activation_status = 16;
        //$this->refund_amount = date("Y-m-d");

        if (!$this->save()) {
            $valid = FALSE;
            \app\models\Model::showerrors($this->errors, $this->className(), "allotment");
        }

        return $valid;
    }

}
