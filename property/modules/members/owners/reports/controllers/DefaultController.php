<?php

namespace app\modules\members\dealers\reports\controllers;

use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        
        if($request->isAjax)
        {
            return $this->renderPartial('index');
        }
        else
        {
            return $this->render('index');
        }
    }
    
    public function actionOverallsales() {
        $request = Yii::$app->request;

        //$searchModel = new MembersSearch();
        $dataProvider = NULL;
        $myrights = \app\models\Model::getRights("index", "dealers", "members/dealers");

//        if (count(Yii::$app->request->queryParams) == 1) {
//            $res = \app\models\Model::checksavedinfo(Yii::$app->request->queryParams);
//
//            if ($res == NULL) {
//                $dataProvider = $searchModel->searchdealers(Yii::$app->request->queryParams);
//
//                $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
//                $dataProvider->pagination->page = $request->get("pageno", 0);
//            } else {
//                $dataProvider = $searchModel->searchdealers($res);
//
//                $dataProvider->pagination->pageSize = (isset($res["pagesize"]) ? $res["pagesize"] : 20); //$request->get("pagesize", 20);
//                $dataProvider->pagination->page = (isset($res["pageno"]) ? $res["pageno"] : 0); //$request->get("pagesize", 20);
//            }
//        } else {
//            \app\models\Model::savebrowsinginfo();
//
//            $dataProvider = $searchModel->searchdealers(Yii::$app->request->queryParams);
//
//            $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
//            $dataProvider->pagination->page = $request->get("pageno", 0);
//        }

        $sql = "Select
  members.id,
  members.name,
  members.image,
  members_dealer_groups.group_title,
  members.dealers_business_title,
  members.is_dealer,
  Count(property_application.application_id) As no_of_applications
From
  members Left Join
  members_dealer_groups On members.dealer_group_id =
    members_dealer_groups.group_id Inner Join
  property_application On members.id = property_application.dealer_id
Where
  members.is_dealer = 1
Group By
  members.id, members.name, members_dealer_groups.group_title, members.image, 
  members.dealers_business_title, members.is_dealer";
        
        $columns = "Select  * From  size_cat order by code asc";
        
        $sqlvalues = "Select
  Count(property_application.application_id) As no_of_applications,
  property_application.property_size,
  property_application.dealer_id
From
  property_application Inner Join
  size_cat On size_cat.id = property_application.property_size
Group By
  property_application.property_size, property_application.dealer_id,
  size_cat.code
Order By
  property_application.dealer_id,
  size_cat.code";
        
        $connection = Yii::$app->getDb();
        $cmd = $connection->createCommand($sql);
        $dataProvider = $cmd->queryAll();
        
        $cmd = $connection->createCommand($columns);
        $dataProvidercolumns = $cmd->queryAll();
        
        $cmd = $connection->createCommand($sqlvalues);
        $dataProvidervalues = $cmd->queryAll();
        
        if ($request->isAjax) {
            return $this->renderPartial('oasales', [
          //              'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'dataProvidercolumns' => $dataProvidercolumns,
                        'dataProvidervalues' => $dataProvidervalues,
                        'myrights' => $myrights,
            ]);
        } else {
            return $this->render('oasales', [
            //            'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'dataProvidercolumns' => $dataProvidercolumns,
                        'dataProvidervalues' => $dataProvidervalues,
                        'myrights' => $myrights,
            ]);
        }
    }

    public function actionSidebaroasales() {
        $res = \app\models\Model::checksavedinfo(["r" => "members/dealers/reports/oasales"]);
        $myrights = \app\models\Model::getRights("index", "dealers", "members/dealers");

        $searchModel = $searchModel = new MembersSearch();
        $searchModel->loadparams($res);

        return $this->renderPartial('_summarysearch', [
                    'searchModel' => $searchModel,
                    'myrights' => $myrights,
        ]);
    }
    
    
    public function actionSizewisesales() {
        $request = Yii::$app->request;

        //$searchModel = new MembersSearch();
        $dataProvider = NULL;
        $myrights = \app\models\Model::getRights("index", "dealers", "members/dealers");

//        if (count(Yii::$app->request->queryParams) == 1) {
//            $res = \app\models\Model::checksavedinfo(Yii::$app->request->queryParams);
//
//            if ($res == NULL) {
//                $dataProvider = $searchModel->searchdealers(Yii::$app->request->queryParams);
//
//                $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
//                $dataProvider->pagination->page = $request->get("pageno", 0);
//            } else {
//                $dataProvider = $searchModel->searchdealers($res);
//
//                $dataProvider->pagination->pageSize = (isset($res["pagesize"]) ? $res["pagesize"] : 20); //$request->get("pagesize", 20);
//                $dataProvider->pagination->page = (isset($res["pageno"]) ? $res["pageno"] : 0); //$request->get("pagesize", 20);
//            }
//        } else {
//            \app\models\Model::savebrowsinginfo();
//
//            $dataProvider = $searchModel->searchdealers(Yii::$app->request->queryParams);
//
//            $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
//            $dataProvider->pagination->page = $request->get("pageno", 0);
//        }

        $sql = "Select
  size_cat.id,
  size_cat.size,
  size_cat.code,
  files.no_of_files,
  plotcount.no_of_files As no_of_plots
From
  size_cat Left Outer Join
  (Select
    Count(plots.application_id) As no_of_files,
    plots.size2
  From
    plots
  Where
    plots.type = 'file' And
    plots.application_id Is Not Null And
    plots.application_id != 0
  Group By
    plots.size2) files On size_cat.id = files.size2 Left Outer Join
  (Select
    Count(plots.application_id) As no_of_files,
    plots.size2
  From
    plots
  Where
    plots.type != 'file' And
    plots.application_id Is Not Null And
    plots.application_id != 0
  Group By
    plots.size2) plotcount On size_cat.id = plotcount.size2
Group By
  size_cat.id, size_cat.size, size_cat.code, plotcount.no_of_files";
        
        $connection = Yii::$app->getDb();
        $cmd = $connection->createCommand($sql);
        $dataProvider = $cmd->queryAll();
        
        if ($request->isAjax) {
            return $this->renderPartial('sizewisesales', [
          //              'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'myrights' => $myrights,
            ]);
        } else {
            return $this->render('sizewisesales', [
            //            'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'myrights' => $myrights,
            ]);
        }
    }
}
