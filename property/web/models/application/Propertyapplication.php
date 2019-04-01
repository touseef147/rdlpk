<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "property_application".
 *
 * @property string $application_id
 * @property integer $project_id
 * @property integer $sales_center_id
 * @property integer $member_id
 * @property string $application_no
 * @property string $application_date
 * @property integer $property_type
 * @property integer $property_size
 * @property integer $dealer_id
 * @property string $nominee_id
 * @property string $voucher_id
 * @property int $property_against
 * @property int $installment_plan
 * @property int $installment_plan_development
 * @property int $application_status
 * @property int $receipt_entered
 */
class Propertyapplication extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'property_application';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['project_id', 'sales_center_id', 'member_id', 'application_no', 'property_type', 'property_size', 'application_date', 'property_against', 'application_status'], 'required'],
            [['project_id', 'sales_center_id', 'member_id', 'property_type', 'property_size', 'dealer_id', 'nominee_id', 'voucher_id', 'property_against', 'installment_plan', 'installment_plan_development', 'application_status', 'receipt_entered'], 'integer'],
            [['application_date', 'plan_start_date'], 'date'],
            [['application_no'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'application_id' => 'Application ID',
            'project_id' => 'Project',
            'sales_center_id' => 'Sales Center',
            'member_id' => 'Member',
            'application_no' => 'Form No.',
            'application_date' => 'Date',
            'property_type' => 'Property Type',
            'property_size' => 'Property Size',
            'dealer_id' => 'Dealer',
            'nominee_id' => 'Nominee',
            'voucher_id' => 'Voucher',
            'property_against' => 'Property Against',
            'installment_plan' => 'Installment Plan',
            'installment_plan_development' => 'Development Plan',
            'application_status' => 'Status',
            'plan_start_date' => 'Plan Start',
            'receipt_entered' => 'Instrument Status',
        ];
    }

    /* PROPERTIES */

    public function getPropertytypetitle() {
        if ($this->property_type == 1)
            return "Residential";
        elseif ($this->property_type == 2)
            return "Commercial";
        elseif ($this->property_type == 3)
            return "Farms";
        elseif ($this->property_type == 4)
            return "Villas";
        elseif ($this->property_type == 2)
            return "";
    }

    public function getPropertyagainsttitle() {
        if ($this->property_against == 1)
            return "Against Land";
        elseif ($this->property_against == 2)
            return "On Cash";
        elseif ($this->property_against == 3)
            return "Installments";
        else
            return "";
    }

    public function getStatustitle() {
        if ($this->application_status == 0)
            return "Registered";
        elseif ($this->application_status == 10)
            return "Submitted";
        else
            return "";
    }

    /* END OF PROPERTIES */

    /* RELATIONS */

    public function getProject() {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }

    public function getSalecenter() {
        return $this->hasOne(Salescenter::className(), ['id' => 'sales_center_id']);
    }

    public function getMember() {
        return $this->hasOne(Members::className(), ['id' => 'member_id']);
    }

    public function getPlotsize() {
        return $this->hasOne(Sizecat::className(), ['id' => 'property_size']);
    }

    public function getDealer() {
        return $this->hasOne(Members::className(), ['id' => 'dealer_id']);
    }

    public function getNominee() {
        return $this->hasOne(Members::className(), ['id' => 'nominee_id']);
    }

    public function getVoucher() {
        return $this->hasOne(Fmsvoucher::className(), ['voucher_id' => 'voucher_id']);
    }

    public function getReceipt() {
        return $this->hasOne(Fmsvoucherplotdetail::className(), ['application_id' => 'application_id']);
    }

    public function getPlot() {
        return $this->hasOne(Plots::className(), ['application_id' => 'application_id']);
    }

    public function getInstallmentplan() {
        return $this->hasOne(Installmentplanmaster::className(), ['plan_id' => 'installment_plan']);
    }

    public function getMembership() {
        return $this->hasOne(Propertymemberships::className(), ['application_id' => 'application_id']);
    }

    public function getFile() {
        return $this->hasOne(Plots::className(), ['application_id' => 'application_id']);
    }

    public function getPropertychoices() {
        return $this->hasMany(Propertyapplicationpchoices::className(), ['application_id' => 'application_id']);
    }

    public function getDocuments() {
        return $this->hasMany(Propertydocuments::className(), ['application_id' => 'application_id']);
    }

    public function getComments() {
        return $this->hasMany(Propertyapplicationcomments::className(), ['application_id' => 'application_id']);
    }

    /* END OF RELATIONS */

    public function validaterecord() {
        if ($this->application_id == 0) {
            $temp = Propertyapplication::find()->where(['application_no' => $this->application_no, 'project_id' => $this->project_id])->one();
            if ($temp != NULL) {
                $this->addError('application_no', 'Form No. already exist.');
                return FALSE;
            }
        } else {
            $temp = Propertyapplication::find()->where(['application_no' => $this->application_no, 'project_id' => $this->project_id])->andFilterWhere(['!=', 'application_id', $this->application_id])->one();
            if ($temp != NULL) {
                $this->addError('application_no', 'Form No. already exist.');
                return FALSE;
            }

            if ($this->application_status == 10) {
                $this->addError('application_no', 'Form is already submitted.');
                return false;
            }
        }

        return true;
    }

    public function register(&$datapchoices) {
        if ($this->validaterecord() == FALSE) {
            return FALSE;
        }

        $valid = TRUE;
        $transaction = \Yii::$app->db->beginTransaction();

        if ($valid) {
            $this->application_date = \Yii::$app->formatter->asDate($this->application_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));
            $this->plan_start_date = \Yii::$app->formatter->asDate($this->plan_start_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));
            $this->application_status = 0;

            if (!$this->save()) {
                $valid = FALSE;
                if (Yii::$app->user->identity->rawerrors == 1) {
                    echo "<h3>" . $this->className() . " Model: register</h3>";
                    print_r($this->errors);
                }
            }
        }

        if ($valid) {
            $valid = \app\models\application\Propertyapplicationpchoices::saveList($datapchoices, $this->application_id) && $valid;
        }

        if ($valid) {
            $valid = Plots::attachFilewithApplication($this) && $valid;
        }

        if ($valid && $this->installment_plan != 0) {
            $valid = Installpayment::generatePlanFromApplication($this) && $valid;
        }

        if ($valid) {
            $valid = Propertymemberships::GenerateNewAppMembership($this) && $valid;
        }

        if ($valid) {
            $valid = Propertyapplicationcomments::updatesystemcomments("Application Registered.", 1, $this->application_id) && $valid; 
        }

        if ($valid) {
            $transaction->commit();
            return TRUE;
        } else {
            $transaction->rollBack();
            return FALSE;
        }
    }

    public function edit(&$modelmember, &$modelnominee, &$datapchoices, &$modelphoto, &$modelcnic, $datanominee) {
        if ($this->validaterecord() == FALSE) {
            return FALSE;
        }

        $transaction = \Yii::$app->db->beginTransaction();
        $valid = true;

        if ($valid == TRUE) {
            if ($this->nominee_id == 0) {
                if (!$modelnominee->registerNewNominee($modelmember, $datanominee)) {
                    $valid = FALSE;
                } else {
                    $this->nominee_id = $modelnominee->id;
                }
            }
        }

        if ($valid) {
            $this->application_date = \Yii::$app->formatter->asDate($this->application_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));
            $this->plan_start_date = \Yii::$app->formatter->asDate($this->plan_start_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));
            $this->application_status = 0;

            if (!$this->save()) {
                $valid = FALSE;
                if (Yii::$app->user->identity->rawerrors == 1) {
                    echo "<h3>" . $this->className() . " Model: register</h3>";
                    print_r($this->errors);
                }
            }
        }

        if ($valid) {
            if ($modelphoto->image != NULL) {
                $modelphoto->category_id = 1;
                $modelphoto->project_id = $this->project_id;
                $modelphoto->application_id = $this->application_id;
                $modelphoto->sales_center_id = $this->sales_center_id;
                $modelphoto->title = "Photographs of " . $modelmember->name;
                $valid = $modelphoto->upload() && $valid;
            }
        }

        if ($valid) {
            if ($modelcnic->image != NULL) {
                $modelcnic->category_id = 2;
                $modelcnic->project_id = $this->project_id;
                $modelcnic->application_id = $this->application_id;
                $modelcnic->sales_center_id = $this->sales_center_id;
                $modelcnic->title = $modelmember->cnic;
                $valid = $modelcnic->upload() && $valid;
            }
        }

        if ($valid) {
            $valid = \app\models\application\Propertyapplicationpchoices::saveList($datapchoices, $this->application_id) && $valid;
        }

        if ($valid) {
            $valid = Propertyapplicationcomments::updatesystemcomments("Application Updated.", 1, $this->application_id) && $valid; 
        }

        if ($valid) {
            $transaction->commit();
            return TRUE;
        } else {
            $transaction->rollBack();
            return FALSE;
        }
    }

    public function submit() {
        $transaction = \Yii::$app->db->beginTransaction();
        $valid = TRUE;

        if ($valid) {
            $this->application_status = 10;
            if (!$this->save()) {
                $valid = FALSE;
                if (Yii::$app->user->identity->rawerrors == 1) {
                    echo "<h3>" . $this->className() . " Model: register</h3>";
                    print_r($this->errors);
                }
            }
        }

        if ($valid) {
            $valid = Propertyapplicationcomments::updatesystemcomments("Application Submitted.", 1, $this->application_id) && $valid; 
        }

        if ($valid) {
            $transaction->commit();
            return true;
        } else {
            $transaction->rollBack();
            return FALSE;
        }
    }

    public function attachMember(&$member, $msid) {
        //$memberdetail = Members::find()->where(['id'=>$member->nominee_id])->one();

        if ($this->application_id == 0 || $this->member_id == NULL || $this->member_id == 0) {
            $this->member_id = $memberdetail->parent_id; //$member->member_id;
            $this->nominee_id = $member->nominee_id;
            return true;
        } else {
            //$member->member_id = $memberdetail->parent_id;
            return $member->updaterecord($msid);
        }
    }

    public static function updateReceiptstatus($appid) {
        $application = Propertyapplication::find()->where(['application_id' => $appid])->one();

        if ($application != NULL) {
            $application->receipt_entered = 1;

            if (!$application->save()) {
                if (Yii::$app->user->identity->rawerrors == 1) {
                    echo "<h3>" . $this->className() . " Model: updaterecord</h3>";
                    print_r($application->errors);
                }
                return false;
            }
        }

        return true;
    }

}
