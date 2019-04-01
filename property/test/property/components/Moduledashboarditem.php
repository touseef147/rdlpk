<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class Moduledashboarditem extends Widget
{
    public $title;
    public $links;
    public $rights;
    public $protected;
    
    public function init()
    {
        parent::init();
//        ob_start();
    }

	public function run()
	{
	    return $this->render('moduledashboarditem',["model"=>$this]);
	}
}

?>