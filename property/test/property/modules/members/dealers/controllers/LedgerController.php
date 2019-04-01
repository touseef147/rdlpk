<?php

namespace app\modules\members\dealers\controllers;

use Yii;
use app\models\application\Fmstransdetaildist;
use app\models\application\FmstransdetaildistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use kartik\mpdf\Pdf;

/**
 * LedgerController implements the CRUD actions for Fmstransdetaildist model.
 */
class LedgerController extends Controller
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
     * Lists all Fmstransdetaildist models.
     * @return mixed
     */
    public function actionIndex()
    {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "ledger", "members/dealers");
        
        $searchModel = new FmstransdetaildistSearch();
        $dataProvider=NULL;
    
        if(count(Yii::$app->request->queryParams)==1)
        {
            $res = \app\models\Model::checksavedinfo(Yii::$app->request->queryParams);

            if($res==NULL)
            {
                $dataProvider = $searchModel->searchledger(Yii::$app->request->queryParams);

                $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
                $dataProvider->pagination->page = $request->get("pageno", 0);
            }
            else
            {
                $dataProvider = $searchModel->searchledger($res);
                
                $dataProvider->pagination->pageSize = (isset($res["pagesize"])? $res["pagesize"] : 20); //$request->get("pagesize", 20);
                $dataProvider->pagination->page = (isset($res["pageno"])? $res["pageno"] : 0); //$request->get("pagesize", 20);
            }
        }
        else
        {
            \app\models\Model::savebrowsinginfo();
            
            $dataProvider = $searchModel->searchledger(Yii::$app->request->queryParams);

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
     * Displays printable version of summary Fmstransdetaildist model.
     * @return mixed
     */
    public function actionPrintsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;
        
        $searchModel = new FmstransdetaildistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('printsummary',[
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Fmstransdetaildist model.
     * @return mixed
     */
    public function actionPdfsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;
        
        $searchModel = new FmstransdetaildistSearch();
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
     * Displays a single Fmstransdetaildist model.
     * @param string $id
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
     * Creates a new Fmstransdetaildist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fmstransdetaildist();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->response->format = 'json';

            return [
                    "saved",
                    Yii::$app->urlManager->baseUrl."/index.php?r=members\dealers/index",
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
     * Updates an existing Fmstransdetaildist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->response->format = 'json';

            return [
                    "saved",
                    Yii::$app->urlManager->baseUrl."/index.php?r=members\dealers/index",
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
     * Deletes an existing Fmstransdetaildist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete())
        {
            \Yii::$app->response->format = 'json';

            return [
                    "Removed",
                    Yii::$app->urlManager->baseUrl."/index.php?r=members\dealers/index",
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
     * Displays sidebar Fmstransdetaildist model.
     * @return mixed
     */
    public function actionSidebarsummary()
    {
        $res = \app\models\Model::checksavedinfo(["r"=>"modulename/LedgerController/index"]);
        
        $searchModel = new FmstransdetaildistSearch();
        $searchModel->loadparams($res);
        
        return $this->renderPartial('_summarysearch', [
                'searchModel' => $searchModel,
            ]);
    }

    /**
     * Displays sidebar Fmstransdetaildist model.
     * @return mixed
     */
    public function actionSidebarinput()
    {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Fmstransdetaildist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Fmstransdetaildist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fmstransdetaildist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionShowbalance($id, $type, $against=0, $project=0, $salescenter=0) {
        $model = \app\models\application\fmstransdetaildist::find()->joinWith('transaction')->where(['distributed_to_id' => $id, 'distributed_to_type' => $type]);//->one();
        
        if($against!= 0){
            $model->andFilterWhere([
                'against' => $against,
            ]);
        }
        
        if($project!= 0){
            $model->andFilterWhere([
                'fms_trans_master.project_id' => $project,
            ]);
        }
        
        if($salescenter!= 0){
            $model->andFilterWhere([
                'fms_trans_master.sales_center_id' => $salescenter,
            ]);
        }
        
        $model = $model->select('sum(dr_amount) as dr_amount, sum(cr_amount) as cr_amount')->groupBy(['distributed_to_id'])->one();//$model->one();
        //var_dump($model->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
        //print_r($model);
        //return;
        return $this->renderPartial('showbalance', [
                'model' => $model,
            ]);
    }
}
