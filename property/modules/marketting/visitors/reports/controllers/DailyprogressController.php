<?php

namespace app\modules\marketting\visitors\reports\controllers;

use Yii;
use yii\web\Controller;

//use app\modules\visits\reports\models\SalescentersSearch;

class DailyprogressController extends Controller {

    public function actionIndex() {
        $request = Yii::$app->request;
        $tabs = [
            "sales_executive" => [
                "name" => "sales_executive",
                "title" => "Sales Executive",
                "expanded" => FALSE,
            ],
            "sales_center" => [
                "name" => "sales_center",
                "title" => "Sales Center",
                "expanded" => FALSE,
            ],
        ];

        $searchModel = NULL;
        $model = NULL;
        $modelp = NULL;

        if (isset(Yii::$app->request->queryParams["page"])) {
            $tabs[Yii::$app->request->queryParams["page"]]["expanded"] = TRUE;

            if (Yii::$app->request->queryParams["page"] == "sales_executive") {
                $rowmodel = new \app\modules\security\models\UserSearch();
                $colmodel = new \app\models\Keyvalue();
                $searchModel = new \app\modules\visits\reports\models\PropertySearch();

                $modelRows = $rowmodel->salecenteruserlist();
                //->salesexecutivewisesummary(Yii::$app->request->queryParams);
                $modelColumns = $colmodel->daysofmonth(4,2016);
                //(Yii::$app->request->queryParams);
                $model = $searchModel->salesexecutivewisefdata(Yii::$app->request->queryParams);
            } else if (Yii::$app->request->queryParams["page"] == "sales_center") {
                $rowmodel = new \app\modules\propertyconfig\models\CenterspermissionsSearch();
                $colmodel = new \app\modules\visits\models\Followup();
                $searchModel = new \app\modules\visits\reports\models\PropertySearch();
                
                $modelRows = $rowmodel->centerlist($_SESSION["user_array"]["id"]);
                //->salesexecutivewisesummary(Yii::$app->request->queryParams);
                $modelColumns = $colmodel->statuses();
                //(Yii::$app->request->queryParams);
                $model = $searchModel->salescenterwisefdata(Yii::$app->request->queryParams);
            }
        } else {
            $tabs["sales_executive"]["expanded"] = TRUE;

            $rowmodel = new \app\modules\security\models\UserSearch();
            $colmodel = new \app\models\Keyvalue();
            $searchModel = new \app\modules\visits\reports\models\PropertySearch();

            $modelRows = $rowmodel->salecenteruserlist();
            //->salesexecutivewisesummary(Yii::$app->request->queryParams);
            $modelColumns = $colmodel->daysofmonth(4,2016);
            //(Yii::$app->request->queryParams);
            $model = $searchModel->salesexecutivewisedailyfdata(Yii::$app->request->queryParams);
            $modelp = $searchModel->salesexecutivewisedailydata(Yii::$app->request->queryParams);
        }

        if ($request->isAjax) {
            return $this->renderPartial('_index', [
                        'searchModel' => $searchModel,
                        'tabs' => $tabs,
                        'modelRows' => $modelRows,
                        'modelColumns' => $modelColumns,
                        'model' => $model,
                        'modelp' => $modelp,
            ]);
        } else {
            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'tabs' => $tabs,
                        'modelRows' => $modelRows,
                        'modelColumns' => $modelColumns,
                        'model' => $model,
                        'modelp' => $modelp,
            ]);
        }
    }

}
