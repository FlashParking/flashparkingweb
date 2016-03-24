<?php

namespace AppBundle\Controller\Backend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReservationsController extends Controller
{
    /**
     * @Route("/backend/reservations")
     */
    public function showAction(Request $request)
    {
        //Liste reservations
        $em = $this->getDoctrine()->getEntityManager();
        $liste_reservations = $em->getRepository('AppBundle:Reservation')->getReservations();
       
        $user = $request->getSession()->get('user');
        if( isset($user) && $user->getRoles()->getId()!=1){
            return $this->redirectToRoute('homepage');
        }
        
        $request = $this->getRequest();
       
        if($request->isXmlHttpRequest()) {
 
            $id = $request->request->get('id_message');
          
            $em->getRepository('AppBundle:Reservation')->deleteReservation($id);
        
            return new Response($id);
        }
        return $this->render('@App/backend/reservations.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'reservations',
            'user' => $user,
            'reservation' => $liste_reservations,
        ));
    }
}
