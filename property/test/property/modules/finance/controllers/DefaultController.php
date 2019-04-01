<?php

namespace app\modules\finance\controllers;

use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "default", "finance");
        
        if($request->isAjax)
        {
            return $this->renderPartial('index',[
                'myrights'=>$myrights,
            ]);
        }
        else
        {
            return $this->render('index',[
                'myrights'=>$myrights,
            ]);
        }
    }
}
