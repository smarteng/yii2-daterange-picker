<?php
namespace jerryteng\daterangepicker;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\base\Widget;

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
        $view = $this->getView();
        Yii::$app->getAssetManager()->publish(\Yii::getAlias('@vendor').'/smarteng/yii2-daterange-picker/src/assets');
        DateRangePickerAsset::register($view);

        $key = __CLASS__ . '#' . $this->id;
        $jsOptions = Json::encode($this->options);
        $javascript = "var dateRange = new pickerDateRange('".$this->id."', ".$jsOptions.");";
        $view->registerJs($javascript, View::POS_READY, $key);
    }

}
