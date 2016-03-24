<?php
/**
 * Created by PhpStorm.
 * User: nishantha
 *Date: 19/02/2016
 * Time: 20:17
 */

namespace AppBundle\Controller\Backend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/backend/home", name="description")
     */
    public function dashboardAction()
    {

        // replace this example code with whatever you need
        return $this->render('@App/backend/home.html.twig', array(
            'nav_active' => 'search',
        ));
    }
}