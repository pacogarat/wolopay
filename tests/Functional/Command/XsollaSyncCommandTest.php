<?php

namespace AppBundle\Tests\Functional\Controller;


use AppBundle\Command\XsollaSyncCommand;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Tests\Lib\FunctionalTestCase;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Because need a environment to notify
 */
class XsollaSyncCommandTest extends FunctionalTestCase
{
    /** @var  XsollaSyncCommand */
    private $xsollaService;

    public function setUp()
    {
        parent::setUp();
        $this->xsollaService = $this->container->get('command.xsolla_sync');
        $this->loadAllFixtures();
    }

    public function testMessagesSimpleOK()
    {
        $html = <<<HTML

 <div id="recommended-block">
        <h3>Recommended payment methods</h3>
        <div class="option-list" id="recommended-list"></div>
<div class="clear"></div>

    <script>
        var recommendedListData = {"instances":[{"id":24,"hidden":0,"aliases":"","recommended":1,"cat":[2],"recurrent_type":"charge","name":"PayPal","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/24.1421413162.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=24"},{"id":26,"hidden":0,"aliases":null,"recommended":1,"cat":[7],"recurrent_type":"charge","name":"Visa \/ MasterCard","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/26.1416898622.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=26"},{"id":714,"hidden":0,"aliases":null,"recommended":1,"cat":[7],"recurrent_type":"off","name":"American Express","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/714.1415360815.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=714"},{"id":497,"hidden":0,"aliases":null,"recommended":1,"cat":[7],"recurrent_type":"off","name":"Diners Club","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/497.1416919363.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=497"},{"id":465,"hidden":0,"aliases":null,"recommended":1,"cat":[2],"recurrent_type":"notify","name":"Skrill Digital Wallet","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/465.1415362406.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=465"},{"id":1999,"hidden":0,"aliases":null,"recommended":1,"cat":[5],"recurrent_type":"off","name":"oBucks","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/1999.1411361416.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=1999"},{"id":1353,"hidden":0,"aliases":null,"recommended":1,"cat":[5],"recurrent_type":"off","name":"Subway Gift Card","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/1353.1416834555.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=1353"},{"id":2682,"hidden":0,"aliases":null,"recommended":1,"cat":[0,2],"recurrent_type":"off","name":"Bitcoin","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/2682.1415221257.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=2682"},{"id":1412,"hidden":0,"aliases":null,"recommended":1,"cat":[5],"recurrent_type":"off","name":"Circle K Gift Card","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/1412.1413971491.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=1412"},{"id":1410,"hidden":0,"aliases":null,"recommended":1,"cat":[5],"recurrent_type":"off","name":"CVS Gift Card","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/1410.1413971473.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=1410"},{"id":1414,"hidden":0,"aliases":null,"recommended":1,"cat":[5],"recurrent_type":"off","name":"Shell Gift Card","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/1414.1413971523.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=1414"},{"id":1417,"hidden":0,"aliases":null,"recommended":1,"cat":[5],"recurrent_type":"off","name":"Dollar General Card","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/1417.1413971573.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=1417"},{"id":1413,"hidden":0,"aliases":null,"recommended":1,"cat":[5],"recurrent_type":"off","name":"BK Crown Card","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/1413.1413971507.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=1413"},{"id":2521,"hidden":0,"aliases":null,"recommended":1,"cat":[1],"recurrent_type":"off","name":"MoneyGram","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/2521.1405405946.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=2521"},{"id":1415,"hidden":0,"aliases":null,"recommended":1,"cat":[5],"recurrent_type":"off","name":"Sports Authority Card","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/1415.1413971538.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=1415"},{"id":129,"hidden":0,"aliases":null,"recommended":1,"cat":[5],"recurrent_type":"off","name":"Rixty","imgUrl":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/129.1410171366.png","url":"https:\/\/secure.xsolla.com\/paystation2\/?theme=115&project=4783&marketplace=paydesk&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&special_skip_step=0&pid=129"}],"showOther":true,"activeItem":"26","categories":"2,1,7,3,4,5","otherURL":"?theme=115&project=4783&marketplace=paydesk&action=list&v1=XsollaUser&v2=&v3=&out=10&email=support%40xsolla.com&currency=USD&hidden=out%2Cv1%2Ccurrency&phone=&country=US&local=en&categories=2%2C1%2C7%2C3%2C4%2C5","otherImg":"https:\/\/cdn2.xsolla.com\/paymentoptions\/paystation\/theme_33\/108x63\/38.1422537231.png"};
        App.registerOnReady(function () {
            App.cmp('list').renderRecommendedList(recommendedListData);
        });
    </script>    </div>
        <div class="footer" id="footer">
        <div class="footer-right">

HTML;
        /** @var OutputInterface $output */
        $output = $this->getMockBuilder('\\Symfony\\Component\\Console\\Output\\StreamOutput')
            ->disableOriginalConstructor()
            ->getMock();
        $result = $this->xsollaService->sync($html, CountryEnum::USA, $output);

        $this->assertCount(13, $result); //PMPC added
        $this->assertEquals(714, $result[0]->getPayMethodHasProvider()->getExtraOptions()['external_provider_id']);
    }



} 