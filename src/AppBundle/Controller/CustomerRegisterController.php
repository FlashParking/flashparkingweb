<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CustomerRegisterController extends Controller
{
    /**
     * @Route("/customer-register")
     */
    public function CustomerRegisterAction()
    {
        // replace this example code with whatever you need
        return $this->render('@App/front/customer-register.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'connexion',
        ));
    }
}
