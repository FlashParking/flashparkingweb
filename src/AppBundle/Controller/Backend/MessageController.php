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
        //Liste plaintes
        $em = $this->getDoctrine()->getEntityManager();
        $data = "Laaaa";
        $d = "";
        $liste_plaintes = $em->getRepository('AppBundle:Requete')->getPlaintes();
        
        $request = $this->getRequest();
       
        if($request->isXmlHttpRequest()) {
 

            //var_dump($data);
             $id = $request->request->get('test');
          
            
           
            //$d = $text;
            //var_dump($_POST['test']);
            return new Response($id);
            //$em->getRepository('AppBundle:requete')->deletePlaintes($text);
        }else{
            //return new Response('Not Ajax');
        }
        
        if(isset($id)) {
            $data = $id;
         $em->getRepository('AppBundle:Requete')->deletePlaintes($id);
        }
        // replace this example code with whatever you need
        return $this->render('@App/backend/plaintes.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'plaintes',
            'plaintes' => $liste_plaintes,
            'test' => $data,
        ));
    }
    

   /* 
    public function deleteMessageAction(Request $request)
    {
        
        if ($request->isXmlHttpRequest())
{
       /*$em = $this->getDoctrine()->getEntityManager();
 
        $liste_plaintes = $em->getRepository('AppBundle:Requete')->getPlaintes();

        var_dump($liste_plaintes);
        $request = $this->container->get('request');
        $text = $request->request->get('data');
        //$data = $request->request->get('data');
        print_r($text);
        
        return $this->render('@App/backend/plaintes.html.twig');

    //}
            return $this->render('@App/backend/plaintes.html.twig', array("test" => $request)
        );
    //return new Response('This is not ajax!', 400);
    }
           else {
               return $this->render('@App/backend/plaintes.html.twig', array('test' => "Laaa"));
           }
                
    }
       /* $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Requete');
        $line = $repository->find($id); 
        $em = $this->getDoctrine()->getManager(); 
        $em->remove($line); 
        $em->flush();
    }*/
}