<?php

namespace app\modules\marketting\visitors\controllers;

use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $myrights = \app\models\Model::getRights("index", "default", "visits");
        
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
