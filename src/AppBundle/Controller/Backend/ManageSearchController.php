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

class ManageSearchController extends Controller
{
    /**
     * @Route("/backend/search")
     */
    public function ManageSearchAction()
    {
        // replace this example code with whatever you need
        return $this->render('@App/backend/search.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'search',
        ));
    }
}