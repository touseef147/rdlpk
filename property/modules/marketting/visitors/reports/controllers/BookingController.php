<?php

namespace app\modules\marketting\visitors\reports\controllers;

use Yii;
use yii\web\Controller;

//use app\modules\visits\reports\models\SalescentersSearch;

class BookingController extends Controller
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $tabs=[
            "sales_executive"=>[
                "name"=>"sales_executive",
                "title"=>"Sales Executive",
                "expanded"=>FALSE,
            ],
            "sales_center"=>[
                "name"=>"sales_center",
                "title"=>"Sales Center",
                "expanded"=>FALSE,
            ],
            "projects"=>[
                "name"=>"projects",
                "title"=>"Projects",
                "expanded"=>FALSE,
            ],
        ];
        
        $searchModel=NULL;
        $modelRows=NULL;
        $modelColumns=NULL;
        $model=NULL;
        
        if(isset(Yii::$app->request->queryParams["page"]))
        {
            $tabs[Yii::$app->request->queryParams["page"]]["expanded"]=TRUE;
            
            if(Yii::$app->request->queryParams["page"] == "sales_executive")
            {
                $rowmodel = new \app\modules\security\models\UserSearch();
                $colmodel = new \app\modules\propertyconfig\models\SizecatSearch();
                $searchModel = new \app\modules\visits\reports\models\PropertySearch();
                
                $modelRows = $rowmodel->salecenteruserlist();
                //->salesexecutivewisesummary(Yii::$app->request->queryParams);
                $modelColumns = $colmodel->thelist();
                //(Yii::$app->request->queryParams);
                $model = $searchModel->salesexecutivewisedata(Yii::$app->request->queryParams);
            }
            else if(Yii::$app->request->queryParams["page"] == "sales_center")
            {
                $rowmodel = new \app\modules\propertyconfig\models\CenterspermissionsSearch();
                $colmodel = new \app\modules\propertyconfig\models\SizecatSearch();
                $searchModel = new \app\modules\visits\reports\models\PropertySearch();
                
                $modelRows = $rowmodel->centerlist($_SESSION["user_array"]["id"]);
                //->salesexecutivewisesummary(Yii::$app->request->queryParams);
                $modelColumns = $colmodel->thelist();
                //(Yii::$app->request->queryParams);
                $model = $searchModel->salescenterwisedata(Yii::$app->request->queryParams);
            }
            else if(Yii::$app->request->queryParams["page"] == "projects")
            {
                $rowmodel = new \app\modules\propertyconfig\models\ProjectpermissionsSearch();
                $colmodel = new \app\modules\propertyconfig\models\SizecatSearch();
                $searchModel = new \app\modules\visits\reports\models\PropertySearch();
                
                $modelRows = $rowmodel->projectlist($_SESSION["user_array"]["id"]);
                //->salesexecutivewisesummary(Yii::$app->request->queryParams);
                $modelColumns = $colmodel->thelist();
                //(Yii::$app->request->queryParams);
                $model = $searchModel->salesexecutivewisedata(Yii::$app->request->queryParams);
            }
        }
        else
        {
            $tabs["sales_executive"]["expanded"]=TRUE;

            $rowmodel = new \app\modules\security\models\UserSearch();
            $colmodel = new \app\modules\propertyconfig\models\SizecatSearch();
            $searchModel = new \app\modules\visits\reports\models\PropertySearch();

            $modelRows = $rowmodel->salecenteruserlist();
            //->salesexecutivewisesummary(Yii::$app->request->queryParams);
            $modelColumns = $colmodel->thelist();
            //(Yii::$app->request->queryParams);
            $model = $searchModel->salesexecutivewisedata(Yii::$app->request->queryParams);
        }
        
        if($request->isAjax)
        {
            return $this->renderPartial('_index', [
                'searchModel' => $searchModel,
                'tabs' => $tabs,
                'modelRows' => $modelRows,
                'modelColumns' => $modelColumns,
                'model' => $model,
            ]);
        }
        else
        {
            return $this->render('index', [
                'searchModel' => $searchModel,
                'tabs' => $tabs,
                'modelRows' => $modelRows,
                'modelColumns' => $modelColumns,
                'model' => $model,
            ]);
        }
/*        if($request->isAjax)
        {
            return $this->renderPartial('index');
        }
        else
        {
            return $this->render('index');
        }*/
    }
}
