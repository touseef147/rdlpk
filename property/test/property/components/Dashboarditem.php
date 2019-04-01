<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class Dashboarditem extends Widget
{
    public $title;
    public $links;
    public $rights;
    public $colspan;
    
    public function init()
    {
        parent::init();
//        ob_start();
    }

	public function run()
	{
	    return $this->render('dashboarditem',["model"=>$this]);
	}
}

?>