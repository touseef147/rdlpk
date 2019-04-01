<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class Commentbox extends Widget
{
    public $title;
    public $dataurl;
    public $submiturl;
    public $allowadd;
    public $parentval;
    
    public function init()
    {
        parent::init();
//        ob_start();
    }

	public function run()
	{
	    return $this->render('commentbox',["model"=>$this]);
	}
}

?>