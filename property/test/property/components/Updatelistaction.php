<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class Updatelistaction extends Widget
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
	    return $this->render('updatelistaction',["model"=>$this]);
	}
}

?>