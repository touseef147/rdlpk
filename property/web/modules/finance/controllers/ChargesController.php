<?php

namespace app\modules\finance\controllers;

use Yii;
use app\models\application\Charges;
use app\models\application\ChargesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use kartik\mpdf\Pdf;

/**
 * ChargesController implements the CRUD actions for Charges model.
 */
class ChargesController extends Controller
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
     * Lists all Charges models.
     * @return mixed
     */
    public function actionIndex()
    {

        $request = Yii::$app->request;
        
        $searchModel = new ChargesSearch();
        $dataProvider=NULL;
        $myrights = \app\models\Model::getRights("index", "charges", "finance");

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
     * Displays printable version of summary Charges model.
     * @return mixed
     */
    public function actionPrintsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;
        
        $searchModel = new ChargesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->pagination=false;
        
        return $this->render('printsummary',[
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Charges model.
     * @return mixed
     */
    public function actionPdfsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;
        
        $searchModel = new ChargesSearch();
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
     * Displays a single Charges model.
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
     * Creates a new Charges model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Charges();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
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
     * Updates an existing Charges model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
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
     * Deletes an existing Charges model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Displays sidebar Charges model.
     * @return mixed
     */
    public function actionSidebarsummary()
    {
        $res = \app\models\Model::checksavedinfo(["r"=>"finance/charges/index"]);
        $myrights = \app\models\Model::getRights("index", "charges", "finance");
        
        $searchModel=$searchModel= new ChargesSearch();
        $searchModel->loadparams($res);
        
        return $this->renderPartial('_summarysearch', [
                'searchModel' => $searchModel,
                'myrights' => $myrights,
            ]);
    }

    /**
     * Displays sidebar Charges model.
     * @return mixed
     */
    public function actionSidebarinput()
    {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Charges model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Charges the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Charges::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
