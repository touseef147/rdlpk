<?php

namespace app\modules\members\portal\controllers;

use Yii;
use yii\web\Controller;

class DashboardController extends Controller
{
    public function actionIndex()
    {
        $this->layout = "@app/views/layouts/memarea";

        $request = Yii::$app->request;
        $member = \app\models\application\Members::find()->where(['id' => Yii::$app->member->identity->id])->one();
        $payabledues = \app\models\application\Plots::find()->joinWith('currentmembership')->joinWith('installmentplan')->where(['installpayment.paidamount' => 0])->andWhere(['property_memberships.member_id' => Yii::$app->member->identity->id])->andWhere(['<=', 'installpayment.due_date', date("y-m-d")])->all();
        $myproperty = \app\models\application\Plots::find()->joinWith('currentmembership')->where(['property_memberships.member_id' => Yii::$app->member->identity->id])->all();
        //$myrights = NULL;// \app\models\Model::getRights("index", "default", "members/dealers");
        
        $model = null;
        
        if($request->isAjax)
        {
            return $this->renderPartial('index',[
                'member'=>$member,
                'payabledues'=>$payabledues,
                'myproperty'=>$myproperty,
            ]);
        }
        else
        {
            return $this->render('index',[
                'member'=>$member,
                'payabledues'=>$payabledues,
                'myproperty'=>$myproperty,
            ]);
        }
    }
}
