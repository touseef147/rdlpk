<?php

namespace app\modules\property\config\controllers;

use Yii;
use app\models\application\Streets;
use app\models\application\StreetsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use kartik\mpdf\Pdf;

/**
 * StreetsController implements the CRUD actions for Streets model.
 */
class StreetsController extends Controller
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
     * Lists all Streets models.
     * @return mixed
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "streets", "property/config");
        
        $searchModel = new StreetsSearch();
        $dataProvider=NULL;
        \app\models\Model::loaddata($dataProvider, $searchModel, $request, Yii::$app->request->queryParams);
        
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
     * Displays printable version of summary Streets model.
     * @return mixed
     */
    public function actionPrintsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $searchModel = new StreetsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->pagination=false;
        
        return $this->render('printsummary',[
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays PDF version of summary Streets model.
     * @return mixed
     */
    public function actionPdfsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $searchModel = new StreetsSearch();
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
     * Displays a single Streets model.
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
     * Creates a new Streets model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Streets();

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
     * Updates an existing Streets model.
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
     * Deletes an existing Streets model.
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
     * Displays sidebar Streets model.
     * @return mixed
     */
    public function actionSidebarsummary()
    {
        $res = \app\models\Model::checksavedinfo(["r"=>"property/config/streets/index"]);
        $myrights = \app\models\Model::getRights("index", "streets", "property/config");
        
        $searchModel=$searchModel= new StreetsSearch();
        $searchModel->loadparams($res);
        
        return $this->renderPartial('_summarysearch', [
                'searchModel' => $searchModel,
                'myrights' => $myrights,
            ]);
    }

    /**
     * Displays sidebar Streets model.
     * @return mixed
     */
    public function actionSidebarinput()
    {
        return $this->renderPartial('_sidebarinput');
    }

    /**
     * Finds the Streets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Streets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Streets::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDropdown($id = 0) {
        $recs = \app\models\application\Streets::find()
                ->where(['id' => $id])
                ->orderBy('street ASC')
                ->all();

        echo "<option value=''>Select a Street</option>";

        foreach ($recs as $rec) {
            echo "<option value='" . $rec->id . "'>" . $rec->street . "</option>";
        }
    }
}
