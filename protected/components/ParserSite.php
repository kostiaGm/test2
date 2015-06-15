<?php

class ParserSite {

    protected $_url;
    private $_arrUrl = array();
    private $_enteredUrls = array();
    private $_domain;
    private $_memoryLimit;
    private $_timeLimit;

    public function __construct($domain, $lgName = '') {
        $this->_domain = preg_replace('/\/+$/', '', $domain);
        $this->_memoryLimit = ini_get("memory_limit");
        $this->_timeLimit = ini_get('max_execution_time');
        ini_set('max_execution_time', '300000');
        ini_set('memory_limit', '2024M');
    }

    public function run($url = '', $level = 0) {
       
        if (empty($url))
            $url_ = $this->_domain;
        else
            $url_ = $url;

        $url_ = preg_replace('/\/+/', '/', $url_);
        $url_ = preg_replace('/^\w+.{0,1}:\//', '$0/', $url_);

       

        if (!isset($this->_enteredUrls[$url_])) {

            $pageReaderCurl = new PageReaderCurl($url_);
            $pageReaderCurl->parse();
            $urls = $pageReaderCurl->getUrls();

            $this->_insert($pageReaderCurl, $level);
            $this->_enteredUrls[$url_] = $level;
            if (!empty($urls)) {
                $arr1 = array();
                foreach ($urls as $url__) {
                    $url1 = $url__;

                    if (strpos($url1, $this->_domain) === false)
                        $url1 = $this->_domain . $url__;

                    if (!isset($this->_enteredUrls[$url1]) && !isset($this->_arrUrl[$url1])) {

                        $this->_arrUrl[$url1] = $level;
                    }
                }
            }
          
        }

        if (!empty($this->_arrUrl)) {
            foreach ($this->_arrUrl as $url4 => $level_) {             
                if (!isset($this->_enteredUrls[$url4])) 
                $this->run($url4, $level_ + 1);
            }
        }
  
    }

    protected function _insert($data, $level = 0) {

        if ($data instanceof PageReader) {
            $model = new Sites();
            $model->url = $data->getUrl();
            $model->header = $data->getCode();
            $model->title = $data->getHeader();
            $model->description = $data->getDescription();
            $model->charLength = $data->getCharLength();
            $model->isGa = ($data->getGa() ? 1 : 0);
            $model->domain = $this->_domain;
            $model->level = $level;
        } elseif (is_string($data) && !empty($data)) {
            $model = Sites::model()->find("url=:url", array(":url" => $data));
            if (!$model)
                $model = new Sites();
            $model->url = $data;
        }

        if ($model->url) {
            try {
                $model->save();
            } catch (Exception $ex) {
                
            }
        }
    }

    public function __destruct() {
        ini_set('memory_limit', $this->_memoryLimit);
        ini_set('max_execution_time', $this->_timeLimit);
        $this->_arrUrl = null;
        $this->_enteredUrls = null;
    }

}
