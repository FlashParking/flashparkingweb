<?php

namespace AppBundle\Controller\Backend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MessageController extends Controller
{
    /**
     * @Route("backend/plaintes")
     */
    public function messageAction(Request $request)
    {
        $user = $request->getSession()->get('user');
        if($user->getRoles()->getId()!=1){
            return $this->redirectToRoute('homepage');
        }
        // replace this example code with whatever you need
        return $this->render('@App/backend/plaintes.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'plaintes',
            'user' => $user,
        ));
    }
}