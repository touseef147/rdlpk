<?php
namespace app\modules\marketting\visitors\controllers;

use Yii;
use app\models\application\Dailyvisitors;
use app\models\application\DailyvisitorsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\Response;

use app\models\Model;

use kartik\mpdf\Pdf;

/**
 * DailyvisitorsController implements the CRUD actions for Dailyvisitors model.
 */
class DailyvisitorsController extends Controller
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
     * Lists all Dailyvisitors models.
     * @return mixed
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "dailyvisitors", "visits");
        
        $searchModel = new DailyvisitorsSearch();
        $dataProvider=NULL;
        
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
     * Displays printable version of summary Dailyvisitors model.
     * @return mixed
     */
    public function actionPrintsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;
        
        $searchModel = new DailyvisitorsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->pagination=false;
        
        return $this->render('printsummary',[
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Dailyvisitors model.
     * @return mixed
     */
    public function actionPdfsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;
        
        $searchModel = new DailyvisitorsSearch();
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
     * Displays a single Dailyvisitors model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $modelvd = new \app\modules\visits\models\Visitdetails;
        $modelib = [new \app\modules\visits\models\Interestbooking];
        
        if ($modelvd->load(Yii::$app->request->post())) {
            $modelib = Model::createMultiple(\app\modules\visits\models\Interestbooking::classname());
            Model::loadMultiple($modelib, Yii::$app->request->post());
            
            $valid =true;
            $hasvisitdetail=0;
            
            // validate all models
            if($modelvd->visit_type=="caller" || $modelvd->visit_type=="visitor")
            {
                $modelvd->visitors_id=$model->id;
                $modelvd->visit_date=date("Y-m-d",  strtotime($modelvd->visit_date));
                $modelvd->next_visit=date("Y-m-d",  strtotime($modelvd->next_visit));
                
                $modelvd->visit_no="1";
                $modelvd->deal_by=$_SESSION["user_array"]["id"];
                $modelvd->followup_status="0";
             //   $modelvd->center_id=0;

                if($modelvd->validate() ==true)
                    $hasvisitdetail=1;
                else
                    $valid=FALSE;
            }
            
            foreach ($modelib as $modelibs) {
                $modelibs->visitors_id=$model->id;
                $modelibs->booking_date=date("Y-m-d",  strtotime($modelibs->booking_date));
                $modelibs->deal_by=$_SESSION["user_array"]["id"];
            }
            
            if(Model::validateMultiple($modelib)==false)
                $valid=FALSE;

            if ($valid==TRUE) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    $flag=true;
                    
                    if($hasvisitdetail==1)
                        $flag = $modelvd->save(false);
                    
                    if ($flag) {
                        foreach ($modelib as $modelibs) {
                            $modelibs->visitors_id=$model->id;
                            if (! ($flag = $modelibs->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        
                        \Yii::$app->response->format = 'json';          
                        return [
                                "saved",
                                Yii::$app->urlManager->baseUrl."/index.php?r=visits/dailyvisitors/index",
                                "Record Saved",
                                "Record saved successfully"
                            ];
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            
            return $this->renderPartial('_view', [
                'model' => $model,
                'modelvisits' => $modelvd,
                'modelbookings' => $modelib,
            ]);
        }
        else
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
    }

    /**
     * Creates a new Dailyvisitors model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {  
        $model = new Dailyvisitors();

        if ($model->load(Yii::$app->request->post()) /*&& $model->save()*/) {
            $model->reg_date = date("Y-m-d",strtotime($model->reg_date));
            
            if($model->save())
            {
                \Yii::$app->response->format = 'json';

                return [
                        "saved",
                        Yii::$app->urlManager->baseUrl."/index.php?r=visits/dailyvisitors/view&id=".$model->id,
                        "Record Saved",
                        "Record saved successfully"
                    ];
            }
        } 
        
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

    /**
     * Updates an existing Dailyvisitors model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $model->reg_date = date("Y-m-d",strtotime($model->reg_date));

            if($model->save())
            {
                \Yii::$app->response->format = 'json';

                return [
                        "saved",
                        Yii::$app->urlManager->baseUrl."/index.php?r=visits/dailyvisitors/view&id=".$id,
                        "Record Saved",
                        "Record saved successfully"
                    ];
            }
        } 
        

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


    /**
     * Deletes an existing Dailyvisitors model.
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
     * Displays sidebar Dailyvisitors model.
     * @return mixed
     */
    public function actionSidebarsummary()
    {
        $res = \app\models\Model::checksavedinfo(["r"=>"visits/dailyvisitors/index"]);
        
        $searchModel=$searchModel= new DailyvisitorsSearch();
        $searchModel->loadparams($res);
        
        return $this->renderPartial('_summarysearch', [
                'searchModel' => $searchModel,
            ]);
    }

    /**
     * Displays sidebar Dailyvisitors model.
     * @return mixed
     */
    public function actionSidebarinput()
    {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Displays sidebar Dailyvisitors model.
     * @return mixed
     */
    public function actionDynamicbookingrow($id)
  {
        return $this->renderPartial('_bookingrow', ['id'=>$id]);
    }

    /**
     * Finds the Dailyvisitors model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dailyvisitors the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dailyvisitors::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
