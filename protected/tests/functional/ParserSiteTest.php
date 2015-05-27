<?php
if (!defined('PATH'))
    define('PATH', dirname(__FILE__));

define('PARSE_SITE_TEST_PHP', 'PARSE_SITE_TEST_PHP');

include_once PATH.'/../extensions/ParserSite/ParserSite.php';
class ParserSiteTest extends PHPUnit_Framework_TestCase {
    
    public function testGetUrlList() {
        
        $parseSite = new ParserSite;
        
        $this->assertTrue($parseSite->getUrlList('http://uamag.com.ua'));
    }
    
   
    
}
