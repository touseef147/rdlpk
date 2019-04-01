<?php

namespace app\modules\finance\controllers;

if (!isset($_SESSION)) {
    session_start();
}

use Yii;
use app\models\application\Installmentplanmaster;
use app\models\application\InstallmentplanmasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use kartik\mpdf\Pdf;

/**
 * InstallmentplanmasterController implements the CRUD actions for Installmentplanmaster model.
 */
class InstallmentplanmasterController extends Controller {

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
     * Lists all Installmentplanmaster models.
     * @return mixed
     */
    public function actionIndex() {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "installmentplanmaster", "finance");

        $searchModel = new InstallmentplanmasterSearch();
        $dataProvider = NULL;

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
     * Displays printable version of summary Installmentplanmaster model.
     * @return mixed
     */
    public function actionPrintsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new InstallmentplanmasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('printsummary', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Installmentplanmaster model.
     * @return mixed
     */
    public function actionPdfsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new InstallmentplanmasterSearch();
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
     * Displays a single Installmentplanmaster model.
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
     * Creates a new Installmentplanmaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Installmentplanmaster();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->generatePlan()) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=finance/installmentplanmaster/update/" + $model->plan_id,
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        }

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

    /**
     * Updates an existing Installmentplanmaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modeldetail = \app\models\application\Installmentplandetail::find()->where(['plan_id' => $id])->all();

        $request = Yii::$app->request;

        if ($model->load(Yii::$app->request->post())) {
            $valid = true;

            $modeltemp = Model::createMultiple(\app\models\application\Installmentplandetail::classname());
            Model::loadMultiple($modeltemp, Yii::$app->request->post());

            Model::loadMultiple($modeldetail, Yii::$app->request->post());

            if ($model->updatePlan($modeldetail, $modeltemp)) {
                \Yii::$app->response->format = 'json';
                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=finance/installmentplanmaster/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        }

        if ($request->isAjax) {
            return $this->renderPartial('_update', [
                        'model' => $model,
                        'modeldetail' => $modeldetail,
            ]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'modeldetail' => $modeldetail,
            ]);
        }
    }

    /**
     * Deletes an existing Installmentplanmaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        if ($this->findModel($id)->delete()) {
            \Yii::$app->response->format = 'json';

            return [
                "Removed",
                Yii::$app->urlManager->baseUrl . "/index.php?r=finance/installmentplanmaster/index",
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
     * Displays sidebar Installmentplanmaster model.
     * @return mixed
     */
    public function actionSidebarsummary() {
        $res = \app\models\Model::checksavedinfo(["r" => "finance/installmentplanmaster/index"]);
        $myrights = \app\models\Model::getRights("index", "installmentplanmaster", "finance");

        $searchModel = new InstallmentplanmasterSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('_summarysearch', [
                    'searchModel' => $searchModel,
                'myrights' => $myrights,
        ]);
    }

    /**
     * Displays sidebar Installmentplanmaster model.
     * @return mixed
     */
    public function actionSidebarinput() {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Installmentplanmaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Installmentplanmaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Installmentplanmaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDynamicrow($id) {
        return $this->renderPartial('_dynamicrow', ['id' => $id]);
    }

    public function actionDropdown($projectid, $plotsize, $landtype, $propertyagainst, $isdev) {
        if ($propertyagainst != 3) {
            echo "<option value=''>N/A</option>";
            return;
        }

        $recs = null;

        if ($isdev == 0) {
            $recs=\app\models\application\Installmentplanmaster::find()
                    ->where(['project_id' => $projectid, 'category_id' => $plotsize, 'plan_land_type' => $landtype])
                    ->andWhere(['!=','plan_development_type','2'])
                    ->orderBy('no_of_installments ASC')
                    ->all();
        } else {
            $recs=\app\models\application\Installmentplanmaster::find()
                    ->where(['project_id' => $projectid, 'category_id' => $plotsize, 'plan_land_type' => $landtype,'plan_development_type'=>2])
                    ->orderBy('no_of_installments ASC')
                    ->all();
        }

        echo "<option value=''>Select a Plan</option>";

        foreach ($recs as $rec) {
            echo "<option value='" . $rec->plan_id . "'>" . $rec->description . "</option>";
        }
    }

}
