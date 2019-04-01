<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
//use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        /*'css/site.css',*/
        
        'css/bootstrap.min.css',
        
        'css/fontawesome/css/font-awesome.min.css',
        
        'css/jquery-ui.custom.min.css',
        'css/chosen.min.css',
        'css/bootstrap-datepicker3.min.css',
//        'css/bootstrap-timepicker.min.css',
  //      'css/daterangepicker.min.css',
    //    'css/bootstrap-datetimepicker.min.css',
      //  'css/colorpicker.min.css',
        
        
        //'http://fonts.googleapis.com/css?family=Open+Sans:400,300',
        'css/fonts.css',
        
        'css/ace.min.css',
        
        'css/custom.css',
    ];
    public $js = [
        'js/ace-extra.min.js',
        
        'js/jquery.min.js',
        
        'js/bootstrap.min.js',
        
    //    'js/jquery-ui.custom.min.js',
  //      'js/jquery.ui.touch-punch.min.js',
//        'js/chosen.jquery.min.js',
//        'js/fuelux/fuelux.spinner.min.js',
        'js/date-time/bootstrap-datepicker.min.js',
  //      'js/date-time/bootstrap-timepicker.min.js',
    //    'js/date-time/moment.min.js',
      //  'js/date-time/daterangepicker.min.js',
//        'js/date-time/bootstrap-datetimepicker.min.js',
  //      'js/bootstrap-colorpicker.min.js',
    //    'js/jquery.knob.min.js',
      //  'js/autosize.min.js',
//        'js/jquery.inputlimiter.1.3.1.min.js',
  //      'js/jquery.maskedinput.min.js',
    //    'js/bootstrap-tag.min.js',
        
        'js/ace-elements.min.js',
        'js/ace.min.js',
        'js/custom.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
  //      'yii\bootstrap\BootstrapAsset',
    ];
    
  /*  public function init() {
        $this->jsOptions['position'] = View::POS_BEGIN;
        parent::init();
    }
*/
}
