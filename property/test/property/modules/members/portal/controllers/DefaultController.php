<?php

namespace app\modules\members\portal\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\MemRegForm;

class DefaultController extends Controller {

    public function actions() {
        return [
            // ...
//            'captcha' => [
//                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//            ],
            
        ];
    }

    public function actionIndex() {
//        $value = Yii::$app->mailer->compose()
//                ->setTo('inamfromislamabad@gmail.com')
//                ->setSubject('email from yii2')
//                ->setHtmlBody('test email from yii2')
//                ->send();
        //->setFrom('admin@rdlpk.com')
        //->attach($model->attachment)

        $this->layout = "@app/views/layouts/memlogin";

        $request = Yii::$app->request;
        $myrights = NULL; // \app\models\Model::getRights("index", "default", "members/dealers");
        $model = new \app\models\MemberLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $sql = "select * from members where id = " . Yii::$app->member->id;

            $connection = Yii::$app->getDb();
            $cmdrow = $connection->createCommand($sql);
            $rows = $cmdrow->queryAll();

            $session = Yii::$app->session;
// open a session
            $session->open();

            $session->set('me', 'inam');
// close a session
            $session->close();
            $this->redirect("index.php?r=members/portal/dashboard/");
        }

        if ($request->isAjax) {
            return $this->renderPartial('index', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('index', [
                        'model' => $model,
            ]);
        }
    }

    public function actionRegister() {
        $this->layout = "@app/views/layouts/memlogin";

        $request = Yii::$app->request;
        $myrights = NULL; // \app\models\Model::getRights("index", "default", "members/dealers");
        $model = new MemRegForm();

        if ($request->isAjax) {
            return $this->renderPartial('register', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('register', [
                        'model' => $model,
            ]);
        }
    }

}
