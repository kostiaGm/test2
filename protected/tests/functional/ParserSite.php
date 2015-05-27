<?php

/**
 * Description of ParseSite
 *
 * @author kot
 */
class ParserSiteTest extends CTestCase {

    /**
     * @dataProvider1 provider
  
    public function testGetUrlList($url) {
        $parserSite1 = new ParserSite();
        $this->assertNotEmpty($parserSite1->getUrlList($url));
    }

  
     * @dataProvider1 provider
    
    public function testGetHttpReplay($url) {
        $parserSite1 = new ParserSite();
        $this->assertTrue($parserSite1->getHttpReplay($url));
    }
     *  
     */
    
    /**
     * @dataProvider provider
     */
    public function testRun($url) {
        $parserSite1 = new ParserSite($url);
        $this->assertTrue($parserSite1->run($url));
    }

    public function provider() {
        return array(
            array('http://uamag.com.ua')
           // array('http://uamag.com.ua/pages/o-kompanii.html')
        );
    }

}
