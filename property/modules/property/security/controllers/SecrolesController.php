<?php

namespace app\modules\security\controllers;

use Yii;
use app\models\application\Secroles;
use app\models\application\SecrolesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use kartik\mpdf\Pdf;

/**
 * SecrolesController implements the CRUD actions for Secroles model.
 */
class SecrolesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'delete' => ['post'],
                ],
            ],
        ];
    }

    
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    
    /**
     * Lists all Secroles models.
     * @return mixed
     */
    public function actionIndex()
    {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "secroles", "security");
        
        $searchModel = new SecrolesSearch();
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
print_r($dataProvider);
return;
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
     * Displays printable version of summary Secroles model.
     * @return mixed
     */
    public function actionPrintsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;
        
        $searchModel = new SecrolesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->pagination=false;
        
        return $this->render('printsummary',[
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Secroles model.
     * @return mixed
     */
    public function actionPdfsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;
        
        $searchModel = new SecrolesSearch();
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
     * Displays a single Secroles model.
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
     * Creates a new Secroles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Secroles();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->response->format = 'json';

            return [
                    "saved",
                    Yii::$app->urlManager->baseUrl."/index.php?r=security/secroles/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
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
     * Updates an existing Secroles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $modules = new \app\models\application\SecmodulesSearch();
        $dataProvidermodules = $modules->search(null);
        
        $controllers = new \app\models\application\SeccontrollerSearch();
        $dataProviderControllers = $controllers->search(null);
        
        $dataProviderControllers->pagination=false;

        $actions = new \app\models\application\SecmoduleactionsSearch();
        $dataProviderActions = $actions->search(null);
        
        $dataProviderActions->pagination=false;
        
        $rights = new \app\models\application\SecrolerightsSearch();
        $dataProviderRights = $rights->search(["r"=>"security/Secroles/update","SecrolerightsSearch"=> ["role_id"=>$id]]);
        
        $dataProviderRights->pagination=false;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $right = new \app\models\application\SecrolerightsSearch();
            $dbrecords = $right->search(["r"=>"security/Secroles/update","SecrolerightsSearch"=> ["role_id"=>$id]]);
            
            $dataexisting=$dbrecords->getModels();
            //$existingdata = array_slice($dataexisting,2, count($dataexisting));
            $dbitems = array_map(create_function('$arr', 'return $arr["action_id"];'), $dataexisting);

            $data = Yii::$app->request->post();

            $newitems=  array();
            if(isset($data["screen"]))
            {
                $newitems=array_diff($data["screen"],$dbitems);
            }
            
            $removeditems=array();
            
            if(isset($data["screen"]))
            {
                $removeditems=array_diff($dbitems,$data["screen"]);
            }
            else
            {
                $removeditems=$dbitems;
            }
            
            foreach ($newitems as $item)
            {
                $modeln = new \app\models\application\Secrolerights();
                $modeln->role_id = $id;
                $modeln->action_id=$item;
                $modeln->right_status=1;
                $modeln->save();
            }
            
            foreach ($removeditems as $item)
            {
                $myUpdate = "delete from sec_role_rights where role_id=".$id." and action_id=".$item.";";
                \Yii::$app->db->createCommand($myUpdate)->execute();
            }

            \Yii::$app->response->format = 'json';

            return [
                    "saved",
                    Yii::$app->urlManager->baseUrl."/index.php?r=security/secroles/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
        } else {

            $request = Yii::$app->request;

            if($request->isAjax)
            {
                return $this->renderPartial('_update', [
                    'model' => $model,
                    'modules' => $dataProvidermodules,
                    'controllers' => $dataProviderControllers,
                    'actions' => $dataProviderActions,
                    'rights' => $dataProviderRights,
                ]);
            }
            else
            {
                return $this->render('update', [
                    'model' => $model,
                    'modules' => $dataProvidermodules,
                    'controllers' => $dataProviderControllers,
                    'actions' => $dataProviderActions,
                    'rights' => $dataProviderRights,
                ]);
            }
        }
    }

    /**
     * Deletes an existing Secroles model.
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
     * Displays sidebar Secroles model.
     * @return mixed
     */
    public function actionSidebarsummary()
    {
        $res = \app\models\Model::checksavedinfo(["r"=>"security/secroles/index"]);
        $myrights = \app\models\Model::getRights("index", "secroles", "security");
        
        $searchModel=$searchModel= new SecrolesSearch();
        $searchModel->loadparams($res);
        
        return $this->renderPartial('_summarysearch', [
                'searchModel' => $searchModel,
                'myrights' => $myrights,
            ]);
    }

    /**
     * Displays sidebar Secroles model.
     * @return mixed
     */
    public function actionSidebarinput()
    {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Secroles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Secroles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Secroles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function generatepath($action) {
        return Yii::$app->urlManager->baseUrl . "/index.php?r=security/secroles/" . $action;
    }
}
