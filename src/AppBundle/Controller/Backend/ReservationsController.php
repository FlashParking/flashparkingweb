<?php

namespace AppBundle\Controller\Backend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReservationsController extends Controller
{
    /**
     * @Route("/backend/reservations")
     */
    public function showAction()
    {
        
        //Liste reservations
        $em = $this->getDoctrine()->getEntityManager();
        $liste_reservations = $em->getRepository('AppBundle:Reservation')->getReservations();
        
        
        return $this->render('@App/backend/reservations.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'reservations',
            'reservation' => $liste_reservations,
        ));
    }
}
