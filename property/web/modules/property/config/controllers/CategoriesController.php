<?php

namespace app\modules\property\config\controllers;

use Yii;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\models\application\Categories;
use app\models\application\CategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends Controller {

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
     * Lists all Categories models.
     * @return mixed
     */
    public function actionIndex() {

        $request = Yii::$app->request;

        $searchModel = new CategoriesSearch();
        $dataProvider = NULL;
        $myrights = \app\models\Model::getRights("index", "categories", "property/config");
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
     * Displays printable version of summary Categories model.
     * @return mixed
     */
    public function actionPrintsummary() {
        $this->layout = "@app/views/layouts/print";

        $searchModel = new CategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination = false;

        return $this->render('printsummary', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Categories model.
     * @return mixed
     */
    public function actionPdfsummary() {
        $this->layout = "@app/views/layouts/print";

        $searchModel = new CategoriesSearch();
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
     * Displays a single Categories model.
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
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Categories();

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            
            if($model->updaterecord())
            {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=property/config/categories/index",
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
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            
            if($model->updaterecord())
            {
                \Yii::$app->response->format = 'json';
                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=property/config/categories/index",
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
     * Deletes an existing Categories model.
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
            Yii::$app->urlManager->baseUrl . "/index.php?r=property/config/categories/index",
            "Record Saved",
            "Record saved successfully"
        ];
    }

    /**
     * Displays sidebar Categories model.
     * @return mixed
     */
    public function actionSidebarsummary() {
        $res = \app\models\Model::checksavedinfo(["r" => "property/config/categories/index"]);
        $myrights = \app\models\Model::getRights("index", "categories", "property/config");

        $searchModel = $searchModel = new CategoriesSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('_summarysearch', [
                    'searchModel' => $searchModel,
                    'myrights' => $myrights,
        ]);
    }

    /**
     * Displays sidebar Categories model.
     * @return mixed
     */
    public function actionSidebarinput() {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
