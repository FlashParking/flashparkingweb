<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReservationsController extends Controller
{
    /**
     * @Route("/reservations")
     */
    public function ReservationsAction()
    {
        // replace this example code with whatever you need
        return $this->render('@App/front/reservations.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'reservations',
        ));
    }
}
