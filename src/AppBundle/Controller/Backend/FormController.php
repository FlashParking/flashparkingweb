<?php
/**
 * Created by PhpStorm.
 * User: Virginie
 */

namespace AppBundle\Controller\Backend;

use AppBundle\Form\TarifType;
use AppBundle\Entity\Tarif;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FormController extends Controller
{

    /**
     * @Route("backend/formManager", name="form")
     */
    public function formAction(Request $request)
    {
        $data = array();
        if(!isset($_POST['action']) || $_POST['action'] == "INSERT") {
            /* Ajouter un tarif */
            // Construit le formulaire
            $form = $this->createForm(TarifType::class);
            if ($form->handleRequest($request)->isValid()) {
                $tarif = $form->getData();
                // Sauvegarde le nouveau tarif
                $em = $this->getDoctrine()->getManager();
                $em->persist($tarif);
                $em->flush();

                $data = array(
                    'objet' => array(
                        'id' => $tarif->getId(),
                        'libelle' => $tarif->getLibelle(),
                        'description' => $tarif->getDescription(),
                        'prix' => $tarif->getPrix(),
                    ),
                    'deleteUrl' => $this->generateUrl('tarif_delete', array('id' => $tarif->getId())),
                );
            }
        } else {
            if($_POST['action'] == "UPDATE") {
                $em = $this->getDoctrine()->getManager();
                $tarif = $em->getRepository('AppBundle:Tarif')->find($_POST['id']);
                $form = $this->createForm(TarifType::class, $tarif);
                $data = array(
                    'objet' => array(
                        'id' => $tarif->getId(),
                        'libelle' => $tarif->getLibelle(),
                        'description' => $tarif->getDescription(),
                        'prix' => $tarif->getPrix(),
                    )
                );

                if ($form->handleRequest($request)->isValid()) {
                    // Mise à jour du tarif
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($tarif);
                    $em->flush();

                    $data['updateUrl'] = $this->generateUrl('tarif_update', array('id' => $tarif->getId()));
                }
            }
        }

        /* Retourne tout ça */
        return new JsonResponse(array_merge($data, array(
            'state' => $form->isValid(),
            'html' => $this->renderView('@App/backend/formManager.html.twig', array(
                'form' => $form->createView(),
            )),
        )));
    }

    /**
     * @Route("backend/formManager", name="formUpdate")
     */
}