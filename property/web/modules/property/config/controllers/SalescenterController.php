<?php

namespace app\modules\property\config\controllers;

use Yii;
use app\models\application\Salescenter;
use app\models\application\SalescenterSearch;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use kartik\mpdf\Pdf;

/**
 * SalescenterController implements the CRUD actions for Salescenter model.
 */
class SalescenterController extends Controller
{
    public function behaviors()
    {
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
     * Lists all Salescenter models.
     * @return mixed
     */
    public function actionIndex()
    {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "salescenter", "property/config");
        
        $searchModel = new SalescenterSearch();
        $dataProvider=NULL;
        \app\models\Model::loaddata($dataProvider, $searchModel, $request, Yii::$app->request->queryParams);
        
        if($request->isAjax)
        {
            return $this->renderPartial('_index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'myrights'=>$myrights,
            ]);
        }
        else
        {
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'myrights'=>$myrights,
            ]);
        }
    }

    /**
     * Displays printable version of summary Salescenter model.
     * @return mixed
     */
    public function actionPrintsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $searchModel = new SalescenterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->pagination=false;
        
        return $this->render('printsummary',[
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Salescenter model.
     * @return mixed
     */
    public function actionPdfsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $searchModel = new SalescenterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->pagination=false;
        
        $pdf = new Pdf([
                'content'=>$this->render('printsummary',[
                                'dataProvider' => $dataProvider,
                                ]),
                'filename'=> "report.pdf",
                'mode'=> Pdf::MODE_CORE,
                'format'=> Pdf::FORMAT_A4,
                'destination'=> Pdf::DEST_DOWNLOAD
                ]);
        return $pdf->render();
    }

    /**
     * Displays a single Salescenter model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $request = Yii::$app->request;

        if($request->isAjax)
        {
            return $this->renderPartial('_view', [
                'model' => $this->findModel($id),
            ]);
        }
        else
        {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Salescenter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Salescenter();
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            
            if($model->updaterecord())
            {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=property/config/salescenter/index",
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
     * Updates an existing Salescenter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

         if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            
            if($model->updaterecord())
            {
                \Yii::$app->response->format = 'json';
                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=property/config/salescenter/index",
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
     * Deletes an existing Salescenter model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

      \Yii::$app->response->format = 'json';

            return [
                    "saved",
                    Yii::$app->urlManager->baseUrl."/index.php?r=property/config/salescenter/index",
                    "Record Saved",
                    "Record saved successfully"
                ];      
    }

    /**
     * Displays sidebar Salescenter model.
     * @return mixed
     */
    public function actionSidebarsummary()
    {
        $res = \app\models\Model::checksavedinfo(["r"=>"property/config/salescenter/index"]);
        $myrights = \app\models\Model::getRights("index", "salescenter", "property/config");
        
        $searchModel=$searchModel= new SalescenterSearch();
        $searchModel->loadparams($res);
        
        return $this->renderPartial('_summarysearch', [
                'searchModel' => $searchModel,
                'myrights' => $myrights,
            ]);
    }

    /**
     * Displays sidebar Salescenter model.
     * @return mixed
     */
    public function actionSidebarinput()
    {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Salescenter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Salescenter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Salescenter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
