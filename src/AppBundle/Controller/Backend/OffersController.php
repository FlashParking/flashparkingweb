<?php
/**
 * Created by PhpStorm.
 * User: aude_
 * Date: 14/02/2016
 * Time: 21:01
 */

namespace AppBundle\Controller\Backend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OffersController extends Controller
{
    /**
     * @Route("backend/offers")
     */
    public function offersAction(Request $request)
    {
        $user = $request->getSession()->get('user');
        if( isset($user) && $user->getRoles()->getId()!=1){
            return $this->redirectToRoute('homepage');
        }
        // replace this example code with whatever you need
        return $this->render('@App/backend/offers.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'contact',
            'user' => $user,
        ));
    }
}