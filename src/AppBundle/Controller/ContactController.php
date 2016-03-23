<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/contact",name="contact")
     */
    public function contactAction(Request $request)
    {
        $user = $request->getSession()->get('user');
        // replace this example code with whatever you need
        return $this->render('@App/front/contact.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'contact',
            'user' => $user,
        ));
    }
}
