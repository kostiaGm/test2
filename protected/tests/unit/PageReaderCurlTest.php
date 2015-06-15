<?php

class PageReaderCurlTest extends CTestCase {

    protected $_pageReaderCurl;

    protected function setUp() {
        $this->_pageReaderCurl = new PageReaderCurl('http://u2');
    }

    public function testParse() {
       
        $parse = $this->_pageReaderCurl->parse();
        $this->assertTrue($parse);

        $url = $this->_pageReaderCurl->getUrl();
        $this->assertNotEmpty($url);

        $html = $this->_pageReaderCurl->getHtml();
        $this->assertNotEmpty($html);

        $urls = $this->_pageReaderCurl->getUrls();
        $this->assertNotEmpty($urls);

        $header = $this->_pageReaderCurl->getHeader();
        $this->assertNotEmpty($header);

        $description = $this->_pageReaderCurl->getDescription();
        $this->assertNotEmpty($description);
        
        $code = $this->_pageReaderCurl->getCode();
        $this->assertNotEmpty($code);
        
    }
    

}
