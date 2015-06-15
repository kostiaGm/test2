<?php

/**
 * Description of ParseSite
 *
 * @author kot
 */
class ParserSiteTest extends CTestCase {

    protected $_parserSite;
    
    protected function setUp() {
        $this->_parserSite = new ParserSite('http://kolobok/');
    }
    
    public function testRun() {
        $this->_parserSite->run();
    } 

}
