<?php

namespace app\modules\members\portal\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $this->layout = "@app/views/layouts/memlogin";

        $request = Yii::$app->request;
        $myrights = NULL;// \app\models\Model::getRights("index", "default", "members/dealers");
        $model = new LoginForm();
        
        if($request->isAjax)
        {
            return $this->renderPartial('index',[
                'model'=>$model,
            ]);
        }
        else
        {
            return $this->render('index',[
                'model'=>$model,
            ]);
        }
    }
}
