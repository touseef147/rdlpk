<?php

namespace app\modules\general\controllers;

use Yii;
use app\models\application\Latestnews;
use app\models\application\LatestnewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use kartik\mpdf\Pdf;

/**
 * LatestnewsController implements the CRUD actions for Latestnews model.
 */
class LatestnewsController extends Controller
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
        if (Yii::$app->user->id == null) {
            $this->redirect("index.php");
        } else {
            return parent::beforeAction($action);
        }
    }
    
    /**
     * Lists all Latestnews models.
     * @return mixed
     */
    public function actionIndex()
    {

        $request = Yii::$app->request;
        
        $searchModel = new LatestnewsSearch();
        $dataProvider=NULL;
        $myrights = \app\models\Model::getRights("index", "latestnews", "general");

        if(count(Yii::$app->request->queryParams)==1)
        {
            $res = \app\models\Model::checksavedinfo(Yii::$app->request->queryParams);

            if($res==NULL)
            {
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
                $dataProvider->pagination->page = $request->get("pageno", 0);
            }
            else
            {
                $dataProvider = $searchModel->search($res);
                
                $dataProvider->pagination->pageSize = (isset($res["pagesize"])? $res["pagesize"] : 20); //$request->get("pagesize", 20);
                $dataProvider->pagination->page = (isset($res["pageno"])? $res["pageno"] : 0); //$request->get("pagesize", 20);
            }
        }
        else
        {
            \app\models\Model::savebrowsinginfo();
            
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
            $dataProvider->pagination->page = $request->get("pageno", 0);
        }   
        
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
     * Displays printable version of summary Latestnews model.
     * @return mixed
     */
    public function actionPrintsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;
        
        $searchModel = new LatestnewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('printsummary',[
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Latestnews model.
     * @return mixed
     */
    public function actionPdfsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;
        
        $searchModel = new LatestnewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
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
     * Displays a single Latestnews model.
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
     * Creates a new Latestnews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Latestnews();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->response->format = 'json';

            return [
                    "saved",
                    Yii::$app->urlManager->baseUrl."/index.php?r=general/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
//            return $this->redirect(['index']);
        } else {

            $request = Yii::$app->request;

            if($request->isAjax)
            {
                return $this->renderPartial('_create', [
                    'model' => $model,
                ]);
            }
            else
            {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing Latestnews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->response->format = 'json';

            return [
                    "saved",
                    Yii::$app->urlManager->baseUrl."/index.php?r=general/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
        } else {

            $request = Yii::$app->request;

            if($request->isAjax)
            {
                return $this->renderPartial('_update', [
                    'model' => $model,
                ]);
            }
            else
            {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Deletes an existing Latestnews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete())
        {
            \Yii::$app->response->format = 'json';

            return [
                    "Removed",
                    Yii::$app->urlManager->baseUrl."/index.php?r=general/index",
                    "Record Removed",
                    "Record Removed successfully"
                ];
            
        }
            //return $this->redirect(['index']);
        else
        {
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
     * Displays sidebar Latestnews model.
     * @return mixed
     */
    public function actionSidebarsummary()
    {
        $res = \app\models\Model::checksavedinfo(["r"=>"general/latestnews/index"]);
        
        $searchModel=$searchModel= new LatestnewsSearch();
        $searchModel->loadparams($res);
        
        return $this->renderPartial('_summarysearch', [
                'searchModel' => $searchModel,
            ]);
    }

    /**
     * Displays sidebar Latestnews model.
     * @return mixed
     */
    public function actionSidebarinput()
    {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Latestnews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Latestnews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Latestnews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
