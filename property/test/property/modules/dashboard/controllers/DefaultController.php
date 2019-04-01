<?php

namespace app\modules\dashboard\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;

class DefaultController extends Controller {

    public function actionIndex() {
//        if (Yii::$app->user->id == null) {
//            //$this->redirect("index.php");
//        }
        
        print_r(Yii::$app->user);

        $request = Yii::$app->request;
        //$_SESSION['user_array'] = $rows;
        //      echo Yii::$app->user->identity->roletype;
//        echo Yii::$app->user->identity->fullname;
//        print_r($_SESSION);
        //    echo "sdf";
        //echo Yii::$app->session->get('user_array');
        //    return;
        $myrights = \app\models\Model::getRights("index", "default", "dashboard");

        if ($request->isAjax) {
            return $this->renderPartial('index', [
                        'myrights' => $myrights,
            ]);
        } else {
            return $this->render('index', [
                        'myrights' => $myrights,
            ]);
        }
    }

}
