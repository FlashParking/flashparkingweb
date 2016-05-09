<?php
/**
 * Created by PhpStorm.
 * User: Virginie
 * Date: 23/03/2016
 * Time: 14:00
 */

namespace AppBundle\Controller\Backend;

use AppBundle\Form\TarifType;
use AppBundle\Entity\Tarif;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class OffersController extends Controller
{
    /**
     * @Route("backend/offresManager", name="offers")
     * @Route("offers/{id}", name="tarif_update")
     */
    public function offersAction(Request $request, $id = null)
    {
        /* Afficher tous les tarifs */
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Tarif')->findBy(array(), array('id' => 'DESC'));

        /* Retourne tout ça */
        return $this->render('@App/backend/offresManager.html.twig', array(
            'entities' => $entities,
            'nav_active' => 'offres',
            'offresManager.html.twig'
        ));
    }

    /**
     * @Route("update/{id}", name="tarif_update")
     */
    public function updateAction($id)
    {
        $tarif = $this->getDoctrine()
            ->getRepository('AppBundle:Tarif')
            ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->persist($tarif);
        $em->flush();

        // Add a message in the flashbag
        $this->addFlash(
            'success',
            'Le tarif à bien été modifié.'
        );
        // Redirect to the table page
        return $this->redirectToRoute('offers');
    }


    /**
     * @Route("delete/{id}", name="tarif_delete")
     */
    public function deleteAction($id)
    {
        $tarif = $this->getDoctrine()
            ->getRepository('AppBundle:Tarif')
            ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($tarif);
        $em->flush();

        // Add a message in the flashbag
        $this->addFlash(
            'success',
            'Le tarif à bien été supprimé.'
        );

        // Redirect to the table page
        return $this->redirectToRoute('offers');
    }
}