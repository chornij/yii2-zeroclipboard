<?php

namespace chornij\zeroclipboard;

use yii\web\AssetBundle;

/**
 * Class ZeroClipboardAsset
 * Asset bundle for the zeroclipboard javascript library.
 *
 * @package chornij\zeroclipboard
 */
class ZeroClipboardAsset extends AssetBundle
{

    /**
     * @var string Source asset directory
     */
    public $sourcePath = '@vendor/chornij/yii2-zeroclipboard/';

    /**
     * @var array JavaScript files
     */
    public $js = ['dist/ZeroClipboard.min.js'];
}
