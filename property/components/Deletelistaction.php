<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class Deletelistaction extends Widget
{
    public $action;
    public $id;
    
    public $rights;
    
    public function init()
    {
        parent::init();
//        ob_start();
    }

	public function run()
	{
	    return $this->render('deletelistaction',["model"=>$this]);
	}
}

?>