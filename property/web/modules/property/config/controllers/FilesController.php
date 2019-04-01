<?php

namespace app\modules\property\config\controllers;

use Yii;
use app\models\application\Files;
use app\models\application\FilesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * FilesController implements the CRUD actions for Files model.
 */
class FilesController extends Controller {

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
     * Lists all Files models.
     * @return mixed
     */
    public function actionIndex() {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "files", "property/config");

        $searchModel = new FilesSearch();
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
     * Displays printable version of summary Files model.
     * @return mixed
     */
    public function actionPrintsummary() {
        $this->layout = "@app/views/layouts/print";

        $searchModel = new FilesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('printsummary', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Files model.
     * @return mixed
     */
    public function actionPdfsummary() {
        $this->layout = "@app/views/layouts/print";

        $searchModel = new FilesSearch();
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
     * Displays a single Files model.
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
     * Creates a new Files model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new \app\models\application\Plots();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->response->format = 'json';

            return [
                "saved",
                Yii::$app->urlManager->baseUrl . "/index.php?r=property/config/files/index",
                "Record Saved",
                "Record saved successfully"
            ];
//            return $this->redirect(['index']);
        } else {

            $request = Yii::$app->request;
            $modellastid = \app\models\application\Plots::find()->max('id');

            if ($modellastid != null && $modellastid != 0) {
                $modellast = \app\models\application\Plots::find()->where(['id' => $modellastid])->one();
                $fileno = intval($modellast->plot_detail_address) + 1;

                $model->project_id = $modellast->project_id;
                $model->sector = $modellast->sector;
                $model->street_id = $modellast->street_id;
                $model->size2 = $modellast->size2;
                $model->com_res = $modellast->com_res;
                $model->price = $modellast->price;
                $model->plot_detail_address = str_pad($fileno, 5, "0", STR_PAD_LEFT);
                $model->plot_size = $modellast->plot_size;
            }

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
     * Updates an existing Files model.
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
                Yii::$app->urlManager->baseUrl . "/index.php?r=property/config/files/index",
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
     * Deletes an existing Files model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        if ($this->findModel($id)->delete()) {
            \Yii::$app->response->format = 'json';

            return [
                "Removed",
                Yii::$app->urlManager->baseUrl . "/index.php?r=property/config/files/index",
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
     * Displays sidebar Files model.
     * @return mixed
     */
    public function actionSidebarsummary() {
        $res = \app\models\Model::checksavedinfo(["r" => "property/config/files/index"]);
        $myrights = \app\models\Model::getRights("index", "files", "property/config");

        $searchModel = $searchModel = new FilesSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('_summarysearch', [
                    'searchModel' => $searchModel,
                    'myrights' => $myrights,
        ]);
    }

    /**
     * Displays sidebar Files model.
     * @return mixed
     */
    public function actionSidebarinput() {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Files model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Files the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \app\models\application\Plots::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCount($type, $project, $status, $size, $rescomm = "Residential") {
        $rescommn = ($rescomm == "1" || $rescomm == "Residential" || $rescomm == 1 ? "Residential" : "Commercial");

        $model = \app\models\application\Plots::find()->where(['type' => $type, 'project_id' => $project, 'size2' => $size, 'com_res' => $rescommn, 'status' => '']);

        //$model->andFilterWhere(['=', 'status', '']);
        $model = $model->select('id')->all();

        return count($model);
    }

    public function actionShowdetail($id) {
        $model = $this->findModel($id);

        return $this->renderPartial('_showdetail', [
                    'model' => $model,
        ]);
    }

    public function actionLastfile($projectid = 0, $plotsize = 0, $filetype = 0) {
        $modellastid = \app\models\application\Plots::find()->where(['project_id' => $projectid]);

        if ($plotsize != 0) {
            $modellastid->andFilterWhere(['size2' => $plotsize]);
        }

        if ($filetype != 0) {
            $modellastid->andFilterWhere(['com_res' => $filetype]);
        }

        $modellastid = $modellastid->max('id');

        \Yii::$app->response->format = 'json';

        if ($modellastid != null && $modellastid != 0) {
            $modellast = \app\models\application\Plots::find()->where(['id' => $modellastid])->one();
            $fileno = intval($modellast->plot_detail_address) + 1;

            return [
                "1",
                $modellast->size2,
                $modellast->com_res,
                $modellast->price,
                str_pad($fileno, 5, "0", STR_PAD_LEFT),
                $modellast->plot_size
            ];
        } else {
            return [
                "0",
            ];
        }
    }

    public function actionCharttest() {
        \Yii::$app->response->format = 'json';

//        return "{".
//                    "cols: [".
//                        "{id:'name',label:'Name',pattern:'',type:'string'},".
//                        "{id:'counta',label:'Count-A',pattern:'',type:'number'},".
//                        "{id:'countb',label:'Count-B',pattern:'',type:'number'}".
//                    "],".
//                    "rows: [".
//                            "{c:[{v:'Test-A'},{v:4},{v:3}]},".
//                            "{c:[{v:'Test-B'},{v:1},{v:2}]},".
//                            "{c:[{v:'Test-C'},{v:3},{v:4}]},".
//                            "{c:[{v:'Test-D'},{v:2},{v:0}]},".
//                            "{c:[{v:'Test-E'},{v:2},{v:5}]}".
//                          "]".
//                "}";
//
//        return [
//            ['Name', 'Count-A', 'Count-B'],
//            ['Test-A', 4, 3],
//            ['Test-B', 1, 2],
//            ['Test-C', 3, 4],
//            ['Test-D', 2, 0],
//            ['Test-E', 2, 5]
//        ];
        $col1=array();
    $col1["id"]="";
    $col1["label"]="Membership Type";
    $col1["pattern"]="";
    $col1["type"]="string";

    $col2=array();
    $col2["id"]="";
    $col2["label"]="Total";
    $col2["pattern"]="";
    $col2["type"]="number";

    $cols = array($col1,$col2);
    
    $rows=array();

        //foreach ($MembershipTotals AS $MembershipTotal) {  //foreach ($Event->TrainingTotals['ConfirmedTotal'] AS $Key => $Value) {
            $cell0["v"]="Row 1"; ///$MembershipTotal->Membership_Level_Name;
            $cell1["v"]=5; //intval($MembershipTotal->MemTotal);

        $row0["c"]=array($cell0,$cell1);
        array_push($rows, $row0);
        
            $cell0["v"]="Row 2"; ///$MembershipTotal->Membership_Level_Name;
            $cell1["v"]=7; //intval($MembershipTotal->MemTotal);

        $row0["c"]=array($cell0,$cell1);
        array_push($rows, $row0);
            $cell0["v"]="Row 3"; ///$MembershipTotal->Membership_Level_Name;
            $cell1["v"]=2; //intval($MembershipTotal->MemTotal);

        $row0["c"]=array($cell0,$cell1);
        array_push($rows, $row0);
            $cell0["v"]="Row 4"; ///$MembershipTotal->Membership_Level_Name;
            $cell1["v"]=4; //intval($MembershipTotal->MemTotal);

        $row0["c"]=array($cell0,$cell1);
        array_push($rows, $row0);
        //}

    $data=array("cols"=>$cols,"rows"=>$rows);
    echo json_encode($data);
    }

}
