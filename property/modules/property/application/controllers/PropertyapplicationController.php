<?php

namespace app\modules\property\application\controllers;

use Yii;
use app\models\application\Propertyapplication;
use app\models\application\PropertyapplicationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;
use app\models\Model;

/**
 * PropertyapplicationController implements the CRUD actions for Propertyapplication model.
 */
class PropertyapplicationController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                //'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        if (Yii::$app->user->id == null) {
            $this->redirect("index.php");
        } else {
            return parent::beforeAction($action);
        }
    }

    /**
     * Lists all Propertyapplication models.
     * @return mixed
     */
    public function actionIndex() {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "propertyapplication", "property/application");

        $searchModel = new PropertyapplicationSearch();
        $dataProvider = NULL;
        \app\models\Model::loaddata($dataProvider, $searchModel, $request, Yii::$app->request->queryParams);

//        print_r(Propertyapplication::find()->groupBy(['dealer_id'])->count());
//        print_r($searchModel->getsummary(null,"",3,"month"));
//        return;
        
        if ($request->isAjax) {
            return $this->renderPartial('_index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'myrights' => $myrights,
            ]);
        } else {
            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'myrights' => $myrights,
            ]);
        }
    }

    /**
     * Displays printable version of summary Propertyapplication model.
     * @return mixed
     */
    public function actionPrintsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new PropertyapplicationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('printsummary', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Propertyapplication model.
     * @return mixed
     */
    public function actionPdfsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new PropertyapplicationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $pdf = new Pdf([
            'content' => $this->render('printsummary', [
                'dataProvider' => $dataProvider,
            ]),
            'filename' => "report.pdf",
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_A4,
            'destination' => Pdf::DEST_DOWNLOAD
        ]);
        return $pdf->render();
    }

    /**
     * Displays a single Propertyapplication model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Propertyapplication model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Propertyapplication();
        $modelmember = new \app\models\application\Members();
        $modelpcateg = \app\models\application\Categories::find()->all();
        $modelinstallmentplan = null;

        if ($model->load(Yii::$app->request->post())) {
            $modelmember->load(Yii::$app->request->post());

            $data = Yii::$app->request->post();

            Model::loadMultiple($modelpcateg, Yii::$app->request->post());

            $model->member_id = $data["Members"]["parent_id"];
            $model->nominee_id = ($data["Members"]["id"] == NULL ? 0 : $data["Members"]["id"]);
            $reservedplot = intval($data["plot_nos"]);
//$modelmember,
            if ($model->register( (isset($data["category"]) ? $data["category"] : null),$reservedplot)) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=property/application/propertyapplication/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }

            $model->application_date = \Yii::$app->formatter->asDate($model->application_date, 'php:d-m-Y');
            $model->plan_start_date = \Yii::$app->formatter->asDate($model->plan_start_date, 'php:d-m-Y');

            $modelmember = \app\models\application\Members::find()->where(['id' => $model->nominee_id])->one();
        } else {
            $model->application_date = date("d-m-Y");
            $model->plan_start_date = date("d-m-Y");
            $model->property_against = 3;
        }

        $request = Yii::$app->request;
        if ($request->isAjax) {
            return $this->renderPartial('_create', [
                        'model' => $model,
                        'modelmember' => $modelmember,
                        'modelpcateg' => $modelpcateg,
                        'modelinstallmentplan' => $modelinstallmentplan,
            ]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'modelmember' => $modelmember,
                        'modelpcateg' => $modelpcateg,
                        'modelinstallmentplan' => $modelinstallmentplan,
            ]);
        }
    }

    /**
     * Updates an existing Propertyapplication model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $plot = \app\models\application\Plots::find()->where(['application_id' => $model->application_id])->one();

        $modelmember = \app\models\application\Members::find()->where(['id' => $model->nominee_id])->one();
        $modeljointmembers = \app\models\application\Propertyjointmembers::find()->where(['plot_id' => $plot->id])->all();

        $modelpcateg = \app\models\application\Categories::find()->all();
        $selectedcategories = \app\models\application\Propertyapplicationpchoices::find()->where(['application_id' => $model->application_id])->all();

        $modelinstallmentplan = \app\models\application\Installpayment::find()->where(['plot_id' => $plot->id, 'trans_type' => 2])->orderBy('due_date')->all(); //$this->findModel($id);

        
//print_r($modelinstallmentplan);
//return;
        $instpaymentrights = \app\models\Model::getRights("index", "installpayment", "finance");

        $request = Yii::$app->request;
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            $reservedplot = intval($data["plot_nos"]);

            Model::loadMultiple($modelpcateg, Yii::$app->request->post());

//            $modelphoto->image = UploadedFile::getInstanceByName("photo[image]");
//            $modelcnic->image = UploadedFile::getInstanceByName("cnic[image]");

            if ($model->edit($data["category"],$reservedplot)) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=property/application/propertyapplication/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }

            //$model->application_date = \Yii::$app->formatter->asDate($model->application_date, 'php:d-m-Y');
        }

        $model->application_date = \Yii::$app->formatter->asDate($model->application_date, 'php:d-m-Y');
        $model->plan_start_date = \Yii::$app->formatter->asDate($model->plan_start_date, 'php:d-m-Y');

        if ($request->isAjax) {
            return $this->renderPartial('_update', [
                        'model' => $model,
                        'modelmember' => $modelmember,
                        'modeljointmembers' => $modeljointmembers,
                        //              'modelvoucher' => $modelvoucher,
                        //            'modelvoucherfee' => $modelvoucherfee,
                        //          'modelvoucherbooking' => $modelvoucherbooking,
//                        'modelnewnominee' => $modelnewnominee,
                        'modelpcateg' => $modelpcateg,
                        'selectedcategories' => $selectedcategories,
                        'modelinstallmentplan' => $modelinstallmentplan,
                        'instpaymentrights' => $instpaymentrights,
                            //                      'modelphoto' => $modelphoto,
                            //                    'modelcnic' => $modelcnic,
                            //                      'modelbankdoc' => $modelbankdoc,
            ]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'modelmember' => $modelmember,
                        'modeljointmembers' => $modeljointmembers,
                        //        'modelvoucher' => $modelvoucher,
                        //      'modelvoucherfee' => $modelvoucherfee,
                        //    'modelvoucherbooking' => $modelvoucherbooking,
                        //                  'modelnewnominee' => $modelnewnominee,
                        'modelpcateg' => $modelpcateg,
                        'selectedcategories' => $selectedcategories,
                        'modelinstallmentplan' => $modelinstallmentplan,
                        'instpaymentrights' => $instpaymentrights,
                            //                'modelphoto' => $modelphoto,
                            //              'modelcnic' => $modelcnic,
                            //                    'modelbankdoc' => $modelbankdoc,
            ]);
        }
    }

    public function actionSubmit($id) {
        $model = $this->findModel($id);

        $request = Yii::$app->request;
        if ($model->load(Yii::$app->request->post())) {
            $var = \Yii::$app->request->post('submit');
            $result = false;

            if ($var == "submit") {
                $result = $model->submit();
            } else {
                $result = $model->cancel();
            }

            if ($result) {
//            if ($model->submit()) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=property/application/propertyapplication/index",
                    "Record Submitted",
                    "Record submitted successfully"
                ];
            }
            print_r($model->errors);
            return;
        }

        if ($request->isAjax) {
            return $this->renderPartial('_submit', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('submit', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Propertyapplication model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        if ($this->findModel($id)->delete()) {
            \Yii::$app->response->format = 'json';

            return [
                "Removed",
                Yii::$app->urlManager->baseUrl . "/index.php?r=finance/index",
                "Record Removed",
                "Record Removed successfully"
            ];
        }
        //return $this->redirect(['index']);
        else {
            \Yii::$app->response->format = 'json';

            return [
                "Failed",
                "",
                "Failed",
                "Failed to remove record."
            ];
//            return "Failed to remove record";
        }
    }

    /**
     * Displays sidebar Propertyapplication model.
     * @return mixed
     */
    public function actionSidebarsummary() {
        $res = \app\models\Model::checksavedinfo(["r" => "property/application/Propertyapplication/index"]);
        $myrights = \app\models\Model::getRights("index", "Propertyapplication", "property/application");

        $searchModel = new PropertyapplicationSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('_summarysearch', [
                    'searchModel' => $searchModel,
                    'myrights' => $myrights,
        ]);
    }

    /**
     * Displays sidebar Propertyapplication model.
     * @return mixed
     */
    public function actionSidebarinput() {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Propertyapplication model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Propertyapplication the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Propertyapplication::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionFindmember() {
        $model = new \app\models\application\MembersSearch();
        $valid = true;

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());

            if (strlen($model->cnic) != 13) {
                $model->addError('cnic', 'Invalid CNIC No.');
                $valid = FALSE;
            }

            if ($valid) {
                $member = \app\models\application\Members::find()->where(['cnic' => $model->cnic])->one();

                return ($member != NULL ? $this->actionCreatewithmember($member->id) : $this->actionCreatewomember($model->cnic) );
            }
        }

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('_member', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('member', [
                        'model' => $model,
            ]);
        }
    }

    public function actionComments($id = 0, $type = 0) {
        $model = \app\models\application\Propertyapplicationcomments::find()->where(['application_id' => $id, 'generated_by' => $type])->all();
        return $this->renderPartial('comments', [
                    'model' => $model,
        ]);
    }

    public function actionUpdatecomments() {
        $model = new \app\models\application\Propertyapplicationcomments();
        $data = Yii::$app->request->post();

        $model->application_id = $data["comment_box_parent_id"];
        $model->comments = $data["comment_message"];
        $model->generated_by = 0;     //user

        if ($model->updaterecord()) {
            \Yii::$app->response->format = 'json';

            return [
                "saved",
                Yii::$app->urlManager->baseUrl . "/index.php?r=property/application/propertyapplication/comments&id=" . $data["comment_box_parent_id"],
                "Record Saved",
                "Record saved successfully"
            ];
        }
        return NULL;
    }

    //New Member
    public function actionTest() {
        $data = Yii::$app->request->post();

        $modelmember = \app\models\application\Members::find()->where(['id' => $data["Members"]["parent_id"]])->one();
        $modelnominee = \app\models\application\Members::find()->where(['id' => $data["Members"]["id"]])->one();
//        print_r($data);

        return $this->renderPartial('_members', [
                    'modelmember' => $modelmember,
                    'modelnominee' => $modelnominee,
        ]);
//        return "sdf";
    }

    //Joint memberships
    public function actionAttachmember() {
        $data = Yii::$app->request->post();
        $id = $data["Propertyapplication"]["application_id"];

        $model = $this->findModel($id);
        $modeljmember = new \app\models\application\Propertyjointmembers();
        $plotid = $model->plot->id;
        $memberid = $data["Members"]["parent_id"];
        $nomineeid = ($data["Members"]["id"] == NULL ? 0 : $data["Members"]["id"]); //$data["Nominee"]["id"];
        $ms = \app\models\application\Propertymemberships::find()->where(['plot_id' => $plotid]);
        $ms->andWhere('parent_ms_id is null or parent_ms_id =0');
        $ms = $ms->one();

//
        //if($model->application_id != NULL && $model->application_id!=0){
        //  $modelplot=  \app\models\application\Plots::find()->where(['application_id'=>$model->application_id])->one();
        //$plotid=$modelplot->id;
        //}
        //
        if ($memberid != 0) {
            $modeljmember->plot_id = $plotid;
            $modeljmember->membership_id = $ms->ms_id;
            $modeljmember->member_id = $memberid;
            $modeljmember->nominee_id = $nomineeid;
            $model->attachMember($modeljmember, $ms->ms_id);

            //$modelmember= \app\models\application\Members::find()->where(['id'=>1])->one();
            //$modelmember= \app\models\application\Members::find()->where(['id'=>$data["new_member_id"]])->one();
//            $modellist = \app\models\application\Propertyjointmembers::find()->where(['plot_id' => $plotid])->all();

            return $this->renderPartial('_members', [
                        'model' => $model,
                            //                      'modellist' => $modellist,
            ]);
        }
        return "";
    }

    public function actionFiledetails($id) {
        $model = \app\models\application\Plots::find()->where(['application_id' => $id])->one();

        \Yii::$app->response->format = 'json';

        return [
            $model->id,
        ];
    }

    public function actionCount() {
        $model = \app\models\application\Propertyapplication::find()->select('application_id')->all();

        return count($model);
    }

}
