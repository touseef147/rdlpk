<?php

namespace app\modules\security\controllers;

use Yii;
use app\models\application\User;
use app\models\application\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
//use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

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
        if (Yii::$app->user->id == null) {
            $this->redirect("index.php");
        } else {
            return parent::beforeAction($action);
        }
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {

        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "user", "security");

        $searchModel = new UserSearch();
        $dataProvider = NULL;

        if (count(Yii::$app->request->queryParams) == 1) {
            $res = \app\models\Model::checksavedinfo(Yii::$app->request->queryParams);

            if ($res == NULL) {
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
                $dataProvider->pagination->page = $request->get("pageno", 0);
            } else {
                $dataProvider = $searchModel->search($res);

                $dataProvider->pagination->pageSize = (isset($res["pagesize"]) ? $res["pagesize"] : 20); //$request->get("pagesize", 20);
                $dataProvider->pagination->page = (isset($res["pageno"]) ? $res["pageno"] : 0); //$request->get("pagesize", 20);
            }
        } else {
            \app\models\Model::savebrowsinginfo();

            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
            $dataProvider->pagination->page = $request->get("pageno", 0);
        }

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
     * Displays printable version of summary User model.
     * @return mixed
     */
    public function actionPrintsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination = false;

        return $this->render('printsummary', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary User model.
     * @return mixed
     */
    public function actionPdfsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new UserSearch();
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
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();
        $modelprojects = \app\models\application\Projects::find()->all();
        $modelcenters = \app\models\application\Salescenter::find()->all();
        $selectedproj = null; //\app\models\application\Propertyapplicationpchoices::find()->where(['application_id' => $model->application_id])->all();
        $selectedcenter = null; //\app\models\application\Propertyapplicationpchoices::find()->where(['application_id' => $model->application_id])->all();

        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();

            if ($model->updaterecord((isset($data["project"]) ? $data["project"] : null), (isset($data["center"]) ? $data["center"] : null))) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=security/user/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        } else {

            $request = Yii::$app->request;

            if ($request->isAjax) {
                return $this->renderPartial('_create', [
                            'model' => $model,
                            'modelprojects' => $modelprojects,
                            'modelcenters' => $modelcenters,
                            'selectedproj' => $selectedproj,
                            'selectedcenter' => $selectedcenter,
                ]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                            'modelprojects' => $modelprojects,
                            'modelcenters' => $modelcenters,
                            'selectedproj' => $selectedproj,
                            'selectedcenter' => $selectedcenter,
                ]);
            }
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelprojects = \app\models\application\Projects::find()->all();
        $modelcenters = \app\models\application\Salescenter::find()->all();

        $selectedproj = \app\models\application\Projectpermissions::find()->where(['user_id' => $id])->all();
        $selectedcenter = \app\models\application\Centerspermissions::find()->where(['user_id' => $id])->all();
        
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();

            if ($model->updaterecord((isset($data["project"]) ? $data["project"] : null), (isset($data["center"]) ? $data["center"] : null))) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=security/user/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        }

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('_update', [
                        'model' => $model,
                        'modelprojects' => $modelprojects,
                        'modelcenters' => $modelcenters,
                        'selectedproj' => $selectedproj,
                        'selectedcenter' => $selectedcenter,
            ]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'modelprojects' => $modelprojects,
                        'modelcenters' => $modelcenters,
                        'selectedproj' => $selectedproj,
                        'selectedcenter' => $selectedcenter,
            ]);
        }
    }

    public function actionAccount($id) {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            if($data["User"]["username"] != ""){
                $model->username = $data["User"]["username"];
            }
            if($data["User"]["password"] != ""){
                $model->password = $data["User"]["password"];
            }
            
            if ($model->updateaccount()) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=security/user/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        }

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('_account', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('account', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Displays sidebar User model.
     * @return mixed
     */
    public function actionSidebarsummary() {
        $res = \app\models\Model::checksavedinfo(["r" => "security/user/index"]);
        $myrights = \app\models\Model::getRights("index", "user", "security");

        $searchModel = $searchModel = new UserSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('_summarysearch', [
                    'searchModel' => $searchModel,
                    'myrights' => $myrights,
        ]);
    }

    /**
     * Displays sidebar User model.
     * @return mixed
     */
    public function actionSidebarinput() {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function generatepath($action) {
        return Yii::$app->urlManager->baseUrl . "/index.php?r=security/user/" . $action;
    }

    public function actionUpdateprofile($id) {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
            $model->uimage = UploadedFile::getInstance($model, 'uimage');     
            
            $data = Yii::$app->request->post();
            
//            if($data["User"]["password"] != ""){
//                $model->password = $data["User"]["password"];
//            }
//            
            if ($model->updaterecord(NULL,NULL)) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=dashboard",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        }

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('_updateprofile', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('updateprofile', [
                        'model' => $model,
            ]);
        }
    }
       public function actionChangepassword($id) {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
            $model->uimage = UploadedFile::getInstance($model, 'uimage');     
            
            $data = Yii::$app->request->post();
            
            if($data["User"]["password"] != ""){
                $model->password = $data["User"]["password"];
            }
            
            if ($model->updaterecord(NULL,NULL)) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=dashboard",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        }

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return $this->renderPartial('_changepassword', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('changepassword', [
                        'model' => $model,
            ]);
        }
    }

}
