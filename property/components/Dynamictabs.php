<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class Dynamictabs extends Widget
{
    public $items;
    public $rights;
    
    public function init()
    {
        parent::init();
//        ob_start();
    }

	public function run()
	{
	    return $this->render('dynamictabs',["model"=>$this]);
	}
}

?>