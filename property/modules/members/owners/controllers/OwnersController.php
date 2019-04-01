<?php

namespace app\modules\members\owners\controllers;

use Yii;
use app\models\application\Members;
use app\models\application\MembersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;

/**
 * OwnersController implements the CRUD actions for Members model.
 */
class OwnersController extends Controller {

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
     * Lists all Members models.
     * @return mixed
     */
    public function actionIndex() {
        $request = Yii::$app->request;

        $searchModel = new MembersSearch();
        $dataProvider = NULL;
        $myrights = \app\models\Model::getRights("index", "owners", "members/owners");

        if (count(Yii::$app->request->queryParams) == 1) {
            $res = \app\models\Model::checksavedinfo(Yii::$app->request->queryParams);

            if ($res == NULL) {
                $dataProvider = $searchModel->searchowners(Yii::$app->request->queryParams);

                $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
                $dataProvider->pagination->page = $request->get("pageno", 0);
            } else {
                $dataProvider = $searchModel->searchowners($res);

                $dataProvider->pagination->pageSize = (isset($res["pagesize"]) ? $res["pagesize"] : 20); //$request->get("pagesize", 20);
                $dataProvider->pagination->page = (isset($res["pageno"]) ? $res["pageno"] : 0); //$request->get("pagesize", 20);
            }
        } else {
            \app\models\Model::savebrowsinginfo();

            $dataProvider = $searchModel->searchowners(Yii::$app->request->queryParams);

            $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
            $dataProvider->pagination->page = $request->get("pageno", 0);
        }

        if ($request->isAjax) {
            return $this->renderPartial('index', [
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
     * Displays printable version of summary Members model.
     * @return mixed
     */
    public function actionPrintsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new MembersSearch();
        $dataProvider = $searchModel->searchowners(Yii::$app->request->queryParams);

        return $this->render('printsummary', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Members model.
     * @return mixed
     */
    public function actionPdfsummary() {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;

        $searchModel = new MembersSearch();
        $dataProvider = $searchModel->searchowners(Yii::$app->request->queryParams);

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
     * Displays a single Members model.
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
     * Creates a new Members model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Members();
        if ($model->load(Yii::$app->request->post())) {
            $model->picture = UploadedFile::getInstance($model, 'picture');
            $model->is_owner = 1;

            if ($model->updaterecord(FALSE)) {
                \Yii::$app->response->format = 'json';
                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=members/owners/owners/index/",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        }
        $request = Yii::$app->request;
        if ($request->isAjax) {
            return $this->renderPartial('update', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Members model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->picture = UploadedFile::getInstance($model, 'picture');
//            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->updaterecord(FALSE)) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=members/owners/owners/index",
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        } 

        $model->dob = date("d-m-Y", strtotime($model->dob));

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

    public function actionCreatechild($id) {
        $model = new Members();

        if ($model->load(Yii::$app->request->post())) {
            $model->picture = UploadedFile::getInstance($model, 'picture');
//            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->updaterecord(FALSE)) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=members/owners/owners/update&id=" . $model->parent_id,
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        } else {

            $modelp = $this->findModel($id);
            $model->sodowo = $modelp->name;
            $model->parent_id = $modelp->id;

            $model->dob = date("d-m-Y", strtotime($model->dob));

            $request = Yii::$app->request;

            if ($request->isAjax) {
                return $this->renderPartial('_createchild', [
                            'model' => $model,
                ]);
            } else {
                return $this->render('createchild', [
                            'model' => $model,
                ]);
            }
        }
    }

    public function actionUpdatechild($id) {
        $model = $this->findModelforchild($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->picture = UploadedFile::getInstance($model, 'picture');

            if ($model->updaterecord(FALSE)) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=members/owners/owners/update&id=" . $model->parent_id,
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        } else {

            $model->dob = date("d-m-Y", strtotime($model->dob));

            $request = Yii::$app->request;

            if ($request->isAjax) {
                return $this->renderPartial('_updatechild', [
                            'model' => $model,
                ]);
            } else {
                return $this->render('updatechild', [
                            'model' => $model,
                ]);
            }
        }
    }

    /**
     * Deletes an existing Members model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        if ($this->findModel($id)->delete()) {
            \Yii::$app->response->format = 'json';

            return [
                "Removed",
                Yii::$app->urlManager->baseUrl . "/index.php?r=members/owners/owners/index",
                "Record Removed",
                "Record Removed successfully"
            ];
        }
        //return $this->redirect(['index']);
        else {
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
     * Displays sidebar Members model.
     * @return mixed
     */
    public function actionSidebarsummary() {
        $res = \app\models\Model::checksavedinfo(["r" => "members/owners/owners/index"]);
        $myrights = \app\models\Model::getRights("index", "owners", "members/owners");

        $searchModel = $searchModel = new MembersSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('_summarysearch', [
                    'searchModel' => $searchModel,
                    'myrights' => $myrights,
        ]);
    }

    /**
     * Displays sidebar Members model.
     * @return mixed
     */
    public function actionSidebarinput() {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Members model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Members the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Members::findOne(['id' => $id, 'is_owner' => 1])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelforchild($id) {
        if (($model = Members::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDdcontrollercities($id = 0) {
        $recs = \app\models\application\City::find()
                ->where(['country_id' => $id])
                ->orderBy('city ASC')
                ->all();

        echo "<option value=''>Select a City</option>";

        foreach ($recs as $rec) {
            echo "<option value='" . $rec->id . "'>" . $rec->city . "</option>";
        }
    }

    public function actionShowrecord($id = 0, $myoptions = null) {
        $model = Members::find()->where(['id' => $id, 'is_owner' => 1])->one();

        return $this->renderPartial('showrecord', [
                    'options' => $myoptions,
                    'model' => $model,
        ]);
    }

    public function actionCount() {
        $model = \app\models\application\Members::find()->where(['is_owner' => 1])->select('id')->all();

        return count($model);
    }

}
