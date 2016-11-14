<?php


namespace AppBundle\Tests\E2E\WolopaySDK;


class ArticlesByCountryTest extends AbstractWolopaySDK
{

    public function setUp()
    {
        parent::setUp('test_dev');
        $this->loadAllFixtures();
    }

    /**
     * @group E2E
     */
    public function testSimpleOK()
    {
        $wolopayApi = $this->getApiWolopayObjectDemo();
        $result = $wolopayApi->getArticlesByCountry('ES');

        if ($result === false){

            throw new \Exception("Error");
        }
    }

} 