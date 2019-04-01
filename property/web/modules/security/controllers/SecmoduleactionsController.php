<?php

namespace app\modules\security\controllers;

use Yii;
use app\models\application\Secmoduleactions;
use app\models\application\SecmoduleactionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * SecmoduleactionsController implements the CRUD actions for Secmoduleactions model.
 */
class SecmoduleactionsController extends Controller {

    public function behaviors() {
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
     * Lists all Secmoduleactions models.
     * @return mixed
     */
    public function actionIndex() {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "secmoduleactions", "security");

        $searchModel = new SecmoduleactionsSearch();
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

        if ($request->isAjax) {
            return $this->renderPartial('_index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'myrights'=>$myrights,
            ]);
        } else {
            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'myrights'=>$myrights,
            ]);
        }
    }

    /**
     * Displays printable version of summary Secmoduleactions model.
     * @return mixed
     */
    public function actionPrintsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new SecmoduleactionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination = false;

        return $this->render('printsummary', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Secmoduleactions model.
     * @return mixed
     */
    public function actionPdfsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new SecmoduleactionsSearch();
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
     * Displays a single Secmoduleactions model.
     * @param string $id
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
     * Creates a new Secmoduleactions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Secmoduleactions();
        $modeldynamicrows = [new \app\models\application\Sectargetscreens];
        
        $model->for_admin=1;
        $model->action_so=0;

        $modules = new \app\models\application\SecmodulesSearch();
        $dataProvidermodules = $modules->search(null);

        $controllers = new \app\models\application\SeccontrollerSearch();
        $dataProviderControllers = $controllers->search(null);

        $actions = new SecmoduleactionsSearch();
        $dataProviderActions = $actions->search(null);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->response->format = 'json';

            return [
                "saved",
                Yii::$app->urlManager->baseUrl . "/index.php?r=security/secmoduleactions/index",
                "Record Saved",
                "Record saved successfully"
            ];
        } else {

            $request = Yii::$app->request;

            if ($request->isAjax) {
                return $this->renderPartial('_create', [
                            'model' => $model,
                            'modules' => $dataProvidermodules,
                            'controllers' => $dataProviderControllers,
                            'actions' => $dataProviderActions,
                            'dynamicrows' => $modeldynamicrows,
                ]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                            'modules' => $dataProvidermodules,
                            'controllers' => $dataProviderControllers,
                            'actions' => $dataProviderActions,
                            'dynamicrows' => $modeldynamicrows,
                ]);
            }
        }
    }

    /**
     * Updates an existing Secmoduleactions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
//        $modeldynamicrows = [new \app\modules\security\models\Sectargetscreens];
        $modules = new \app\models\application\SecmodulesSearch();
        $dataProvidermodules = $modules->search(null);

        $controllers = new \app\models\application\SeccontrollerSearch();
        $dataProviderControllers = $controllers->search(null);

        $dataProviderControllers->pagination = false;

        $actions = new SecmoduleactionsSearch();
        $dataProviderActions = $actions->search(null);

        $dataProviderActions->pagination = false;

        $targets = new \app\models\application\SectargetscreensSearch();
        $dataProviderTargets = $targets->search(["r" => "security/Secmoduleactions/update", "SectargetscreensSearch" => ["parent_screen_id" => $id]]);

        $dataProviderTargets->pagination = false;

//print_r($dataProviderControllers->getModels());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //print_r(Yii::$app->request->post());
            //return;
            $targetscr = new \app\models\application\SectargetscreensSearch();
            $dbrecords = $targets->search(["r" => "security/Secmoduleactions/update", "SectargetscreensSearch" => ["parent_screen_id" => $id]]);

            $dataexisting = $dbrecords->getModels();
            //$existingdata = array_slice($dataexisting,2, count($dataexisting));
            $dbitems = array_map(create_function('$arr', 'return $arr["target_screen_id"];'), $dataexisting);

            $data = Yii::$app->request->post();

            $newitems = array();
            if (isset($data["screen"])) {
                $newitems = array_diff($data["screen"], $dbitems);
            }

            $removeditems = array();

            if (isset($data["screen"])) {
                $removeditems = array_diff($dbitems, $data["screen"]);
            } else {
                $removeditems = $dbitems;
            }

            foreach ($newitems as $item) {
                $modeln = new \app\models\application\Sectargetscreens();
                $modeln->parent_screen_id = $id;
                $modeln->target_screen_id = $item;
                $modeln->status = 1;
                $modeln->save();
            }

            foreach ($removeditems as $item) {
                $myUpdate = "delete from sec_target_screens where parent_screen_id=" . $id . " and target_screen_id=" . $item . ";";
                \Yii::$app->db->createCommand($myUpdate)->execute();
                //echo " ";
                //\app\modules\security\models\Sectargetscreens::findOne($item)->delete();
            }

            \Yii::$app->response->format = 'json';

            return [
                "saved",
                Yii::$app->urlManager->baseUrl . "/index.php?r=security/secmoduleactions/index",
                "Record Saved",
                "Record saved successfully"
            ];
        } else {

            $request = Yii::$app->request;

            if ($request->isAjax) {
                return $this->renderPartial('_update', [
                            'model' => $model,
                            'modules' => $dataProvidermodules,
                            'controllers' => $dataProviderControllers,
                            'actions' => $dataProviderActions,
                            'targets' => $dataProviderTargets,
                                //'dynamicrows' => $modeldynamicrows,
                ]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                            'modules' => $dataProvidermodules,
                            'controllers' => $dataProviderControllers,
                            'actions' => $dataProviderActions,
                            'targets' => $dataProviderTargets,
                                //'dynamicrows' => $modeldynamicrows,
                ]);
            }
        }
    }

    /**
     * Deletes an existing Secmoduleactions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Displays sidebar Secmoduleactions model.
     * @return mixed
     */
    public function actionSidebarsummary() {
        $res = \app\models\Model::checksavedinfo(["r"=>"security/secmoduleactions/index"]);
        $myrights = \app\models\Model::getRights("index", "secmoduleactions", "security");
        
        $searchModel=$searchModel= new SecmoduleactionsSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('_summarysearch', [
                'searchModel' => $searchModel,
                'myrights' => $myrights,
            ]);
    }

    /**
     * Displays sidebar Secmoduleactions model.
     * @return mixed
     */
    public function actionSidebarinput() {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Secmoduleactions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Secmoduleactions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Secmoduleactions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddscreen($id = 0, $moduleid = 0, $screenid = 0) {
        $model = new \app\models\application\Sectargetscreens();
        $model->parent_screen_id = $screenid;
        $model->target_screen_id = $id;
        $model->status = 1;
        $model->save();

        \Yii::$app->response->format = 'json';

        return [
            "saved",
            Yii::$app->urlManager->baseUrl . "/index.php?r=security/secmoduleactions/update&id=" . $screenid . "&moduleid=" . $moduleid,
            "Record Saved",
            "Record saved successfully"
        ];
    }

    public function actionDdcontroller($id = 0) {
        $recs = \app\models\application\Seccontroller::find()
                ->where(['module_id' => $id])
                ->orderBy('controller_name ASC')
                ->all();

        echo "<option value=''>Select a Controller</option>";

        foreach ($recs as $rec) {
            echo "<option value='" . $rec->controller_id . "'>" . $rec->controller_name . "</option>";
        }
    }

    protected function generatepath($action) {
        return Yii::$app->urlManager->baseUrl . "/index.php?r=security/secmoduleactions/" . $action;
    }

}
