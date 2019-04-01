<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class Pageheader extends Widget
{
    public $title;
    public $subtitle;
    
    public function init()
    {
        parent::init();
//        ob_start();
    }

	public function run()
	{
	    return $this->render('pageheader',["model"=>$this]);
	}
}

?>