<?php

namespace Pulpmedia\NgHttpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PulpmediaNgHttpBundle:Default:index.html.twig');
    }
}
