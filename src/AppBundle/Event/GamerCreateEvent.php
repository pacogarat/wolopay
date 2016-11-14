<?php


namespace AppBundle\Payment\Event;


use AppBundle\Entity\App;
use AppBundle\Entity\Gamer;
use Symfony\Component\EventDispatcher\Event;

class GamerCreateEvent extends Event
{
    const EVENT = 'app.gamer.create';

    /** @var App */
    protected $app;

    /** @var Gamer */
    protected $gamer;

    function __construct(App $app, Gamer $gamer)
    {
        $this->app = $app;
        $this->gamer=$gamer;
    }

    /**
     * @return App
     */
    public function getApp(){
        return $this->app;
    }

    /**
     * @return Gamer
     */
    public function getGamer()
    {
        return $this->gamer;
    }
} 