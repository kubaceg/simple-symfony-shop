<?php

namespace ShopBundle\Controller;

use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    private $commandbus;

    public function __construct( CommandBus $commandbus )
    {
        $this->commandbus = $commandbus;
    }

    public function indexAction()
    {
        return $this->render('ShopBundle:Default:index.html.twig');
    }
}
