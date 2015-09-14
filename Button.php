<?php

namespace chornij\zeroclipboard;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\View;

/**
 * Class Button
 * @package chornij\zeroclipboard
 */
class Button extends Widget
{

    /**
     * @var array the HTML attributes for the widget container tag.
     */
    public $options = [];

    /**
     * @var string the button label
     */
    public $label = 'Copy';

    /**
     * @var boolean whether the label should be HTML-encoded.
     */
    public $encodeLabel = true;

    /**
     * @var bool Enable base aftercopy handler
     */
    public $enableAftercopy = true;

    /**
     * @var string Aftercopy button label
     */
    public $afterCopyLabel = 'Copied!';

    /**
     * @var string Text for copy
     */
    public $text;

    /**
     * @inheritdoc
     *
     * @throws InvalidConfigException
     */
    public function run()
    {
        parent::run();

        if (is_null($this->text)) {
            throw new InvalidConfigException('Text for copy not set');
        }

        if (isset($this->options['id'])) {
            $this->id = $this->options['id'];
        } elseif (is_null($this->id)) {
            $this->id = $this->options['id'] = $this->getId();
        } else {
            $this->options['id'] = $this->id;
        }

        if (!isset($this->options['class'])) {
            $this->options['class'] = 'btn btn-primary';
        }

        $this->registerScript();

        $label = $this->encodeLabel ? Html::encode($this->label) : $this->label;

        return Html::button($label, $this->options);
    }

    /**
     * Register button scripts
     */
    private function registerScript()
    {
        ZeroClipboardAsset::register($this->getView());

        $clipboardVar = 'client' . preg_replace('/[^0-9a-zA-Z_$]/', '_', $this->id);
        $this->getView()->registerJs('var ' . $clipboardVar . ';', View::POS_HEAD);
        $this->getView()->registerJs(
            $clipboardVar . " = new ZeroClipboard($('#" . $this->id . "'));

            " . $clipboardVar . ".on('copy', function (event) {
                var clipboard = event.clipboardData;

                clipboard.setData('text/plain', " . $this->text . ');
            });'
        );

        if ($this->enableAftercopy) {
            $this->getView()->registerJs($clipboardVar . ".on('aftercopy', function(event) {
                var oldLabel = $('#" . $this->id . "').html();

                $('#" . $this->id . "').html('" . $this->afterCopyLabel . "');

                setTimeout(function() {
                    $('#" . $this->id . "').html(oldLabel);
                }, 1000);
            });");
        }
    }
}
