<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Model extends \yii\base\Model {

    /**
     * Creates and populates a set of models.
     *
     * @param string $modelClass
     * @param array $multipleModels
     * @return array
     */
        public static function createMultiple($modelClass, $multipleModels = []) {
        $model = new $modelClass;
        $formName = $model->formName();
        $post = Yii::$app->request->post($formName);
        $models = [];

        if (!empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }

  /*  public static function createMultiple($modelClass,$customName="", $multipleModels = []) {
        $model = new $modelClass;
        $formName = $model->formName();
        $post = Yii::$app->request->post(); //$formName
        $models = [];
        $customindex=-1;
        $count=-1;

        if (!empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }
        
        //print_r($multipleModels);
        
        
        if($customName!= "")
        {
            $arrtemp = array_keys($post);
            $tmpidx=-1;
            
            foreach($arrtemp as $temp)
            {
                $tmpidx++;
                
                //if($temp == $customName)
            }
        }
        
        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                //if(isset($item['id']))
                    //print_r($item);
                    //echo "<br /><br />   ";
                
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
                $count++;
            }
        }

        echo $count;
        unset($model, $formName, $post);

        return $models;
    }
*/
    public static function getRights($screen = "", $controller = "", $module = "",$parentmodule=0) {
//        if ($_SESSION["user_array"]["role_type"] == 1) {
        if(Yii::$app->user->identity->roletype ==1){
            $sql = "Select
  target_module.module_code,
  target_controller.controller_code,
  target_action.action_code
From
  sec_modules Inner Join
  sec_controller On sec_controller.module_id = sec_modules.module_id Inner Join
  sec_module_actions On sec_module_actions.controller_id =
    sec_controller.controller_id Inner Join
  sec_target_screens On sec_module_actions.action_id =
    sec_target_screens.parent_screen_id Inner Join
  sec_module_actions target_action On sec_target_screens.target_screen_id =
    target_action.action_id Inner Join
  sec_controller target_controller On target_controller.controller_id =
    target_action.controller_id Inner Join
  sec_modules target_module On target_module.module_id =
    target_controller.module_id
Where
  sec_modules.module_code = '" . $module . "' And
  sec_controller.controller_code = '" . $controller . "' And
  sec_module_actions.action_code = '" . $screen . "' And 
  target_action.for_admin = 1 ";
            //echo $sql;
        } else {
            $sql = "Select
  target_module.module_code,
  target_controller.controller_code,
  target_action.action_code
From
  sec_modules Inner Join
  sec_controller On sec_controller.module_id = sec_modules.module_id Inner Join
  sec_module_actions On sec_module_actions.controller_id =
    sec_controller.controller_id Inner Join
  sec_target_screens On sec_module_actions.action_id =
    sec_target_screens.parent_screen_id Inner Join
  sec_role_rights On sec_target_screens.target_screen_id =
    sec_role_rights.action_id Inner Join
  sec_module_actions target_action On sec_role_rights.action_id =
    target_action.action_id Inner Join
  sec_controller target_controller On target_controller.controller_id =
    target_action.controller_id Inner Join
  sec_modules target_module On target_module.module_id =
    target_controller.module_id
Where
  sec_modules.module_code = '" . $module . "' And
  sec_controller.controller_code = '" . $controller . "' And
  sec_module_actions.action_code = '" . $screen . "' And
  sec_role_rights.role_id = " . Yii::$app->user->identity->role;
        }
//echo $sql;
        $connection = Yii::$app->getDb();
        $cmd = $connection->createCommand($sql);
        $records = $cmd->queryAll();

        $rows = array();

        foreach ($records as $rec) {
            $rows[$rec["module_code"] . "/" . $rec["controller_code"] . "/" . $rec["action_code"]] = 1;
        }

        return $rows;
    }

    public static function getViewName($screen = "", $controller = "", $module = "") {
        if (Yii::$app->user->identity->roletype == 1) {
            $sql = "Select
  sec_module_actions.view_name
From
  sec_modules Inner Join
  sec_controller On sec_controller.module_id = sec_modules.module_id Inner Join
  sec_module_actions On sec_module_actions.controller_id =
    sec_controller.controller_id 
Where
  sec_modules.module_code = '" . $module . "' And
  sec_controller.controller_code = '" . $controller . "' And
  sec_module_actions.action_code = '" . $screen . "' And 
  sec_module_actions.for_admin = 1 ";
            //echo $sql;
        } else {
            $sql = "Select
  sec_module_actions.view_name
From
  sec_modules Inner Join
  sec_controller On sec_controller.module_id = sec_modules.module_id Inner Join
  sec_module_actions On sec_module_actions.controller_id =
    sec_controller.controller_id Inner Join
  sec_role_rights On sec_module_actions.action_id =
    sec_role_rights.action_id
Where
  sec_modules.module_code = '" . $module . "' And
  sec_controller.controller_code = '" . $controller . "' And
  sec_module_actions.action_code = '" . $screen . "' And
  sec_role_rights.role_id = " . Yii::$app->user->identity->role;
        }
//echo $sql;
        $connection = Yii::$app->getDb();
        $cmd = $connection->createCommand($sql);
        $records = $cmd->queryAll();

        foreach ($records as $rec) {
            return $rec["view_name"];
        }

        return "";
    }

    public static function checksavedinfo($qrystr) {
        if (count(Yii::$app->request->queryParams) == 1) {
            if (Yii::$app->getRequest()->getCookies()->has('rdlpk_page')) {
                $cookies = Yii::$app->request->cookies;
                $cookie = $cookies["rdlpk_page"];

                //print_r($cookie->value);
                //echo "\n\n";
                //print_r($qrystr);
                //if(Yii::$app->request->queryParams["r"] ==$cookie->value["r"]."index" || Yii::$app->request->queryParams["r"] ==$cookie->value["r"])
                if ($qrystr["r"] == $cookie->value["r"] . "index" || $qrystr["r"] == $cookie->value["r"] . "/index" || $qrystr["r"] . "/" == $cookie->value["r"] || $qrystr["r"] == $cookie->value["r"]) {
                    //Yii::$app->request->queryParams=$cookie->value;
                    //$qrystr=$cookie->value;
                    //echo "sssss";
                    return $cookie->value;
                } else {
                    //echo "here";
                    //unset($cookies['rdlpk_page']);
                    /* if (isset($_COOKIE['rdlpk_page'])) {
                      unset($_COOKIE['rdlpk_page']);
                      setcookie('rdlpk_page', '', time() - 3600, '/'); // empty value and old timestamp
                      } */
                }
            }
        } else {
            //echo Yii::$app->request->queryParams;
            $newCookie = new \yii\web\Cookie();
            $newCookie->name = 'rdlpk_page';
            $newCookie->value = Yii::$app->request->queryParams;
            $newCookie->expire = time() + 60 * 60 * 24 * 180;
            $cookie = Yii::$app->getResponse()->getCookies()->add($newCookie);
            //print_r($newCookie);
        }

        return NULL;
    }

    public static function savebrowsinginfo() {
        /* if (isset($_COOKIE['rdlpk_page'])) {
          unset($_COOKIE['rdlpk_page']);
          setcookie('rdlpk_page', '', time() - 3600, '/'); // empty value and old timestamp
          } */

        $newCookie = new \yii\web\Cookie();
        $newCookie->name = 'rdlpk_page';
        $newCookie->value = Yii::$app->request->queryParams;
        $newCookie->expire = time() + 60 * 60 * 24 * 180;
        $cookie = Yii::$app->getResponse()->getCookies()->add($newCookie);
        return NULL;
    }
    
    public static function loaddata(&$dataProvider,&$searchModel, $request, $params){
        if (count($params) == 1) {
            $res = \app\models\Model::checksavedinfo($params);

            if ($res == NULL) {
                $dataProvider = $searchModel->search($params);

                $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
                $dataProvider->pagination->page = $request->get("pageno", 0);
            } else {
                $dataProvider = $searchModel->search($res);

                $dataProvider->pagination->pageSize = (isset($res["pagesize"]) ? $res["pagesize"] : 20); //$request->get("pagesize", 20);
                $dataProvider->pagination->page = (isset($res["pageno"]) ? $res["pageno"] : 0); //$request->get("pagesize", 20);
            }
        } else {
            \app\models\Model::savebrowsinginfo();

            $dataProvider = $searchModel->search($params);

            $dataProvider->pagination->pageSize = $request->get("pagesize", 20);
            $dataProvider->pagination->page = $request->get("pageno", 0);
        }
    }

    public static function dashboarditem($params)
    {
        print_r($params);
    }

    public static function showerrors($errors, $class,$method)
    {
        if (count($errors) > 0) {
            if (Yii::$app->user->identity->rawerrors == 1) {
                echo "<h3>" . $class . " Model: ".$method."</h3>";
                print_r($errors);
            }
        }
    }
}
