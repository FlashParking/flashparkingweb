<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OffresController extends Controller
{
    /**
     * @Route("/offres")
     */
    public function contactAction()
    {
        // replace this example code with whatever you need
        return $this->render('@App/front/offres.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'offres',
        ));
    }
}
