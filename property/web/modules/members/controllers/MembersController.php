<?php

namespace app\modules\members\controllers;

use Yii;
use app\models\application\Members;
use app\models\application\MembersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;

/**
 * MembersController implements the CRUD actions for Members model.
 */
class MembersController extends Controller {

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
        return parent::beforeAction($action);
    }

    /**
     * Lists all Members models.
     * @return mixed
     */
    public function actionIndex() {

        $request = Yii::$app->request;

        $searchModel = new MembersSearch();
        $dataProvider = NULL;
        $myrights = \app\models\Model::getRights("index", "members", "members");

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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
            $model->is_dealer = 0;
//            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->updaterecord()) {
                \Yii::$app->response->format = 'json';
                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=members/members/index/",
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

            if ($model->updaterecord()) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=members/members/index",
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
            $model->picture = UploadedFile::getInstance($model, 'image');

            if ($model->updaterecord()) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=members/members/update&id=" . $model->parent_id,
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->picture = UploadedFile::getInstance($model, 'image');

            if ($model->updaterecord()) {
                \Yii::$app->response->format = 'json';

                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=members/members/update&id=" . $model->parent_id,
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
                Yii::$app->urlManager->baseUrl . "/index.php?r=members/members/index",
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
        $res = \app\models\Model::checksavedinfo(["r" => "members/members/index"]);

        $searchModel = $searchModel = new MembersSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('_summarysearch', [
                    'searchModel' => $searchModel,
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
        if (($model = Members::findOne($id)) !== null) {
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

    public function actionFindrecord($titles = "", $target = "", $membertype = 0) {
        $model = new Members();
        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            $titles = $data["titles"];
            $target = $data["target"];
            //$membertype = $data["membertype"];
            $type = intval($data["membertype"]);
            //return;

            if (strlen($data["cnic"]) != 13) {
                $model->addError('cnic', 'Invalid CNIC');
            } else {
                if ($type == 0) {
                    $model = Members::find()->where(['cnic' => $data["cnic"]])->one();
                } else if ($type == 1) {  //Member Only
                    $model = Members::find()->where(['cnic' => $data["cnic"], 'is_dealer' => 0])->one();
                } else if ($type == 2) {  //Dealer Only
                    $model = Members::find()->where(['cnic' => $data["cnic"], 'is_dealer' => 1])->one();
                }

                if ($target != "") {
                    if ($model != null) {
                        \Yii::$app->response->format = 'json';
                        return [
                            "saved",
                            Yii::$app->urlManager->baseUrl . "/index.php?r=members/members/showdetail&id=" . $model->id,
                            "Record Saved",
                            "Record saved successfully"
                        ];
                    }
                    $model = new Members();
                    $model->cnic = $data["cnic"];
                    $model->addError('cnic', 'Record not found.');
                } else {
                    if ($model != null) {
                        \Yii::$app->response->format = 'json';
                        return [
                            "saved",
                            Yii::$app->urlManager->baseUrl . "/index.php?r=members/members/selectnominee&parentid=" . $model->id,
                            "Record Saved",
                            "Record saved successfully"
                        ];
                    } else {
                        \Yii::$app->response->format = 'json';
                        return [
                            "saved",
                            Yii::$app->urlManager->baseUrl . "/index.php?r=members/members/createmember&cnic=" . $data["cnic"],
                            "Record Saved",
                            "Record saved successfully"
                        ];
                    }
                }
            }

            $membertype = intval($type);
        }

        return $this->renderPartial('_find', [
                    'model' => $model,
                    'titles' => $titles,
                    'target' => $target,
                    'membertype' => $membertype,
        ]);
    }

    public function actionShowdetail($id) {
        $model = $this->findModel($id);

        return $this->renderPartial('_showdetail', [
                    'model' => $model,
        ]);
    }

    public function actionNomineedetail($id) {
        $model = $this->findModel($id);

        return $this->renderPartial('_nomineedetail', [
                    'model' => $model,
        ]);
    }

    public function actionGetrecord($id, $nominee = 0) {
        $model = $this->findModel($id);
        $modelnominee = $this->findModel($nominee);

        return $this->renderPartial('_getrecord', [
                    'model' => $model,
                    'modelnominee' => $modelnominee,
        ]);
    }

    public function actionCreatemember($cnic = "") {
        $model = new Members();
        if ($model->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->updaterecord()) {
                \Yii::$app->response->format = 'json';
                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=members/members/createnominee&parentid=" . $model->id,
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        } else {
            $model->id = 0;
            $model->cnic = $cnic;
        }

        return $this->renderPartial('_createmember', [
                    'model' => $model,
        ]);
    }

    public function actionSelectnominee($parentid = 0) {
        $model = Members::find()->where(['id' => $parentid])->one();
        $modelnominee = new Members();

        if ($modelnominee->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->updaterecord()) {
                \Yii::$app->response->format = 'json';
                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=members/members/getrecord&id=" . $model->id,
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        } else {
            $modelnominee->parent_id = $parentid;
        }

        return $this->renderPartial('_selectnominee', [
                    'model' => $model,
                    'modelnominee' => $modelnominee,
        ]);
    }

    public function actionCreatenominee($parentid = 0) {
        $model = new Members();
        if ($model->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->updaterecord()) {
                \Yii::$app->response->format = 'json';
                return [
                    "saved",
                    Yii::$app->urlManager->baseUrl . "/index.php?r=members/members/getrecord&id=" . $model->parent_id . "&nominee=" . $model->id,
                    "Record Saved",
                    "Record saved successfully"
                ];
            }
        } else {
            $parent = Members::find()->where(['id' => $parentid])->one();

            $model->parent_id = $parentid;
            $model->sodowo = $parent->name;
        }

        return $this->renderPartial('_createnominee', [
                    'model' => $model,
        ]);
    }

    public function actionTest1($parentid = 0) {
        return $this->render('test');
    }

    public function actionTest2($parentid = 0) {
        return $this->renderPartial('test');
    }

    public function actionShowrecord($id = 0, $myoptions = null) {
        $model = Members::find()->where(['id' => $id])->one();

        return $this->renderPartial('showrecord', [
                    'options' => $myoptions,
                    'model' => $model,
        ]);
    }

    public function actionCount() {
        $model = \app\models\application\Members::find()->where(['is_dealer' => 0])->select('id')->all();

        return count($model);
    }

}
