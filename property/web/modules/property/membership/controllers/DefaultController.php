<?php

namespace app\modules\property\membership\controllers;

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
}
