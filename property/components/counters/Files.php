<?php
namespace app\components\counters;

use yii\base\Widget;
use yii\helpers\Html;

class Files extends Widget
{
    public $items;
    
    public function init()
    {
        parent::init();
//        ob_start();
    }

	public function run()
	{
	    return $this->render('files',["model"=>$this]);
	}
}

?>