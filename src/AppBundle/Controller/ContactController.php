<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    /**
     * @Route("/contact")
     */
    public function contactAction()
    {
        // replace this example code with whatever you need
        return $this->render('@App/front/contact.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'contact',
        ));
    }
}
