<?php

/**
 * Description of PageReader
 *
 * @author kot
 */
abstract class PageReader {

    protected $_url;
    protected $_htmlPage;
    protected $_header;
    protected $_description;
    protected $_urls = array();
    protected $_httpCode;
    protected $_isGa = false;
    protected $_charLength = 0;

    public function __construct($url) {
        $this->_url = $url;
    }

    public abstract function connect();

    public function parse() {
        
        if ($this->connect()) {

            if (!empty($this->_htmlPage)) {
                preg_match_all('/href="([^"]+)"/', $this->_htmlPage, $links);

                if (isset($links[1]) && !empty($links[1])) {
                    foreach ($links[1] as $url) {
                        $url = trim($url);
                        if (!empty($url) && !preg_match("/\.css|\.js|\.ico|\.jpg|\.jpeg|\.gif|\.png|\.pdf|javascript|sitemap|http\:|https\:|www\.|#/i", $url) && !in_array($url, $this->_urls) && $url != '/') {
                            $this->_urls[] = $url;
                        }
                    }
                }
                
                preg_match('/<meta(?=[^>]* name *= *"?description"?) [^>]*?(?<= )content *= *"([^"]*)"[^>]*>/i', $this->_htmlPage, $description);
                
                if (isset($description[1])) 
                    $this->_description = $description[1];
                
                
                preg_match('/<title>(.*)<\/title>/', $this->_htmlPage, $title);
                
                if (isset($title[1]))
                    $this->_header = $title[1];
                
                if (preg_match('/google-analytics\.com/', $this->_htmlPage))
                        $this->_isGa = true;
                        
                $this->_charLength = strlen(strip_tags($this->_htmlPage));
            }
           
            return true;
        }

        return false;
    }
    
    public function getUrls() {
        return $this->_urls;
    }
    
    public function getHeader() {
        return $this->_header;
    }
    
    public function getDescription() {     
        return $this->_description;
    }
    
    public function getCode() {
        return $this->_httpCode;
    }
    
    public function getHtml() {
        return $this->_htmlPage;
    }
    
    public function getUrl() {
        return $this->_url;
    }
    
    public function getGa() {
        return $this->_isGa;
    }
    
    public function getCharLength() {
        return $this->_charLength;
    }

}
