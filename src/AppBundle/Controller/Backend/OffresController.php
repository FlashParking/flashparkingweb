<?php
/**
 * Created by PhpStorm.
 * User: Virginie
 * Date: 23/03/2016
 * Time: 10:35
 */

namespace AppBundle\Controller\Backend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OffresController extends Controller
{
    /**
     * @Route("backend/offres")
     */
    public function messageAction()
    {
        // replace this example code with whatever you need
        return $this->render('@App/backend/offres.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'offres',
        ));
    }
}