<?php

namespace app\modules\marketting\visitors\reports\controllers;

use Yii;
use yii\web\Controller;

use kartik\mpdf\Pdf;

//use app\modules\visits\reports\models\SalescentersSearch;

class DefaultController extends Controller
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
        ];
        
        $searchModel = new \app\modules\visits\reports\models\OverallSearch();
        $model=NULL;
        
        if(isset(Yii::$app->request->queryParams["page"]) && Yii::$app->request->queryParams["page"] !="")
        {
            $tabs[Yii::$app->request->queryParams["page"]]["expanded"]=TRUE;
            
            if(Yii::$app->request->queryParams["page"] == "sales_executive")
            {
                $model = $searchModel->salesexecutivewisesummary(Yii::$app->request->queryParams);
            }
            else if(Yii::$app->request->queryParams["page"] == "sales_center")
            {
                $model = $searchModel->salescenterwisesummary(Yii::$app->request->queryParams);
            }
        }
        else
        {
            $tabs["sales_executive"]["expanded"]=TRUE;

            $model = $searchModel->salesexecutivewisesummary(Yii::$app->request->queryParams);
        }
        
        if($request->isAjax)
        {
            return $this->renderPartial('_index', [
                'searchModel' => $searchModel,
                'tabs' => $tabs,
                'model' => $model,
            ]);
        }
        else
        {
            return $this->render('index', [
                'searchModel' => $searchModel,
                'tabs' => $tabs,
                'model' => $model,
            ]);
        }
    }


    public function actionPrintsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;
        
        $searchModel = new \app\modules\visits\reports\models\OverallSearch();
        $model=NULL;
        
        if(Yii::$app->request->queryParams["page"] == "sales_executive")
        {
            $model = $searchModel->salesexecutivewisesummary(Yii::$app->request->queryParams);
        }
        else if(Yii::$app->request->queryParams["page"] == "sales_center")
        {
            $model = $searchModel->salescenterwisesummary(Yii::$app->request->queryParams);
        }
        
      //  $dataProvider->pagination=false;
        
        return $this->render(Yii::$app->request->queryParams["page"].'_printable',[
                'model' => $model,
        ]);
    }

    public function actionPdfsummary()
    {
        $this->layout = "@app/views/layouts/print";

        $request = Yii::$app->request;
        
        $searchModel = new \app\modules\visits\reports\models\OverallSearch();
        $model=NULL;
        
        if(Yii::$app->request->queryParams["page"] == "sales_executive")
        {
            $model = $searchModel->salesexecutivewisesummary(Yii::$app->request->queryParams);
        }
        else if(Yii::$app->request->queryParams["page"] == "sales_center")
        {
            $model = $searchModel->salescenterwisesummary(Yii::$app->request->queryParams);
        }
        
  //      $dataProvider->pagination=false;
        
        $pdf = new Pdf([
                'content'=>$this->render(Yii::$app->request->queryParams["page"].'_printable',[
                                'model' => $model,
                                ]),
                'filename'=> "report.pdf",
                'mode'=> Pdf::MODE_CORE,
                'format'=> Pdf::FORMAT_A4,
                'destination'=> Pdf::DEST_DOWNLOAD
                ]);
        return $pdf->render();
    }

    public function actionChart()
    {
        $this->layout = "@app/views/layouts/chart";

        $request = Yii::$app->request;
        
        $searchModel = new \app\modules\visits\reports\models\OverallSearch();
        $model=NULL;
        
        if(Yii::$app->request->queryParams["page"] == "sales_executive")
        {
            $model = $searchModel->salesexecutivewisesummary(Yii::$app->request->queryParams);
        }
        else if(Yii::$app->request->queryParams["page"] == "sales_center")
        {
            $model = $searchModel->salescenterwisesummary(Yii::$app->request->queryParams);
        }
        
      //  $dataProvider->pagination=false;
        
        return $this->render(Yii::$app->request->queryParams["page"].'_chart',[
                'model' => $model,
        ]);
    }

    public function actionSidebarsummary()
    {
        $searchModel = new \app\modules\visits\reports\models\OverallSearch();

        return $this->renderPartial('_summarysearch',[
                'searchModel' => $searchModel,
        ]);
    }
    
}
