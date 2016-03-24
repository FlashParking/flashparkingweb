<?php
/**
* Created by PhpStorm.
* User: aude_
*/

namespace AppBundle\Controller\Backend;

use AppBundle\Entity\Parking;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ManageSearchController extends Controller
{
    /**
     * @Route("/backend/search")
     */
    public function parkingAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $parking = $em->getRepository('AppBundle:Parking')->getParking();

        $this->addAction($request);

        $form = $this->createFormBuilder()
            ->add('nom',      'text')
            ->add('place',     'text')
            ->add('placeLibre',     'number')
            ->add('placePrise',     'number')
            ->add('description',   'textarea')
            ->add('adresse',    'textarea')
            ->add('codePostal',     'text')
            ->add('ville',     'text')
            ->add('coordonnees',    'textarea')
            ->add('ajouter',    'submit')
            ->getForm();


       // $request = $request->request->get('request');
        $requete = $this->get('request');

        if($requete->isXmlHttpRequest()) {

            $id = $requete->request->get('id');

            $em->getRepository('AppBundle:Parking')->deleteParking($id);

            return new Response($id);
        }

        return $this->render('@App/backend/search.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'search',
            'parking' => $parking,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/backend/search")
     */
    public function addAction(Request $request)
    {
        $parking = new Parking();

        $form = $this->get('form.factory')->createBuilder('form', $parking)
            ->add('nom',      'text')
            ->add('place',     'text')
            ->add('placeLibre',     'number')
            ->add('placePrise',     'number')
            ->add('description',   'textarea')
            ->add('adresse',    'textarea')
            ->add('codePostal',     'text')
            ->add('ville',     'text')
            ->add('coordonnees',    'textarea')
            ->add('ajouter',    'submit')
            ->getForm()
        ;
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parking);
            $em->flush();
            $parking = $this->getDoctrine()
                ->getRepository('AppBundle:Parking')
                ->find($request);
           return new Response('L\'annonce a bien été ajouté');
            //return $this->render('@App/backend/search.html.twig',array('parking' => $parking));
           //return $this->redirect($this->generateUrl('backend_search', array('id' => $parking->getId())));
        }

        return $form;
        /*return $this->render('@App/backend/search.html.twig', array(
           'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
           'nav_active' => 'search',
           'form' => $form->createView(),
       ));*/
    }  

}