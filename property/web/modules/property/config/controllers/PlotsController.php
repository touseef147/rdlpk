<?php

namespace app\modules\property\config\controllers;

use Yii;
use app\models\application\Plots;
use app\models\application\PlotsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * PlotsController implements the CRUD actions for Plots model.
 */
class PlotsController extends Controller {

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
     * Lists all Plots models.
     * @return mixed
     */
    public function actionIndex() {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "plots", "property/config");

        $searchModel = new PlotsSearch();
        $dataProvider = NULL;
        \app\models\Model::loaddata($dataProvider, $searchModel, $request, Yii::$app->request->queryParams);

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
     * Displays printable version of summary Plots model.
     * @return mixed
     */
    public function actionPrintsummary($allpages="yes", $resulttype="print") {
        if($resulttype == "print"){
            $this->layout = "@app/views/layouts/print";
        } else {
            $this->layout = "@app/views/layouts/exportcsv";
        }

        $request = Yii::$app->request;
        $searchModel = new PlotsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if($allpages=="yes"){
            $dataProvider->pagination = false;
        }

        return $this->render('printsummary', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Plots model.
     * @return mixed
     */
    public function actionPdfsummary() {
        $this->layout = "@app/views/layouts/print";

        $searchModel = new PlotsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination = false;

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
     * Displays a single Plots model.
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
     * Creates a new Plots model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Plots();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //  return $this->redirect(['index']);
            \Yii::$app->response->format = 'json';

            return [
                "saved",
                Yii::$app->urlManager->baseUrl . "/index.php?r=property/config/plots/index",
                "Record Saved",
                "Record saved successfully"
            ];
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
     * Updates an existing Plots model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //  return $this->redirect(['index']);
            \Yii::$app->response->format = 'json';

            return [
                "saved",
                Yii::$app->urlManager->baseUrl . "/index.php?r=property/config/plots/index",
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

    /**
     * Deletes an existing Plots model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        //  return $this->redirect(['index']);
        \Yii::$app->response->format = 'json';

        return [
            "saved",
            Yii::$app->urlManager->baseUrl . "/index.php?r=property/config/plots/index",
            "Record Saved",
            "Record saved successfully"
        ];
    }

    /**
     * Displays sidebar Plots model.
     * @return mixed
     */
    public function actionSidebarsummary() {
        $res = \app\models\Model::checksavedinfo(["r" => "property/config/plots/index"]);
        $myrights = \app\models\Model::getRights("index", "plots", "property/config");

        $searchModel = $searchModel = new PlotsSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('_summarysearch', [
                    'searchModel' => $searchModel,
                'myrights' => $myrights,
        ]);
    }

    /**
     * Displays sidebar Plots model.
     * @return mixed
     */
    public function actionSidebarinput() {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Plots model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Plots the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Plots::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Allot Plots model.
     * If allotment is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionAllot($id) {



        $model = $this->findModel($id);
        $modelpro = new \app\modules\property\config\models\Projects;
        $modelinsplan = new \app\modules\finance\models\Installmentplan;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelpro->load(Yii::$app->request->post());
            $modelinsplan->load(Yii::$app->request->post());
            $valid = true;

            if ($modelfollowup->validate() == true) {
                //   $hasvisitdetail=1;
            } else {
                $valid = FALSE;
            }
            //  return $this->redirect(['index']);
            \Yii::$app->response->format = 'json';

            return [
                "saved",
                Yii::$app->urlManager->baseUrl . "/index.php?r=property/config/plots/index",
                "Record Saved",
                "Record saved successfully"
            ];
        } else {

            $request = Yii::$app->request;

            if ($request->isAjax) {
                return $this->renderPartial('_allot', [
                            'model' => $model,
                            'modelpro' => $modelpro,
                            'modelinsplan' => $modelinsplan,
                ]);
            } else {
                return $this->render('allot', [
                            'model' => $model,
                ]);
            }
        }
    }

    public function actionDdcontrollersectors($id = 0) {
        $recs = \app\modules\property\config\models\Sectors::find()
                ->where(['id' => $id])
                ->orderBy('sector_name ASC')
                ->all();

        echo "<option value=''>Select a Sector</option>";

        foreach ($recs as $rec) {
            echo "<option value='" . $rec->id . "'>" . $rec->sector_name . "</option>";
        }
    }

    public function actionDdcontrollerstreets($id = 0) {
        $recs = \app\modules\property\config\models\Streets::find()
                ->where(['id' => $id])
                ->orderBy('street ASC')
                ->all();

        echo "<option value=''>Select a Street</option>";

        foreach ($recs as $rec) {
            echo "<option value='" . $rec->id . "'>" . $rec->street . "</option>";
        }
    }

}
