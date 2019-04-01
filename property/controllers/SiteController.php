<?php

namespace app\controllers;

if (!isset($_SESSION)) {
    //session_start();
}

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use  yii\web\Session;

class SiteController extends Controller {

    public function behaviors() {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['logout'],
//                'rules' => [
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
//            'captcha' => [
//                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//            ],
        ];
    }

    public function actionIndex() {
        /*        if (!\Yii::$app->user->isGuest) {
          return $this->goHome();
          }
         */
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $sql = "select * from user where id = " . Yii::$app->user->id;

            $connection = Yii::$app->getDb();
            $cmdrow = $connection->createCommand($sql);
            $rows = $cmdrow->queryAll();

$session = Yii::$app->session;
// open a session
$session->open();

$session->set('me', 'inam');
// close a session
$session->close();

// destroys all data registered to a session.
//$session->destroy();
            //$_SESSION["user_array"]=$rows;
            //print_r($_SESSION);
            //return;
            //Yii::$app->session["user_array"]=$rows;
            //$session = new Session;

            //$session->open();
//            session_start();
            //session_register("user_array", $rows);
//            $_SESSION['user_array'] = "inam";
            //Yii::$app->session->set('user_array', $rows);
            //print_r(Yii::$app->session->get('user_array'));
            //return;
            //print_r($_SESSION);
            //return;
            $this->redirect("index.php?r=dashboard/");
//            return $this->goBack();
        }
        
        if(Yii::$app->user->id !=null)
        {
            $this->redirect("index.php?r=dashboard/");
        }

        unset(Yii::$app->session['user_array']);

        $this->layout = "@app/views/layouts/login";

        return $this->render('login', [
                    'model' => $model,
        ]);
//        return $this->render('index');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionDashboarditem($params)
    {
        print_r($params);
        return;
        //return $this->render('dashboarditem');
    }
}
