<?php

namespace app\modules\property\membership\controllers;

if (!isset($_SESSION)) {
    session_start();
}

use Yii;
use app\models\application\Propertymemberships;
use app\models\application\PropertymembershipsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * MembershipsController implements the CRUD actions for Propertymemberships model.
 */
class MembershipsController extends Controller {

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
        return parent::beforeAction($action);
    }

    /**
     * Lists all Propertymemberships models.
     * @return mixed
     */
    public function actionIndex() {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "memberships", "property/membership");

        $searchModel = new PropertymembershipsSearch();
        $dataProvider = NULL;

        if (count(Yii::$app->request->queryParams) == 1) {
            $res = \app\models\Model::checksavedinfo(Yii::$app->request->queryParams);

            if ($res == NULL) {
                $dataProvider = $searchModel->searchmemberships(Yii::$app->request->queryParams);

                $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
                $dataProvider->pagination->page = $request->get("pageno", 0);
            } else {
                $dataProvider = $searchModel->searchmemberships($res);

                $dataProvider->pagination->pageSize = (isset($res["pagesize"]) ? $res["pagesize"] : 20); //$request->get("pagesize", 20);
                $dataProvider->pagination->page = (isset($res["pageno"]) ? $res["pageno"] : 0); //$request->get("pagesize", 20);
            }
        } else {
            \app\models\Model::savebrowsinginfo();

            $dataProvider = $searchModel->searchmemberships(Yii::$app->request->queryParams);

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
     * Displays printable version of summary Propertymemberships model.
     * @return mixed
     */
    public function actionPrintsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new PropertymembershipsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('printsummary', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Propertymemberships model.
     * @return mixed
     */
    public function actionPdfsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new PropertymembershipsSearch();
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
     * Displays a single Propertymemberships model.
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
     * Creates a new Propertymemberships model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Propertymemberships();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->response->format = 'json';

            return [
                "saved",
                Yii::$app->urlManager->baseUrl . "/index.php?r=property/membership/memberships/index",
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
     * Updates an existing Propertymemberships model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->submit()) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=property/membership/memberships/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        }

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

    /**
     * Deletes an existing Propertymemberships model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        if ($this->findModel($id)->delete()) {
            \Yii::$app->response->format = 'json';

            return [
                "Removed",
                Yii::$app->urlManager->baseUrl . "/index.php?r=property/membership/memberships/index",
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
     * Displays sidebar Propertymemberships model.
     * @return mixed
     */
    public function actionSidebarsummary() {
        $res = \app\models\Model::checksavedinfo(["r" => "property/memberships/membership/index"]);

        $searchModel = new PropertymembershipsSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('_summarysearch', [
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays sidebar Propertymemberships model.
     * @return mixed
     */
    public function actionSidebarinput() {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Propertymemberships model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Propertymemberships the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Propertymemberships::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionFiledetails($id) {
        $model = \app\models\application\Propertymemberships::find()->where(['ms_id' => $id])->one();

        \Yii::$app->response->format = 'json';

        return [
            $model->plot_id,
        ];
    }

    public function actionPlotmemberships($id) {
        $model = Propertymemberships::find()->where(['plot_id' => $id])->orderBy('created_on')->all(); //$this->findModel($id);
        $plot = \app\models\application\Plots::find()->where(['id' => $id])->one();
        //$memberid = \app\models\application\Plots::find()->where(['id'=>$id])->one()->currentmembership->member_id;

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('_plotmemberships', [
                        'model' => $model,
                        'plot' => $plot,
            ]);
        } else {
            return $this->render('plotmemberships', [
                        'model' => $model,
                        'plot' => $plot,
                            //      'member' => $model,
            ]);
        }
    }

    public function actionPlotpaymentdetails($id) {
        $model = \app\models\application\Installpayment::find()->where(['plot_id' => $id])->orderBy('due_date')->all(); //$this->findModel($id);
        $plot = \app\models\application\Plots::find()->where(['id' => $id])->one();
        //$memberid = \app\models\application\Plots::find()->where(['id'=>$id])->one()->currentmembership->member_id;

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('_plotpaymentdetails', [
                        'model' => $model,
                        'plot' => $plot,
            ]);
        } else {
            return $this->render('plotpaymentdetails', [
                        'model' => $model,
                        'plot' => $plot,
                            //      'member' => $model,
            ]);
        }
    }

    public function actionFinancever() {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("financever", "memberships", "property/membership");

        $searchModel = new PropertymembershipsSearch();
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

    public function actionApproval() {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("approval", "memberships", "property/membership");

        $searchModel = new PropertymembershipsSearch();
        $dataProvider = NULL;

        if (count(Yii::$app->request->queryParams) == 1) {
            $res = \app\models\Model::checksavedinfo(Yii::$app->request->queryParams);

            if ($res == NULL) {
                $dataProvider = $searchModel->searchapproval(Yii::$app->request->queryParams);

                $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
                $dataProvider->pagination->page = $request->get("pageno", 0);
            } else {
                $dataProvider = $searchModel->searchapproval($res);

                $dataProvider->pagination->pageSize = (isset($res["pagesize"]) ? $res["pagesize"] : 20); //$request->get("pagesize", 20);
                $dataProvider->pagination->page = (isset($res["pageno"]) ? $res["pageno"] : 0); //$request->get("pagesize", 20);
            }
        } else {
            \app\models\Model::savebrowsinginfo();

            $dataProvider = $searchModel->searchapproval(Yii::$app->request->queryParams);

            $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
            $dataProvider->pagination->page = $request->get("pageno", 0);
        }

        if ($request->isAjax) {
            return $this->renderPartial('_approval', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'myrights' => $myrights,
            ]);
        } else {
            return $this->render('approval', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'myrights' => $myrights,
            ]);
        }
    }

    public function actionFinanceverdetail($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $var = \Yii::$app->request->post('submit');
            $result = false;

            if ($var == "submit") {
                $result = $model->verify();
            } else {
                $result = $model->hold();
            }

            if ($result) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=property/membership/memberships/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        }

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('financeverdetail', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('financeverdetail', [
                        'model' => $model,
            ]);
        }
    }

    public function actionApprovaldetail($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->approve()) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=property/membership/memberships/approval",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        }

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('approvaldetail', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('approvaldetail', [
                        'model' => $model,
            ]);
        }
    }

    public function actionCancelmembership($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $var = \Yii::$app->request->post('submit');
            $result = false;

            //if ($var == "submit") {
                $result = $model->cancel();
//            } else {
//                $result = $model->hold();
//            }

            if ($result) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=property/membership/memberships/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        }

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('cancelmembership', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('cancelmembership', [
                        'model' => $model,
            ]);
        }
    }

    public function actionComments($id = 0, $type = 0) {
        $model = \app\models\application\Propertymembershipcomments::find()->where(['ms_id' => $id, 'generated_by' => $type])->all();
        return $this->renderPartial('comments', [
                    'model' => $model,
        ]);
    }

    public function actionUpdatecomments() {
        $model = new \app\models\application\Propertymembershipcomments();
        $data = Yii::$app->request->post();

        $model->ms_id = $data["comment_box_parent_id"];
        $model->comments = $data["comment_message"];
        $model->generated_by = 0;     //user

        if ($model->updaterecord()) {
            \Yii::$app->response->format = 'json';

            return [
                "saved",
                Yii::$app->urlManager->baseUrl . "/index.php?r=property/membership/memberships/comments&id=" . $data["comment_box_parent_id"],
                "Record Saved",
                "Record saved successfully"
            ];
        }
        return NULL;
    }

}
