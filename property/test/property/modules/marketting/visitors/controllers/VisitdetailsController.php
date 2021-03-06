<?php
namespace app\modules\marketting\visitors\controllers;

use Yii;
use app\models\application\Dailyvisitors;
use app\models\application\DailyvisitorsSearch;
use app\models\application\Visitdetails;
use app\models\application\VisitdetailssSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use kartik\mpdf\Pdf;

use app\models\Model;

/**
 * VisitdetailsController implements the CRUD actions for Visitdetails model.
 */
class VisitdetailsController extends Controller
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
     * Lists all Visitdetails models.
     * @return mixed
     */
    public function actionIndex()
    {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "visitdetails", "visits");
        $viewname = \app\models\Model::getViewName("index", "visitdetails", "visits");
        
        //print_r($myrights);
        //echo $viewname;
        
        $searchModel = new VisitdetailssSearch();
        $dataProvider=NULL;
    
        if(count(Yii::$app->request->queryParams)==1)
        {
            $res = \app\models\Model::checksavedinfo(Yii::$app->request->queryParams);

            if($res==NULL)
            {
                $dataProvider = $searchModel->searchfollowup(Yii::$app->request->queryParams);

                $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
                $dataProvider->pagination->page = $request->get("pageno", 0);
            }
            else
            {
                $dataProvider = $searchModel->searchfollowup($res);
                
                $dataProvider->pagination->pageSize = (isset($res["pagesize"])? $res["pagesize"] : 20); //$request->get("pagesize", 20);
                $dataProvider->pagination->page = (isset($res["pageno"])? $res["pageno"] : 0); //$request->get("pagesize", 20);
            }
        }
        else
        {
            \app\models\Model::savebrowsinginfo();
            
            $dataProvider = $searchModel->searchfollowup(Yii::$app->request->queryParams);

            $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
            $dataProvider->pagination->page = $request->get("pageno", 0);
        }   
        
        if($request->isAjax)
        {
            return $this->renderPartial('_' . $viewname, [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'myrights'=>$myrights,
            ]);
        }
        else
        {
            return $this->render($viewname, [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'myrights'=>$myrights,
            ]);
        }
    }

    /**
     * Displays printable version of summary Visitdetails model.
     * @return mixed
     */
    public function actionPrintsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;
        
        $searchModel = new VisitdetailssSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->pagination=false;
        
        return $this->render('printsummary',[
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Visitdetails model.
     * @return mixed
     */
    public function actionPdfsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;
        
        $searchModel = new VisitdetailssSearch();
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
     * Displays a single Visitdetails model.
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
     * Creates a new Visitdetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Visitdetails();

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
     * Updates an existing Visitdetails model.
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
     * Deletes an existing Visitdetails model.
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
     * Displays a single Dailyvisitors model.
     * @param integer $id
     * @return mixed
     */
    public function actionFollowup($id,$visitid)
    {
        $model = $this->findVisitorModel($id);
        
        $modelvd = new \app\modules\visits\models\Visitdetails;
        $modelib = [new \app\modules\visits\models\Interestbooking];
        $modelfollowup = new \app\modules\visits\models\Followup;
        
        if ($modelvd->load(Yii::$app->request->post())) {
            $modelfollowup->load(Yii::$app->request->post());
            $modelib = Model::createMultiple(\app\modules\visits\models\Interestbooking::classname());
            
            Model::loadMultiple($modelib, Yii::$app->request->post());
            
            $valid =true;
            $hasvisitdetail=0;
            

            if($modelfollowup->validate() ==true)
            {
             //   $hasvisitdetail=1;
            }
            else
            {
                $valid=FALSE;
            }
            
            // validate all models
            /*if($modelvd->visit_type=="caller" || $modelvd->visit_type=="visitor")
            {
                $modelvd->visitors_id=$model->id;
                $modelvd->visit_no="1";
                $modelvd->deal_by=$_SESSION["user_array"]["id"];
               // $modelvd->followup_status="0";
                //$modelvd->center_id=center_id;

                if($modelvd->validate() ==true)
                {
                    $hasvisitdetail=1;
                }
                else
                {
                    $valid=FALSE;
                }
            }*/
            
            foreach ($modelib as $modelibs) {
                $modelibs->visitors_id=$model->id;
                $modelibs->deal_by=$_SESSION["user_array"]["id"];
            }
            
            if(Model::validateMultiple($modelib)==false)
                $valid=FALSE;

            if ($valid==TRUE) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    $flag=true;
                    
                    //$flag = $modelfollowup->save(false);
                    $myUpdate = "UPDATE mkt_visit_details set
					 followup_status='".$modelfollowup->status."',
					 followup_remarks='".$modelfollowup->remarks."',
					 next_visit='".$modelfollowup->next_visit."' where visitors_id=".$model->id." and followup_status=0;"; 
				    \Yii::$app->db->createCommand($myUpdate)->execute();
              //     echo $myUpdate; exit();
                    if($flag)
                    {
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
                    }
                    
                    if ($flag) {
                        $transaction->commit();

                        \Yii::$app->response->format = 'json';          
                        return [
                                "saved",
                                Yii::$app->urlManager->baseUrl."/index.php?r=visits/visitdetails/index",
                                "Record Saved",
                                "Record saved successfully"
                            ];
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            
            return $this->renderPartial('_followup', [
                'model' => $model,
                'modelfollowup' => $modelfollowup,
                'modelvisits' => $modelvd,
                'modelbookings' => $modelib,
            ]);
        }
        else
        {
            $request = Yii::$app->request;

            if($request->isAjax)
            {
                return $this->renderPartial('_followup', [
                    'model' => $this->findVisitorModel($id),
                ]);
            }
            else
            {
                return $this->render('followup', [
                    'model' => $this->findVisitorModel($id),
                ]);
            }
        }
    }

    /**
     * Displays sidebar Visitdetails model.
     * @return mixed
     */
    public function actionSidebarsummary()
    {
        $res = \app\models\Model::checksavedinfo(["r"=>"visits/visitdetails/index"]);
        $myrights = \app\models\Model::getRights("index", "visitdetails", "visits");
        $viewname = \app\models\Model::getViewName("index", "visitdetails", "visits");
        
        $searchModel=$searchModel= new VisitdetailssSearch();
        $searchModel->loadparams($res);
        
        return $this->renderPartial('_summarysearch', [
                'searchModel' => $searchModel,
                'myrights' => $myrights,
                'viewName' => $viewname,
            ]);
    }

    /**
     * Displays sidebar Visitdetails model.
     * @return mixed
     */
    public function actionSidebarinput()
    {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Visitdetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Visitdetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Visitdetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Visitdetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Visitdetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findVisitorModel($id)
    {
        if (($model = Dailyvisitors::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
