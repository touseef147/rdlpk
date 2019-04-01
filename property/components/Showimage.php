<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class Showimage extends Widget
{
    public $title;
    public $links;
    public $path;
    public $path;
    public $file_name;
    public $width;
    
    public function init()
    {
        parent::init();
//        ob_start();
    }

	public function run()
	{
	    return $this->render('showimage',["model"=>$this]);
	}
}

?>