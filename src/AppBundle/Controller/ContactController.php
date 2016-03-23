<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends Controller
{
    /**
     * @Route("/contact",name="contact")
     */
    public function contactAction(Request $request)
    {
        $mailTo = $this->createFormBuilder()
            ->setMethod('post')
            ->add('nom', TextType::class,array('label' => 'Nom','required' => true,'attr' => array('class'=>'form-control', 'id'=>'nom')))
            ->add('prenom', TextType::class,array('label' => 'Prénom','required' => true,'attr' => array('class'=>'form-control', 'id'=>'prenom')))
            ->add('email', EmailType::class ,array('label' => 'Email','required' => true,'attr' => array('class'=>'form-control', 'id'=>'email')))
            ->add('message', TextareaType::class ,array('label' => 'Message','required' => true,'attr' => array('class'=>'form-control', 'id'=>'message')))
            ->add('telephone', TextType::class ,array('label' => 'Téléphone','required' => false,'attr' => array('class'=>'form-control', 'id'=>'telephone','pattern' => '(0|\\+33|0033)[1-9][0-9]{8}')))
            ->add('type', EntityType::class, array('class' => 'AppBundle:TypeMessage','choice_label' => 'libelle','attr' => array('class'=>'form-control', 'id'=>'type')))
            ->getForm();

        $mailTo->handleRequest($request);

        if ($mailTo->isSubmitted() && $mailTo->isValid()) {
            $data = $mailTo->getData();
            if (isset ($data['telephone'])) {
                $telephone = $data['telephone'];
            } else {
                $telephone = '';
            }
            $message = new Message();
            $message->setMessage($data['message']);
            $message->setNom($data['nom']);
            $message->setPrenom($data['prenom']);
            $message->setTelephone($telephone);
            $message->setEmail($data['email']);
            $message->setIdType($data['type']);
            $message->setDate( new \Datetime() );

            $em = $this->getDoctrine()->getManager();

            $em->persist($message);
            $em->flush();

            $this->addFlash(
                'success',
                'Votre message a bien été envoyé.'
            );
        } elseif($mailTo->isSubmitted()){
            $this->addFlash(
                'warning',
                'Votre message n\'a pas pu être enregistré.'
            );
        }
        // replace this example code with whatever you need
        return $this->render('@App/front/contact.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'contact',
            'mailTo' => $mailTo->createView(),
        ));
    }
}
