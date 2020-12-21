<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css2/bootstrap.min.css',
        'fonts/css/font-awesome.min.css',
        'css2/custom.css',
        //'css2/maps/jquery-jvectormap-2.0.3.css',
       // 'css2/skins/_all-skins.min.css',
        //'css2/icheck/flat/green.css',
       // 'css2/floatexamples.css" rel="stylesheet',
       	'css2/site.css',
    ];
    public $js = [
        //'js/jquery.min.js',
        //'js/bootstrap.min.js',
        //'js/progressbar/bootstrap-progressbar.min.js',
       // 'js/icheck/icheck.min.js',
        //'js/moment/moment.min.js',
       // 'js/datepicker/daterangepicker.js',
      //  'js/chartjs/chart.min.js',
        //'js/sparkline/jquery.sparkline.min.js',
        'js/custom.js',
        /*'js/flot/jquery.flot.js',
        'js/flot/jquery.flot.pie.js',
        'js/flot/jquery.flot.orderBars.js',
        'js/flot/jquery.flot.time.min.js',
        'js/flot/date.js',
        'js/flot/jquery.flot.spline.js',
        'js/flot/jquery.flot.stack.js',
        'js/flot/curvedLines.js',
        'js/flot/jquery.flot.resize.js',*/
        //'js/pace/pace.min.js',
        'js/main.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
