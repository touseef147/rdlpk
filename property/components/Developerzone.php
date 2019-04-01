<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class Developerzone extends Widget
{
    public $items;
    
    public function init()
    {
        parent::init();
//        ob_start();
    }

	public function run()
	{
	    return $this->render('developerzone',["model"=>$this]);
	}
}

?>