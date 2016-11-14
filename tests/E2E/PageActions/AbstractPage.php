<?php


namespace AppBundle\Tests\E2E\PageActions;



class AbstractPage
{
    /** @var \RemoteWebDriver */
    protected $driver;

    /** @var \RemoteWebDriver */
    protected $wait;


    function __construct($driver)
    {
        $this->driver = $driver;
        $this->wait = new \WebDriverWait($driver, 25);
    }

    public function waitToLoadNewPage()
    {
        $wait = new \WebDriverWait($this->driver, 60);
        $wait->until(function(){
                return $this->driver->executeScript('return document.readyState') == 'complete';
            });
    }

    public function switchFocusToNewWindow()
    {
        $handles = $this->driver->getWindowHandles();
        $this->driver->switchTo()->window($handles[count($handles)-1]);
    }

    /**
     * @param string $text
     * @return $this
     */
    public function verifyUrlOkByText($text='Enjoy your product')
    {
        $wait = new \WebDriverWait($this->driver, 30);
        $wait->until(
            function($text) use ($text){
                return $this->driver->findElement(\WebDriverBy::xpath("//*[contains(text(), '$text')]"));
            });

        return $this;
    }

    public function elementIsVisible(\RemoteWebElement $el = null)
    {
        if (!$el->isEnabled())
            return false;

        if (!$el->isDisplayed())
            return false;

        return true;
    }

    public function waitForQueryExecute($queryEval, $em)
    {
        $this->wait->until(
            function () use ($queryEval, $em) {
                eval('$temp = '.$queryEval.';');
                /** @var $temp bool */
                return $temp;
            }
        );

        return $this;
    }

    /**
     * @param \WebDriverBy $search
     * @return $this
     */
    public function waitElementVisible(\WebDriverBy $search)
    {
        $this->wait->until(
            function () use ($search) {
                 return $this->elementIsVisible($this->driver->findElement($search));
            }
        );
    }

    /**
     * @param string $text
     * @return $this
     */
    public function waitTextInElement($elementXPath, $text='Enjoy your product')
    {
        $wait = new \WebDriverWait($this->driver, 30);
        $wait->until(
            function($text) use ($text, $elementXPath){
                $xpath = "$elementXPath//*[contains(text(), '$text')]";
                return $this->driver->findElement(\WebDriverBy::xpath($xpath));
            });

        return $this;
    }

    public function waitElementHidden(\WebDriverBy $search)
    {
        try{

            $this->wait->until(
                function () use ($search) {
                    return !$this->elementIsVisible($this->driver->findElement($search));
                }
            );
        }catch (\Exception $e){
            // not found dom is deleted
        }
    }

    public function waitElementsVisible(\WebDriverBy $search)
    {
        $this->wait->until(
            function () use ($search) {

                if (!$elements = $this->driver->findElements($search))
                    return false;

                foreach ($elements as $el)
                {
                    if (!$this->elementIsVisible($el))
                        return false;
                }

                return true;
            }
        );
    }

} 