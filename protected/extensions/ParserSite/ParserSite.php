<?php

if (defined('PARSE_SITE_TEST_PHP'))
    include_once PATH . '/../extensions/SimpleHTMLDOM/SimpleHTMLDOM.php';
else
    Yii::import('ext.SimpleHTMLDOM.SimpleHTMLDOM');

class ParserSite extends SimpleHTMLDOM {

    public function getUrlList($url) {


// Create DOM from URL or file
        $simpleHTML = new SimpleHTMLDOM;
        $html = $simpleHTML->file_get_html('http://www.google.com/');

// Find all images
        foreach ($html->find('img') as $element)
            echo $element->src . '<br>';

// Find all links
        foreach ($html->find('a') as $element)
            echo $element->href . '<br>';

        return true;
    }

}
