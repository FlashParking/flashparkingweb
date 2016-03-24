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

    /**
     * @Route("/default", name="default")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $description = $em->getRepository('AppBundle:Description')->findAll();
        $partenaire = $em->getRepository('AppBundle:Partenaire')->findAll();

        dump ($description[0]);

        // replace this example code with whatever you need
        return $this->render('@App/front/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'search',
            'description' => $description,
            'partenaire' => $partenaire,
        ));
    }   

        public function formAction(Request $request)
        {
            // On initialise notre objet Desk
            $desk = new Desk();

            // On créé l'objet form à partir du formBuilder (En passant en param l'objet Desk)
            $form = $this->createFormBuilder($desk)
                ->add('title', 'text') // On ajoute le champ titre dans un input text
                ->add('summary', 'textarea') // Idem pour le résumé mais dans un champ textarea
                ->add('description', 'textarea') // Idem pour description
                ->getForm(); // On récupère l'objet form 

            if ($request->getMethod() == 'POST') { // Si on a soumis le formulaire
                $form->bindRequest($request); // On bind les valeurs du POST à notre formulaire

                if ($form->isValid()) { 

                }
            }

        }
}