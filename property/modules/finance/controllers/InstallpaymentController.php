<?php

namespace app\modules\finance\controllers;

use Yii;
use app\models\application\Installpayment;
use app\models\application\InstallpaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use kartik\mpdf\Pdf;

/**
 * InstallpaymentController implements the CRUD actions for Installpayment model.
 */
class InstallpaymentController extends Controller {

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
     * Lists all Installpayment models.
     * @return mixed
     */
    public function actionIndex() {

        $request = Yii::$app->request;

        $searchModel = new InstallpaymentSearch();
        $dataProvider = NULL;
        $myrights = \app\models\Model::getRights("index", "installpayment", "finance");

        if (count(Yii::$app->request->queryParams) == 1) {
            $res = \app\models\Model::checksavedinfo(Yii::$app->request->queryParams);

            if ($res == NULL) {
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
                $dataProvider->pagination->page = $request->get("pageno", 0);
            } else {
                $dataProvider = $searchModel->search($res);

                $dataProvider->pagination->pageSize = (isset($res["pagesize"]) ? $res["pagesize"] : 20); //$request->get("pagesize", 20);
                $dataProvider->pagination->page = (isset($res["pageno"]) ? $res["pageno"] : 0); //$request->get("pagesize", 20);
            }
        } else {
            \app\models\Model::savebrowsinginfo();

            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
            $dataProvider->pagination->page = $request->get("pageno", 0);
        }

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
     * Displays printable version of summary Installpayment model.
     * @return mixed
     */
    public function actionPrintsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new InstallpaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('printsummary', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Installpayment model.
     * @return mixed
     */
    public function actionPdfsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new InstallpaymentSearch();
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
     * Displays a single Installpayment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('_view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Installpayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Installpayment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->response->format = 'json';

            return [
                "saved",
                Yii::$app->urlManager->baseUrl . "/index.php?r=finance/index",
                "Record Saved",
                "Record saved successfully"
            ];
//            return $this->redirect(['index']);
        } else {

            $request = Yii::$app->request;

            if ($request->isAjax) {
                return $this->renderPartial('_create', [
                            'model' => $model,
                ]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing Installpayment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->response->format = 'json';

            return [
                "saved",
                Yii::$app->urlManager->baseUrl . "/index.php?r=finance/index",
                "Record Saved",
                "Record saved successfully"
            ];
        } else {

            $request = Yii::$app->request;

            if ($request->isAjax) {
                return $this->renderPartial('_update', [
                            'model' => $model,
                ]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        }
    }

    public function actionUpdateinstallments($id) {
        $model = \app\models\application\Fmsvoucher::find()->where(['voucher_id' => $id])->one(); // new Fmsvoucher();
        $modelreceipts = \app\models\application\Fmsvoucherplotdetail::find()->where(['voucher_id' => $id])->all(); // new Fmsvoucher();
        $modelreceiptdetail = \app\models\application\Installpayment::find()->joinWith("receipt")->where(['fms_voucher_plot_detail.voucher_id' => $id])->all();
        //$modelmember = null; //\app\models\application\Members::find()->where(['id' => $model->member_id])->one();
        if ($model->entry_status > 1) {
            if(Yii::$app->user->identity->roletype !=1) {
                //if($model->amount_type != 5)
                $this->redirect("index.php?r=finance/fmsvoucher/index");
            }
        }

//var_dump($modelreceiptdetail->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
        if ($model->load(Yii::$app->request->post())) {
            $modelreceipts = Model::createMultiple(\app\models\application\Fmsvoucherplotdetail::classname());
            Model::loadMultiple($modelreceipts, Yii::$app->request->post());

            $modelreceiptdetail = Model::createMultiple(\app\models\application\Installpayment::classname());
            Model::loadMultiple($modelreceiptdetail, Yii::$app->request->post());

            $var = \Yii::$app->request->post('submit');
            $result = false;

            if ($var == "Submit") {
                $result = $model->submitrecord($modelreceipts, $modelreceiptdetail);
            } else {
                $result = $model->updaterecord($modelreceipts, $modelreceiptdetail);
            }

            if ($result) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=finance/fmsvoucher/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
            //$modelmember = \app\models\application\Members::find()->where(['id' => $model->member_id])->one();
        }

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('_updateinstallments', [
                        'model' => $model,
                        //'modelmember' => $modelmember,
                        'modelreceipts' => $modelreceipts,
                        'modelreceiptdetail' => $modelreceiptdetail,
            ]);
        } else {
            return $this->render('updateinstallments', [
                        'model' => $model,
                        //'modelmember' => $modelmember,
                        'modelreceipts' => $modelreceipts,
                        'modelreceiptdetail' => $modelreceiptdetail,
            ]);
        }
    }

    public function actionPlotcustomizeinstallments($id, $sourcepage) {
        $model = \app\models\application\Installpayment::find()->where(['plot_id' => $id, 'trans_type' => 2])->orderBy('due_date')->all(); //$this->findModel($id);
        $plot = \app\models\application\Plots::find()->where(['id' => $id])->one();
        //$memberid = \app\models\application\Plots::find()->where(['id'=>$id])->one()->currentmembership->member_id;

        $request = Yii::$app->request;

        if ($plot->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();

            $valid = true;
            $model = \app\models\application\Installpayment::find()->where(['plot_id' => $id, 'trans_type' => 2])->andWhere(['or', ['paidamount' => NULL], ['paidamount' => 0]])->orderBy('due_date')->all(); //$this->findModel($id);

            $modeltemp = Model::createMultiple(\app\models\application\Installpayment::classname());
            Model::loadMultiple($modeltemp, Yii::$app->request->post());
            //Model::loadMultiple($model, Yii::$app->request->post());
//print_r($modeltemp);
//return;
            foreach ($data["Installpayment"] as $row) {
                foreach ($model as $payment) {
                    if ($payment->id == $row["id"]) {
                        $payment->lab = $row["lab"];
                        $payment->due_date = \Yii::$app->formatter->asDate($row["due_date"], 'php:Y-m-d');
                        $payment->remarks = $row["remarks"];
                        $payment->dueamount = floatval($row["dueamount"]);

                        if (isset($row["removerecord"])) {
                            $payment->removerecord = $row["removerecord"];
                        }
                    }
                }
            }

            foreach ($modeltemp as $row) {
                if ($row->id == 0) {
                    $newrec = new Installpayment();

                    $newrec->id = 0;
                    $newrec->plot_id = $plot->id; //$model->plan_id;
                    $newrec->lab = $row->lab;
                    $newrec->dueamount = floatval($row->dueamount);
                    $newrec->due_date = \Yii::$app->formatter->asDate($row->due_date, 'php:Y-m-d');
                    $newrec->remarks = $row->remarks;
                    $newrec->trans_type = 2;

                    //if (isset($row["removerecord"])) {
                    $newrec->removerecord = $row->removerecord;
                    //}

                    $model[] = $newrec;
                }
            }
//print_r($model);
//return;
            if ($plot->updatePlan($model, $modeltemp)) {
                \Yii::$app->response->format = 'json';
                return [
                    "saved",
                    str_replace("%26", "&", $data["sourcepage"]),
                    //Yii::$app->urlManager->baseUrl . "/index.php?r=finance/installpayment/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
            //return;
        }

        if ($request->isAjax) {
            return $this->renderPartial('_plotcustomizeinstallments', [
                        'model' => $model,
                        'plot' => $plot,
                        'sourcepage' => str_replace("&", "%26", $sourcepage),
            ]);
        } else {
            return $this->render('plotcustomizeinstallments', [
                        'model' => $model,
                        'plot' => $plot,
                        'sourcepage' => str_replace("&", "%26", $sourcepage),
                            //      'member' => $model,
            ]);
        }
    }

    public function actionDynamicrow($id) {
        return $this->renderPartial('_dynamicrow', ['id' => $id]);
    }

    public function actionDynamicinstallpaymentrow($id,$voucherdetialid,$plotid) {
        return $this->renderPartial('_dynamicinstallpaymentrow', ['id' => $id, 'voucher_detail_id' => $voucherdetialid, 'plotid' => $plotid]);
    }

    public function actionPlotinstallments($id, $sourcepage, $allowedit = "yes") {
        $model = Installpayment::find()->where(['plot_id' => $id, 'trans_type' => 2])->orderBy('due_date')->all(); //$this->findModel($id);
        $plot = \app\models\application\Plots::find()->where(['id' => $id])->one();
        //$memberid = \app\models\application\Plots::find()->where(['id'=>$id])->one()->currentmembership->member_id;
        $myrights = \app\models\Model::getRights("index", "installpayment", "finance");

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('_plotinstallments', [
                        'model' => $model,
                        'plot' => $plot,
                        'myrights' => $myrights,
                        'sourcepage' => $sourcepage,
                        'allowedit' => $allowedit,
            ]);
        } else {
            return $this->render('plotinstallments', [
                        'model' => $model,
                        'plot' => $plot,
                        'myrights' => $myrights,
                        'sourcepage' => $sourcepage,
                        'allowedit' => $allowedit,
                            //      'member' => $model,
            ]);
        }
    }

    public function actionPlotcharges($id, $sourcepage, $allowedit = "yes") {
        $model = Installpayment::find()->where(['plot_id' => $id, 'trans_type' => 1])->orderBy('due_date')->all(); //$this->findModel($id);
        $plot = \app\models\application\Plots::find()->where(['id' => $id])->one();
        $myrights = \app\models\Model::getRights("index", "installpayment", "finance");
        //$memberid = \app\models\application\Plots::find()->where(['id'=>$id])->one()->currentmembership->member_id;

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('_plotcharges', [
                        'model' => $model,
                        'plot' => $plot,
                        'myrights' => $myrights,
                        'sourcepage' => $sourcepage,
                        'allowedit' => $allowedit,
            ]);
        } else {
            return $this->render('plotcharges', [
                        'model' => $model,
                        'plot' => $plot,
                        'myrights' => $myrights,
                        'sourcepage' => $sourcepage,
                        'allowedit' => $allowedit,
                            //      'member' => $model,
            ]);
        }
    }

    public function actionAddplotcharges($id, $sourcepage) {
        $model = new Installpayment();
        $plot = \app\models\application\Plots::find()->where(['id' => $id])->one();
        $memberid = \app\models\application\Plots::find()->where(['id' => $id])->one()->currentmembership->member_id;
        $myrights = \app\models\Model::getRights("create", "installpayment", "finance");

        $model->plot_id = $plot->id;
        $model->mem_id = $memberid;
        $model->trans_type = 1;
        $model->due_date = date("d-m-Y");

        if ($model->load(Yii::$app->request->post())) {
            $model->due_date = \Yii::$app->formatter->asDate($model->due_date, 'php:Y-m-d'); // date("Y-m-d",  strtotime($model->application_date));

            if ($model->save()) {
                $data = Yii::$app->request->post();

                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    str_replace("%26", "&", $data["sourcepage"]),
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        }

        $request = Yii::$app->request;


        if ($request->isAjax) {
            return $this->renderPartial('addplotcharges', [
                        'model' => $model,
                        'plot' => $plot,
                        'memberid' => $memberid,
                        'myrights' => $myrights,
                        'sourcepage' => str_replace("&", "%26", $sourcepage),
            ]);
        } else {
            return $this->render('addplotcharges', [
                        'model' => $model,
                        'plot' => $plot,
                        'memberid' => $memberid,
                        'myrights' => $myrights,
                        'sourcepage' => str_replace("&", "%26", $sourcepage),
                            //      'member' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Installpayment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
     * Displays sidebar Installpayment model.
     * @return mixed
     */
    public function actionSidebarsummary() {
        $res = \app\models\Model::checksavedinfo(["r" => "finance/installpayment/index"]);
        $myrights = \app\models\Model::getRights("index", "installpayment", "finance");

        $searchModel = $searchModel = new InstallpaymentSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('_summarysearch', [
                    'searchModel' => $searchModel,
                    'myrights' => $myrights,
        ]);
    }

    /**
     * Displays sidebar Installpayment model.
     * @return mixed
     */
    public function actionSidebarinput() {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Installpayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Installpayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Installpayment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
