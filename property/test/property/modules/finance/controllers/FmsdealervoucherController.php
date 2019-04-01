<?php

namespace app\modules\finance\controllers;

use Yii;
use app\models\application\Fmsvoucher;
use app\models\application\FmsvoucherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use app\models\Model;

/**
 * FmsvoucherController implements the CRUD actions for Fmsvoucher model.
 */
class FmsdealervoucherController extends Controller {

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
     * Lists all Fmsvoucher models.
     * @return mixed
     */
    public function actionIndex() {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "fmsvoucher", "finance");

        $searchModel = new FmsvoucherSearch();
        $dataProvider = NULL;

        if (count(Yii::$app->request->queryParams) == 1) {
            $res = \app\models\Model::checksavedinfo(Yii::$app->request->queryParams);

            if ($res == NULL) {
                $dataProvider = $searchModel->searchdealers(Yii::$app->request->queryParams);

                $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
                $dataProvider->pagination->page = $request->get("pageno", 0);
            } else {
                $dataProvider = $searchModel->searchdealers($res);

                $dataProvider->pagination->pageSize = (isset($res["pagesize"]) ? $res["pagesize"] : 20); //$request->get("pagesize", 20);
                $dataProvider->pagination->page = (isset($res["pageno"]) ? $res["pageno"] : 0); //$request->get("pagesize", 20);
            }
        } else {
            \app\models\Model::savebrowsinginfo();

            $dataProvider = $searchModel->searchdealers(Yii::$app->request->queryParams);

            $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
            $dataProvider->pagination->page = $request->get("pageno", 0);
        }

        if ($request->isAjax) {
            return $this->renderPartial('index', [
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

    public function actionCenterverification() {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("centerverification", "fmsvoucher", "finance");

        $searchModel = new FmsvoucherSearch();
        $dataProvider = NULL;

        if (count(Yii::$app->request->queryParams) == 1) {
            $res = \app\models\Model::checksavedinfo(Yii::$app->request->queryParams);

            if ($res == NULL) {
                $dataProvider = $searchModel->searchcenterverification(Yii::$app->request->queryParams);

                $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
                $dataProvider->pagination->page = $request->get("pageno", 0);
            } else {
                $dataProvider = $searchModel->searchcenterverification($res);

                $dataProvider->pagination->pageSize = (isset($res["pagesize"]) ? $res["pagesize"] : 20); //$request->get("pagesize", 20);
                $dataProvider->pagination->page = (isset($res["pageno"]) ? $res["pageno"] : 0); //$request->get("pagesize", 20);
            }
        } else {
            \app\models\Model::savebrowsinginfo();

            $dataProvider = $searchModel->searchcenterverification(Yii::$app->request->queryParams);

            $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
            $dataProvider->pagination->page = $request->get("pageno", 0);
        }

        if ($request->isAjax) {
            return $this->renderPartial('_centerverification', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'myrights' => $myrights,
            ]);
        } else {
            return $this->render('centerverification', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'myrights' => $myrights,
            ]);
        }
    }

    public function actionFinanceverification() {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("financeverification", "fmsvoucher", "finance");

        $searchModel = new FmsvoucherSearch();
        $dataProvider = NULL;

        if (count(Yii::$app->request->queryParams) == 1) {
            $res = \app\models\Model::checksavedinfo(Yii::$app->request->queryParams);

            if ($res == NULL) {
                $dataProvider = $searchModel->searchfinanceverification(Yii::$app->request->queryParams);

                $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
                $dataProvider->pagination->page = $request->get("pageno", 0);
            } else {
                $dataProvider = $searchModel->searchfinanceverification($res);

                $dataProvider->pagination->pageSize = (isset($res["pagesize"]) ? $res["pagesize"] : 20); //$request->get("pagesize", 20);
                $dataProvider->pagination->page = (isset($res["pageno"]) ? $res["pageno"] : 0); //$request->get("pagesize", 20);
            }
        } else {
            \app\models\Model::savebrowsinginfo();

            $dataProvider = $searchModel->searchfinanceverification(Yii::$app->request->queryParams);

            $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
            $dataProvider->pagination->page = $request->get("pageno", 0);
        }

        if ($request->isAjax) {
            return $this->renderPartial('_financeverification', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'myrights' => $myrights,
            ]);
        } else {
            return $this->render('financeverification', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'myrights' => $myrights,
            ]);
        }
    }

    public function actionFinanceapproval() {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("financeapproval", "fmsvoucher", "finance");

        $searchModel = new FmsvoucherSearch();
        $dataProvider = NULL;

        if (count(Yii::$app->request->queryParams) == 1) {
            $res = \app\models\Model::checksavedinfo(Yii::$app->request->queryParams);

            if ($res == NULL) {
                $dataProvider = $searchModel->searchfinanceapproval(Yii::$app->request->queryParams);

                $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
                $dataProvider->pagination->page = $request->get("pageno", 0);
            } else {
                $dataProvider = $searchModel->searchfinanceapproval($res);

                $dataProvider->pagination->pageSize = (isset($res["pagesize"]) ? $res["pagesize"] : 20); //$request->get("pagesize", 20);
                $dataProvider->pagination->page = (isset($res["pageno"]) ? $res["pageno"] : 0); //$request->get("pagesize", 20);
            }
        } else {
            \app\models\Model::savebrowsinginfo();

            $dataProvider = $searchModel->searchfinanceapproval(Yii::$app->request->queryParams);

            $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
            $dataProvider->pagination->page = $request->get("pageno", 0);
        }

        if ($request->isAjax) {
            return $this->renderPartial('_financeapproval', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'myrights' => $myrights,
            ]);
        } else {
            return $this->render('financeapproval', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'myrights' => $myrights,
            ]);
        }
    }

    /**
     * Displays printable version of summary Fmsvoucher model.
     * @return mixed
     */
    public function actionPrintsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new FmsvoucherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('printsummary', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Fmsvoucher model.
     * @return mixed
     */
    public function actionPdfsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new FmsvoucherSearch();
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
     * Displays a single Fmsvoucher model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        $this->layout = false;
        
        $model = Fmsvoucher::find()->where(['voucher_id' => $id])->one(); // new Fmsvoucher();
//        $modelreceipts = \app\models\application\Fmsvoucherplotdetail::find()->where(['voucher_id' => $id])->all(); // new Fmsvoucher();
//        $modelreceiptdetail = \app\models\application\Installpayment::find()->joinWith("receipt")->where(['fms_voucher_plot_detail.voucher_id' => $id])->all();
//        $modelmember = \app\models\application\Members::find()->where(['id' => $model->member_id])->one();

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('view', [
                        'model' => $model,
//                        'modelmember' => $modelmember,
//                        'modelreceipts' => $modelreceipts,
//                        'modelreceiptdetail' => $modelreceiptdetail,
            ]);
        } else {
            return $this->render('view', [
                        'model' => $model,
//                        'modelmember' => $modelmember,
//                        'modelreceipts' => $modelreceipts,
//                        'modelreceiptdetail' => $modelreceiptdetail,
            ]);
        }
    }

    public function actionCenterverdetail($id) {
        $model = Fmsvoucher::find()->where(['voucher_id' => $id])->one(); // new Fmsvoucher();
        $modelreceipts = \app\models\application\Fmsvoucherplotdetail::find()->where(['voucher_id' => $id])->all(); // new Fmsvoucher();
        $modelreceiptdetail = \app\models\application\Installpayment::find()->joinWith("receipt")->where(['fms_voucher_plot_detail.voucher_id' => $id])->all();
        $modelmember = \app\models\application\Members::find()->where(['id' => $model->member_id])->one();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->forwardrecord()) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=finance/fmsdealervoucher/centerverification",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        } 

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('centerverdetail', [
                        'model' => $model,
                        'modelmember' => $modelmember,
                        'modelreceipts' => $modelreceipts,
                        'modelreceiptdetail' => $modelreceiptdetail,
            ]);
        } else {
            return $this->render('centerverdetail', [
                        'model' => $model,
                        'modelmember' => $modelmember,
                        'modelreceipts' => $modelreceipts,
                        'modelreceiptdetail' => $modelreceiptdetail,
            ]);
        }
    }

    public function actionFinanceverdetail($id) {
        $model = Fmsvoucher::find()->where(['voucher_id' => $id])->one(); // new Fmsvoucher();
        $modelreceipts = \app\models\application\Fmsvoucherplotdetail::find()->where(['voucher_id' => $id])->all(); // new Fmsvoucher();
        $modelreceiptdetail = \app\models\application\Installpayment::find()->joinWith("receipt")->where(['fms_voucher_plot_detail.voucher_id' => $id])->all();
        $modelmember = \app\models\application\Members::find()->where(['id' => $model->member_id])->one();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->verifyrecord()) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=finance/fmsdealervoucher/financeverification",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        } 

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('financeverdetail', [
                        'model' => $model,
                        'modelmember' => $modelmember,
                        'modelreceipts' => $modelreceipts,
                        'modelreceiptdetail' => $modelreceiptdetail,
            ]);
        } else {
            return $this->render('financeverdetail', [
                        'model' => $model,
                        'modelmember' => $modelmember,
                        'modelreceipts' => $modelreceipts,
                        'modelreceiptdetail' => $modelreceiptdetail,
            ]);
        }
    }

    public function actionFinanceappdetail($id) {
        $model = Fmsvoucher::find()->where(['voucher_id' => $id])->one(); // new Fmsvoucher();
        $modelreceipts = \app\models\application\Fmsvoucherplotdetail::find()->where(['voucher_id' => $id])->all(); // new Fmsvoucher();
        $modelreceiptdetail = \app\models\application\Installpayment::find()->joinWith("receipt")->where(['fms_voucher_plot_detail.voucher_id' => $id])->all();
        $modelmember = \app\models\application\Members::find()->where(['id' => $model->member_id])->one();


        if ($model->load(Yii::$app->request->post())) {
            if ($model->approverecord()) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=finance/fmsdealervoucher/financeapproval",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        } 
        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('financeappdetail', [
                        'model' => $model,
                        'modelmember' => $modelmember,
                        'modelreceipts' => $modelreceipts,
                        'modelreceiptdetail' => $modelreceiptdetail,
            ]);
        } else {
            return $this->render('financeappdetail', [
                        'model' => $model,
                        'modelmember' => $modelmember,
                        'modelreceipts' => $modelreceipts,
                        'modelreceiptdetail' => $modelreceiptdetail,
            ]);
        }
    }
    
    /**
     * Creates a new Fmsvoucher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = 0) {
        $model = new Fmsvoucher();
        $modelreceipts = null; //\app\models\application\Fmsvoucherplotdetail::find()->where(['voucher_plot_detail_id' => 0])->all(); //new \app\models\application\Fmsvoucherplotdetail();
        $modelreceiptdetail = null; //\app\models\application\Installpayment::find()->where(['id' => 0])->all(); //new \app\models\application\Installpayment();
        $modelmember = \app\models\application\Members::find()->where(['id' => $id])->one();

        if ($model->load(Yii::$app->request->post())) {
            $modelreceipts = Model::createMultiple(\app\models\application\Fmsvoucherplotdetail::classname());
            Model::loadMultiple($modelreceipts, Yii::$app->request->post());

            $modelreceiptdetail = Model::createMultiple(\app\models\application\Installpayment::classname());
            Model::loadMultiple($modelreceiptdetail, Yii::$app->request->post());

            if ($model->updatedealerrecord($modelreceipts, $modelreceiptdetail)) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=members/dealers/dealers/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }

            $modelmember = \app\models\application\Members::find()->where(['id' => $model->member_id])->one();
        } else {
            $model->member_id = $id;
            $model->entry_date = date("d-m-Y");
            $model->amount_type = ($modelmember->is_dealer == 1 ? 5 : NULL);
        }

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('_create', [
                        'model' => $model,
                        'modelmember' => $modelmember,
                        'modelreceipts' => $modelreceipts,
                        'modelreceiptdetail' => $modelreceiptdetail,
            ]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'modelmember' => $modelmember,
                        'modelreceipts' => $modelreceipts,
                        'modelreceiptdetail' => $modelreceiptdetail,
            ]);
        }
    }

    /**
     * Updates an existing Fmsvoucher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = Fmsvoucher::find()->where(['voucher_id' => $id])->one(); // new Fmsvoucher();
        $modelreceipts = \app\models\application\Fmsvoucherplotdetail::find()->where(['voucher_id' => $id])->all(); // new Fmsvoucher();
        $modelreceiptdetail = \app\models\application\Installpayment::find()->joinWith("receipt")->where(['fms_voucher_plot_detail.voucher_id' => $id])->all();
        $modelmember = \app\models\application\Members::find()->where(['id' => $model->member_id])->one();

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
                $result = $model->updatedealerrecord($modelreceipts, $modelreceiptdetail);
            }

            if ($result) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=finance/fmsdealervoucher/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }

            $modelmember = \app\models\application\Members::find()->where(['id' => $model->member_id])->one();
        }

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('_update', [
                        'model' => $model,
                        'modelmember' => $modelmember,
                        'modelreceipts' => $modelreceipts,
                        'modelreceiptdetail' => $modelreceiptdetail,
            ]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'modelmember' => $modelmember,
                        'modelreceipts' => $modelreceipts,
                        'modelreceiptdetail' => $modelreceiptdetail,
            ]);
        }
    }

    /**
     * Deletes an existing Fmsvoucher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        if ($this->findModel($id)->delete()) {
            \Yii::$app->response->format = 'json';

            return [
                "Removed",
                Yii::$app->urlManager->baseUrl . "/index.php?r=finance/fmsdealervoucher/index",
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
     * Displays sidebar Fmsvoucher model.
     * @return mixed
     */

    public function actionSidebarsummary() {
        $res = \app\models\Model::checksavedinfo(["r" => "finance/fmsdealervoucher/index"]);
        $myrights = \app\models\Model::getRights("index", "fmsvoucher", "finance");

        $searchModel = new FmsvoucherSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('_summarysearch', [
                    'searchModel' => $searchModel,
                    'myrights' => $myrights,
        ]);
    }

    public function actionSidebarcenterversearch() {
        $res = \app\models\Model::checksavedinfo(["r" => "finance/fmsdealervoucher/centerverification"]);
        $myrights = \app\models\Model::getRights("centerverification", "fmsvoucher", "finance");

        $searchModel = new FmsvoucherSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('sidebarcenterversearch', [
                    'searchModel' => $searchModel,
                    'myrights' => $myrights,
        ]);
    }

    public function actionSidebarfinappsearch() {
        $res = \app\models\Model::checksavedinfo(["r" => "finance/fmsdealervoucher/financeapproval"]);
        $myrights = \app\models\Model::getRights("financeapproval", "fmsvoucher", "finance");

        $searchModel = new FmsvoucherSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('sidebarfinappsearch', [
                    'searchModel' => $searchModel,
                    'myrights' => $myrights,
        ]);
    }

    public function actionSidebarfinversearch() {
        $res = \app\models\Model::checksavedinfo(["r" => "finance/fmsdealervoucher/financeverification"]);
        $myrights = \app\models\Model::getRights("financeverification", "fmsvoucher", "finance");

        $searchModel = new FmsvoucherSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('sidebarfinversearch', [
                    'searchModel' => $searchModel,
                    'myrights' => $myrights,
        ]);
    }

    /**
     * Displays sidebar Fmsvoucher model.
     * @return mixed
     */
    public function actionSidebarinput() {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Fmsvoucher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Fmsvoucher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Fmsvoucher::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDynamicform($id, $id2, $extras, $mode) {
        return $this->renderPartial('_dynamicform', ['id' => $id, 'id2' => $id2, 'memberid' => $extras, 'mode' => $mode]);
    }

    public function actionDynamicformcontent($id, $index, $mode) {
        $model = \app\models\application\Propertyapplication::findOne($id);
        $modelreceipt = new \app\models\application\Fmsvoucherplotdetail();
        //$modelreceipt->plot_id

        return $this->renderPartial('_dynamicformcontent', [
                    'id' => $id,
                    'idx' => $index,
                    'model' => $model,
                    'mode' => $mode,
        ]);
    }

    public function actionDynamicinstallment($id, $id2, $extras, $mode) {
        return $this->renderPartial('_dynamicinstallment', ['id' => $id, 'id2' => $id2, 'memberid' => $extras, 'mode' => $mode]);
    }

    public function actionDynamicinstformcontent($id, $index, $mode) {
        $model = \app\models\application\Propertymemberships::findOne($id);
        $modelreceipt = new \app\models\application\Fmsvoucherplotdetail();
        //$modelreceipt->plot_id

        return $this->renderPartial('_dynamicinstformcontent', [
                    'id' => $id,
                    'idx' => $index,
                    'model' => $model,
                    'mode' => $mode,
        ]);
    }

    public function actionDynamicinstallpaymentrow($id, $tag, $source, $gtotalidx, $mode) {
        $model = new \app\models\application\Installpayment(); // \app\models\application\Files::findOne($fileid);
        $file = null;

        if ($source == 1) {
            $file = \app\models\application\Plots::find()->where(['application_id' => $tag])->one();
        } elseif ($source == 2) {
            $file = \app\models\application\Plots::find()->where(['ms_id' => $tag])->one();
        }

        return $this->renderPartial('_dynamicinstallpaymentrow', [
                    'id' => $id,
                    'idx' => $gtotalidx,
                    'source' => $source,
                    'file' => $file,
                    'model' => $model,
                    'mode' => $mode,
        ]);
    }

    public function actionDynamictransfer($id, $id2, $extras) {
        return $this->renderPartial('_dynamictransfer', ['id' => $id, 'id2' => $id2, 'memberid' => $extras]);
    }

    public function actionInstallpaymentdetail($id) {
        $model = \app\models\application\Installpayment::find()->where(['id' => $id])->one();

        \Yii::$app->response->format = 'json';

        return [
            $model->trans_type,
            $model->lab,
            date("d-m-Y", strtotime($model->due_date)),
            number_format($model->dueamount),
            $model->paidamount,
            $model->remarks,
            $model->dueamount,
        ];
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

                if ($member != NULL) {
                    return $this->actionCreate($member->id);
                } else {
                    $model->addError('cnic', 'Member not found.');
                    $valid = FALSE;
                }
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
        $model = \app\models\application\Fmsvouchercomments::find()->where(['voucher_id' => $id, 'generated_by' => $type])->all();
        return $this->renderPartial('comments', [
                    'model' => $model,
        ]);
    }

    public function actionUpdatecomments() {
        $model = new \app\models\application\Fmsvouchercomments();
        $data = Yii::$app->request->post();

        $model->voucher_id = $data["comment_box_parent_id"];
        $model->comments = $data["comment_message"];
        $model->generated_by = 0;     //user

        if ($model->updaterecord()) {
            \Yii::$app->response->format = 'json';

            return [
                "saved",
                Yii::$app->urlManager->baseUrl . "/index.php?r=finance/fmsdealervoucher/comments&id=" . $data["comment_box_parent_id"],
                "Record Saved",
                "Record saved successfully"
            ];
        }
        return NULL;
    }

    public function actionCount() {
        $model = \app\models\application\Fmsvoucher::find()->select('voucher_id')->all();

        return count($model);
    }

}
