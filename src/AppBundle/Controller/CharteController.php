<?php
/**
 * Created by PhpStorm.
 * User: Virginie
 * Date: 22/03/2016
 * Time: 10:35
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CharteController extends Controller
{
    /**
     * @Route("/charte",name="charte")
     */
    public function charteAction()
    {
        // replace this example code with whatever you need
        return $this->render('@App/front/charte.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'charte',
        ));
    }
}