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

class DashboardController extends Controller
{
    /**
     * @Route("/backend/dashboard")
     */
    public function dashboardAction()
    {
        // replace this example code with whatever you need
        return $this->render('@App/backend/dashboard.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'dashboard',
        ));
    }
}