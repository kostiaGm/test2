<?php

Yii::import('ext.SimpleHTMLDOM.SimpleHTMLDOM');

class ParserSite extends SimpleHTMLDOM {

    private $_domain = "";
    private $_fh;
    private $_data = [];

    public function __construct($domain) {
        $this->_domain = $domain;
        $this->_fh = fopen('tst.txt', 'w');
    }

    public function getHttpReplay($url) {
        print_r(get_headers($url));
        print_r(get_headers($url, 1));
        return true;
    }

    public function getUrlList($url) {

        $ret = [];
         $this->_data[$url] = false;
        try {
            $html = $this->file_get_html($url);
        } catch (Exception $e) {
            throw new Exception("error: $url");
        }

// Find all links
        foreach ($html->find('a') as $element) {
            if (preg_match('/(^\/)|(' . str_replace(array('http:', '/', 'www', ''), '', $url) . '\.+)/', $element->href)) {
                if ($element->href != '/' && $element->href != $url) {
                    $ret['site'][] = $element->href;
                    $this->_data[$this->_domain.$element->href] = false;
                } else if ($element->href != '#') {
                    $ret['nosite'][] = $element->href . "\n";
                }
            }
        }
        return $ret;
    }

    public function run($url = "", $level = 0) {

       
        $arr = $this->getUrlList($url);
        if ($level >= 100)
            return;
        if ($arr) {
            $counter = 0;
            foreach ($arr['site'] as $index => $item) {
                 if ((isset($this->_data[$url]) && !$this->_data[$url]) || (isset($this->_data[$this->_domain.$url]) && !$this->_data[$this->_domain.$url])) {
                    if ($this->_fh)
                        fwrite($this->_fh, str_pad('', $level) . $this->_domain.$item." ($level)\n");
                    if ($counter <= 150) {
                        $this->run($this->_domain.$item, $level + 1);
                    }
                    
                    $this->_data[$url] = true;
                }
                $counter++;
            }
        }
        return true;
    }

    public function __destruct() {
        if ($this->_fh)
            fclose($this->_fh);
    }

}
