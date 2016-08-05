<?php
namespace jerryteng\daterangepicker;

use yii\helpers\Json;
use yii\base\Widget;
use yii\web\View;
use yii\web\JsExpression;

/**
 * DateRangePicker renders a DatePicker range input.
 *
 */
class DateRangePicker extends Widget
{
    /**
     * @var string the attribute name for date range (to Date)
     */
    public $id;
    /**
     * @var array HTML attributes for the date to input
     */
    public $options = array();

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerAssets();
        parent::run();
    }

    /**
     * Registers required script for the plugin to work as DateRangePicker
     */
    public function registerAssets()
    {
        DateRangePickerAsset::register($this->view);

        $key = __CLASS__ . '#' . $this->id;
        $this->options['success'] =  new JsExpression($this->options['success']);
        
        $jsOptions = Json::encode($this->options);
        $javascript = "var dateRange = new pickerDateRange('".$this->id."', ".$jsOptions.");";
        $this->view->registerJs($javascript, View::POS_READY, $key);
    }

}
