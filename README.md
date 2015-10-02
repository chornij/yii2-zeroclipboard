Yii2 ZeroClipboard v2.x extension
=================================
The ZeroClipboard library provides an easy way to copy text to the clipboard using an invisible Adobe Flash movie and a JavaScript interface.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist chornij/yii2-zeroclipboard "dev-master"
```

or add

```
"chornij/yii2-zeroclipboard": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= chornij\zeroclipboard\Button::widget([
    'label' => '<span class="glyphicon glyphicon-copy"></span> ' . \Yii::t('app', 'Copy'),
    'encodeLabel' => false,
    'text' => "$('.copy-selector').text()",
]) ?>

<div class="copy-selector">
My text to copy!
</div>
```
Once clicked on Copy button it should change the status to Copied! If it does not change then make sure that your Flash Plugin is enabled in browser. If you are using Chrome check the following settings: 
chrome://plugins/
and make sure that Adobe Flash Player plugin is enabled.
