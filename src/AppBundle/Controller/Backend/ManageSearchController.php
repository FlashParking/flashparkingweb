<?php
/**
 * Created by PhpStorm.
 * User: Nani
 * Date: 13/02/2016
 * Time: 16:52
 */

namespace AppBundle\Controller\Backend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ManageSearchController extends Controller
{
    /**
     * @Route("/backend/search")
     */
    public function ManageSearchAction(Request $request)
    {
        $user = $request->getSession()->get('user');
        if($user->getRoles()->getId()!=1){
            return $this->redirectToRoute('homepage');
        }
        // replace this example code with whatever you need
        return $this->render('@App/backend/search.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'search',
            'user' => $user,
        ));
    }
}