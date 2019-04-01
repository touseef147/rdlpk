<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class Detaillistaction extends Widget
{
    public $action;
    public $id;
    public $text;
    
    public $rights;
    
    public function init()
    {
        parent::init();
//        ob_start();
    }

	public function run()
	{
	    return $this->render('detaillistaction',["model"=>$this]);
	}
}

?>