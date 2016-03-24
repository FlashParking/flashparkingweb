<?php
/**
 * Created by PhpStorm.
 * User: aude_
 *Date: 21/01/2016
 * Time: 20:17
 */

namespace AppBundle\Controller\Backend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    /**
     * @Route("/backend/dashboard", name="dashboard")
     */
    public function dashboardAction(Request $request)
    {
        $user = $request->getSession()->get('user');
        if(isset($user) && $user->getRoles()->getId()!=1){
            return $this->redirectToRoute('homepage');
        }
        // replace this example code with whatever you need
        return $this->render('@App/backend/dashboard.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'dashboard',
            'user' => $user,
        ));
    }
}