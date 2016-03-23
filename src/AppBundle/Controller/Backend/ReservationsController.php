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
        $user = $request->getSession()->get('user');
        if($user->getRoles()->getId()!=1){
            return $this->redirectToRoute('homepage');
        }
        return $this->render('@App/backend/reservations.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'reservations',
            'user' => $user
        ));
    }
}
