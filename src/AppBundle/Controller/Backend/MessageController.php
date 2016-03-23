<?php

namespace AppBundle\Controller\Backend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    /**
     * @Route("backend/plaintes", name="plaintes")
     */
    public function messageAction(Request $request)
    {
        $user = $request->getSession()->get('user');
        if($user->getRoles()->getId()!=1){
            return $this->redirectToRoute('homepage');
        }
        //Liste plaintes
        $em = $this->getDoctrine()->getEntityManager();
        $data = "Laaaa";
        $d = "";
        $liste_plaintes = $em->getRepository('AppBundle:Requete')->getPlaintes();
        
        $request = $this->getRequest();
       
        if($request->isXmlHttpRequest()) {
 
            $id = $request->request->get('id_message');
          
            $em->getRepository('AppBundle:Requete')->deletePlaintes($id);
        
            return new Response($id);
        }
        // replace this example code with whatever you need
        return $this->render('@App/backend/plaintes.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'plaintes',
            'user' => $user,
            'plaintes' => $liste_plaintes,
        ));
    }
}